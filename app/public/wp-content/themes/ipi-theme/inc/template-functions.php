<?php
/**
 * Funções que afetam o comportamento de templates (não são template tags).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adiciona classes ao <body> conforme o contexto.
 *
 * @param array<int,string> $classes Classes já existentes.
 * @return array<int,string>
 */
function ipi_theme_body_classes( array $classes ): array {
	if ( is_front_page() || ! is_active_sidebar( 'sidebar-blog' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	return $classes;
}
add_filter( 'body_class', 'ipi_theme_body_classes' );

/**
 * Imprime o link de pingback no <head> quando os posts aceitam pingbacks.
 */
function ipi_theme_pingback_header(): void {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ipi_theme_pingback_header' );

/**
 * Reduz o resumo automático (excerpt) para um tamanho compatível com os cards.
 */
function ipi_theme_excerpt_length( int $length ): int {
	return is_admin() ? $length : 26;
}
add_filter( 'excerpt_length', 'ipi_theme_excerpt_length' );

/**
 * Substitui o "[...]" padrão do excerpt por reticências e reforça o link "Leia mais".
 */
function ipi_theme_excerpt_more( string $more ): string {
	return is_admin() ? $more : '&hellip;';
}
add_filter( 'excerpt_more', 'ipi_theme_excerpt_more' );

/**
 * Define um fallback simples para o menu primário quando nenhum menu foi criado,
 * evitando uma navegação vazia para o visitante.
 */
function ipi_theme_fallback_menu(): void {
	echo '<ul id="primary-menu" class="menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}
