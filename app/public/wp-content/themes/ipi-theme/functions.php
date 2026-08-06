<?php
/**
 * IPI Theme — funções e definições principais.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Bloqueia acesso direto ao arquivo.
}

/**
 * Constantes do tema.
 *
 * IPI_THEME_VERSION é a fonte única de verdade para o cache-busting de
 * assets (usada em todos os wp_enqueue_style/script do tema, em vez de
 * chamar wp_get_theme()->get( 'Version' ) repetidamente).
 */
const IPI_THEME_VERSION = '1.0.0';
const IPI_THEME_MIN_PHP = '8.2';

/**
 * Configuração inicial do tema.
 *
 * Registra suporte a recursos do WordPress: title-tag, thumbnails,
 * HTML5, logo customizado, menus, feeds automáticos, embeds
 * responsivos e alinhamentos largos (compatibilidade com o editor
 * de blocos via theme.json).
 */
function ipi_theme_setup(): void {
	// Torna o tema disponível para tradução (pt_BR incluso por padrão em /languages).
	load_theme_textdomain( 'ipi-theme', get_template_directory() . '/languages' );

	// Feed automático de posts e comentários no <head>.
	add_theme_support( 'automatic-feed-links' );

	// Deixa o WordPress gerenciar o <title>.
	add_theme_support( 'title-tag' );

	// Imagens destacadas.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 675, true );
	add_image_size( 'ipi-card', 480, 320, true );
	add_image_size( 'ipi-hero', 900, 675, true );

	// Marcação HTML5 para elementos de tema.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Logo customizável via Personalizador.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Compatibilidade com o editor de blocos.
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Selective refresh para widgets no Personalizador.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Menus de navegação.
	register_nav_menus(
		array(
			'primary' => __( 'Menu Principal', 'ipi-theme' ),
			'footer'  => __( 'Menu do Rodapé', 'ipi-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'ipi_theme_setup' );

/**
 * Ajusta $content_width em templates de largura total.
 */
function ipi_theme_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'ipi_theme_content_width', 780 );
}
add_action( 'after_setup_theme', 'ipi_theme_content_width', 0 );

/**
 * Registra as áreas de widgets (sidebar de blog e colunas do rodapé).
 */
function ipi_theme_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => __( 'Barra Lateral do Blog', 'ipi-theme' ),
			'id'            => 'sidebar-blog',
			'description'   => __( 'Exibida em posts e páginas com barra lateral.', 'ipi-theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	foreach ( range( 1, 3 ) as $i ) {
		register_sidebar(
			array(
				/* translators: %d: número da coluna do rodapé. */
				'name'          => sprintf( __( 'Rodapé — Coluna %d', 'ipi-theme' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => __( 'Área de widgets exibida no rodapé do site.', 'ipi-theme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'ipi_theme_widgets_init' );

/**
 * Enfileira estilos e scripts do tema.
 */
function ipi_theme_scripts(): void {
	wp_enqueue_style( 'ipi-theme-style', get_stylesheet_uri(), array(), IPI_THEME_VERSION );

	wp_enqueue_script(
		'ipi-theme-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		IPI_THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	wp_enqueue_script(
		'ipi-theme-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		IPI_THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ipi_theme_scripts' );

/**
 * Inclusões modulares do tema.
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/performance.php';
