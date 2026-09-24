<?php
/**
 * TEMPORÁRIO — só para a demonstração via túnel público (localtunnel).
 *
 * O ambiente Docker fixa WP_HOME/WP_SITEURL em "http://localhost:8080"
 * (ver docker-compose.yml) — correto para o time acessar localmente, mas
 * faz o WordPress redirecionar errado quando alguém acessa por um domínio
 * de túnel (ex.: https://xxxx.loca.lt). Este arquivo faz o site responder
 * dinamicamente pelo Host da própria requisição, sem alterar o
 * docker-compose.yml. Seguro remover a qualquer momento — é só este
 * arquivo, em wp-content/mu-plugins/ (carrega automaticamente, sem
 * precisar ativar).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'pre_option_home',
	function ( $value ) {
		return empty( $_SERVER['HTTP_HOST'] ) ? $value : 'https://' . $_SERVER['HTTP_HOST']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	}
);

add_filter(
	'pre_option_siteurl',
	function ( $value ) {
		return empty( $_SERVER['HTTP_HOST'] ) ? $value : 'https://' . $_SERVER['HTTP_HOST']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	}
);
