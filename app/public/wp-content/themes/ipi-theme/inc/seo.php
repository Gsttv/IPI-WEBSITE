<?php
/**
 * SEO básico embutido no tema: meta description, Open Graph, Twitter Card,
 * link canônico e dados estruturados (Schema.org) para organização médica.
 *
 * Observação: se um plugin de SEO dedicado (Yoast, Rank Math etc.) estiver
 * ativo, as saídas abaixo são automaticamente desativadas para evitar
 * duplicidade de metadados.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Verifica se algum plugin de SEO conhecido está ativo.
 */
function ipi_theme_has_seo_plugin(): bool {
	return defined( 'WPSEO_VERSION' )                 // Yoast SEO.
		|| defined( 'RANK_MATH_VERSION' )              // Rank Math.
		|| defined( 'AIOSEO_VERSION' )                 // All in One SEO.
		|| function_exists( 'the_seo_framework' );     // The SEO Framework.
}

/**
 * Retorna a URL canônica da requisição atual (usa a API do core quando
 * disponível — páginas singulares — e cai para a URL da requisição,
 * sanitizada, nos demais casos: arquivos, busca, home do blog etc.).
 */
function ipi_theme_get_current_url(): string {
	$canonical = wp_get_canonical_url();
	if ( $canonical ) {
		return $canonical;
	}

	if ( is_front_page() || is_home() ) {
		return home_url( '/' );
	}

	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Gera uma descrição curta e segura para meta tags a partir do contexto atual.
 */
function ipi_theme_get_meta_description(): string {
	if ( is_singular() ) {
		$post = get_queried_object();

		if ( $post instanceof WP_Post ) {
			$excerpt = has_excerpt( $post ) ? $post->post_excerpt : $post->post_content;
			$excerpt = wp_strip_all_tags( strip_shortcodes( $excerpt ) );

			return wp_trim_words( $excerpt, 35, '…' );
		}
	}

	if ( is_category() || is_tag() || is_tax() ) {
		return wp_strip_all_tags( term_description() );
	}

	// Home do blog, front page e demais contextos: usa a tagline do site.
	return get_bloginfo( 'description' );
}

/**
 * Imprime meta description, Open Graph, Twitter Card e link canônico no <head>.
 */
function ipi_theme_output_meta_tags(): void {
	if ( ipi_theme_has_seo_plugin() ) {
		return;
	}

	$description = ipi_theme_get_meta_description();
	$title       = wp_get_document_title();
	$url         = ipi_theme_get_current_url();
	$image       = '';

	if ( is_singular() && has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id();
		$thumbnail    = wp_get_attachment_image_src( $thumbnail_id, 'ipi-hero' );
		$image        = $thumbnail ? $thumbnail[0] : '';
	}

	if ( $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
	}

	// robots: evita indexação de resultados de busca internos.
	if ( is_search() ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	}

	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );

	printf( '<meta property="og:locale" content="%s">' . "\n", esc_attr( get_locale() ) );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( is_singular( 'post' ) ? 'article' : 'website' ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $description ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
	}
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	}

	printf( '<meta name="twitter:card" content="%s">' . "\n", esc_attr( $image ? 'summary_large_image' : 'summary' ) );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $description ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
	}
}
add_action( 'wp_head', 'ipi_theme_output_meta_tags', 1 );

/**
 * Imprime dados estruturados (Schema.org / JSON-LD) descrevendo a instituição
 * como organização médica — melhora a exibição em resultados de busca e
 * assistentes de IA (rich results, Knowledge Panel).
 */
function ipi_theme_output_schema(): void {
	if ( ipi_theme_has_seo_plugin() || ! is_front_page() ) {
		return;
	}

	$phone = get_theme_mod( 'ipi_theme_phone', '' );
	$email = get_theme_mod( 'ipi_theme_email', '' );
	$address = get_theme_mod( 'ipi_theme_address', '' );

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'MedicalClinic',
		'name'       => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
		'url'        => home_url( '/' ),
		'medicalSpecialty' => 'Infectious Disease',
	);

	if ( has_custom_logo() ) {
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_src = $logo_id ? wp_get_attachment_image_src( $logo_id, 'full' ) : false;
		if ( $logo_src ) {
			$schema['logo'] = $logo_src[0];
			$schema['image'] = $logo_src[0];
		}
	}

	if ( $phone ) {
		$schema['telephone'] = $phone;
	}

	if ( $email ) {
		$schema['email'] = $email;
	}

	if ( $address ) {
		$schema['address'] = array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $address,
			'addressRegion'   => 'PE',
			'addressCountry'  => 'BR',
		);
	}

	$social_links = ipi_theme_get_social_links();
	if ( ! empty( $social_links ) ) {
		$schema['sameAs'] = array_values( $social_links );
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'ipi_theme_output_schema', 2 );

/**
 * Reforça a hierarquia de títulos gerada pelo core (wp_get_document_title)
 * definindo um separador consistente. O valor padrão do core é ignorado
 * de propósito — este filtro sempre substitui pelo separador da marca.
 */
function ipi_theme_document_title_separator(): string {
	return '—';
}
add_filter( 'document_title_separator', 'ipi_theme_document_title_separator' );
