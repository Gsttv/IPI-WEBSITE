<?php
/**
 * Desliga a atualização automática de núcleo/plugins/temas no ambiente
 * Docker. Sem isso, o próprio WordPress baixa e instala atualizações em
 * segundo plano (a cada visita, via wp-cron) — foi o que travou o site
 * em "modo de manutenção" (atualização de núcleo interrompida no meio,
 * de uma versão antiga direto pra WordPress 7.1). Ambiente de
 * desenvolvimento/demonstração deve controlar versões manualmente, não
 * atualizar sozinho sem ninguém acompanhando.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'auto_update_core', '__return_false' );
add_filter( 'allow_major_auto_core_updates', '__return_false' );
add_filter( 'allow_minor_auto_core_updates', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'automatic_updater_disabled', '__return_true' );
