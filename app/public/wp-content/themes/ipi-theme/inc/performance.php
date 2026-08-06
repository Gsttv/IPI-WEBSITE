<?php
/**
 * Ajustes de performance e "housekeeping" do <head>.
 *
 * Remove recursos que o WordPress carrega por padrão e que raramente são
 * usados em sites institucionais (emojis nativos, embeds automáticos,
 * cabeçalhos com a versão do WP), reduzindo requisições e superfície de
 * informação exposta. Nada aqui afeta plugins — apenas o que o próprio
 * tema/core injeta.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove o script/estilo de emoji do WordPress (substituídos por emojis
 * nativos do sistema operacional/fonte, sem perda visual relevante).
 */
function ipi_theme_disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'ipi_theme_disable_emojis' );

/**
 * Remove links pouco usados no <head> (RSD, WLW Manifest, shortlink,
 * versões de feed de comentários adicionais) para enxugar o HTML.
 */
function ipi_theme_cleanup_head(): void {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'ipi_theme_cleanup_head' );

/**
 * Remove APENAS o "?ver=" que corresponde à versão do WordPress core
 * (reduz a superfície de fingerprinting da instalação, sem afetar
 * cache-busting de plugins/tema).
 *
 * Importante: um filtro que removesse "ver" de qualquer asset quebraria
 * o cache-busting de scripts/estilos de plugins e do próprio tema — por
 * isso a checagem abaixo só age quando o valor bate com a versão do core.
 */
function ipi_theme_remove_version_strings( string $src ): string {
	if ( ! str_contains( $src, 'ver=' ) ) {
		return $src;
	}

	$query = wp_parse_url( $src, PHP_URL_QUERY );
	if ( ! $query ) {
		return $src;
	}

	parse_str( $query, $params );

	if ( isset( $params['ver'] ) && $params['ver'] === get_bloginfo( 'version' ) ) {
		return remove_query_arg( 'ver', $src );
	}

	return $src;
}
add_filter( 'style_loader_src', 'ipi_theme_remove_version_strings' );
add_filter( 'script_loader_src', 'ipi_theme_remove_version_strings' );

/**
 * Remove apenas os links de descoberta de oEmbed do <head> (discovery
 * link + host JS). Não desativa o processamento de oEmbed em si — URLs
 * coladas em conteúdo (YouTube, Twitter etc.) continuam funcionando
 * normalmente através do shortcode/handler padrão do core.
 */
function ipi_theme_remove_oembed_discovery_links(): void {
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'ipi_theme_remove_oembed_discovery_links' );

/**
 * Adiciona "decoding=async" às imagens do conteúdo — complementa o
 * "loading=lazy" nativo do core para reduzir bloqueio de renderização.
 */
function ipi_theme_image_decoding_attr( array $attr ): array {
	$attr['decoding'] = 'async';
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ipi_theme_image_decoding_attr' );
