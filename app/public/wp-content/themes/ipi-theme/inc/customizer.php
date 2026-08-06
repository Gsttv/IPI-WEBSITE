<?php
/**
 * Opções do Personalizador (Customizer) — dados institucionais editáveis
 * sem necessidade de mexer em código (telefone, endereço, redes sociais...).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registra o painel, seções e configurações do Personalizador.
 */
function ipi_theme_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_section(
		'ipi_theme_contact',
		array(
			'title'    => __( 'Informações Institucionais', 'ipi-theme' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'ipi_theme_phone'          => array(
			'label'    => __( 'Telefone principal', 'ipi-theme' ),
			'default'  => '',
			'sanitize' => 'sanitize_text_field',
			'type'     => 'tel',
		),
		'ipi_theme_whatsapp_url'   => array(
			'label'    => __( 'Link do WhatsApp (URL completa)', 'ipi-theme' ),
			'default'  => '',
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'ipi_theme_email'          => array(
			'label'    => __( 'E-mail de contato', 'ipi-theme' ),
			'default'  => '',
			'sanitize' => 'sanitize_email',
			'type'     => 'email',
		),
		'ipi_theme_address'        => array(
			'label'    => __( 'Endereço', 'ipi-theme' ),
			'default'  => '',
			'sanitize' => 'sanitize_text_field',
			'type'     => 'text',
		),
		'ipi_theme_emergency_text' => array(
			'label'    => __( 'Texto da faixa de emergência (deixe vazio para ocultar)', 'ipi-theme' ),
			'default'  => '',
			'sanitize' => 'sanitize_text_field',
			'type'     => 'text',
		),
		'ipi_theme_footer_text'    => array(
			'label'    => __( 'Texto de copyright do rodapé', 'ipi-theme' ),
			'default'  => __( 'Instituto Pernambucano de Infectologia. Todos os direitos reservados.', 'ipi-theme' ),
			'sanitize' => 'sanitize_text_field',
			'type'     => 'text',
		),
	);

	foreach ( $fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $field['sanitize'],
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'ipi_theme_contact',
				'type'    => $field['type'],
			)
		);
	}

	// Redes sociais.
	$wp_customize->add_section(
		'ipi_theme_social',
		array(
			'title'    => __( 'Redes Sociais', 'ipi-theme' ),
			'priority' => 35,
		)
	);

	$social_networks = array(
		'facebook'  => __( 'Facebook', 'ipi-theme' ),
		'instagram' => __( 'Instagram', 'ipi-theme' ),
		'linkedin'  => __( 'LinkedIn', 'ipi-theme' ),
		'youtube'   => __( 'YouTube', 'ipi-theme' ),
	);

	foreach ( $social_networks as $network => $label ) {
		$setting_id = "ipi_theme_social_{$network}";

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				/* translators: %s: nome da rede social. */
				'label'   => sprintf( __( 'URL do %s', 'ipi-theme' ), $label ),
				'section' => 'ipi_theme_social',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'ipi_theme_customize_register' );

/**
 * Retorna as redes sociais preenchidas no Personalizador.
 *
 * @return array<string,string> Mapa rede => URL.
 */
function ipi_theme_get_social_links(): array {
	$networks = array( 'facebook', 'instagram', 'linkedin', 'youtube' );
	$links    = array();

	foreach ( $networks as $network ) {
		$url = get_theme_mod( "ipi_theme_social_{$network}", '' );
		if ( $url ) {
			$links[ $network ] = $url;
		}
	}

	return $links;
}

/**
 * JS de preview em tempo real para título e subtítulo do site.
 */
function ipi_theme_customize_preview_js(): void {
	wp_enqueue_script(
		'ipi-theme-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		IPI_THEME_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'ipi_theme_customize_preview_js' );
