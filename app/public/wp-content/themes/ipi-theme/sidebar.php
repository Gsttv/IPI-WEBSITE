<?php
/**
 * Barra lateral padrão (usada em posts/páginas com sidebar).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Barra lateral', 'ipi-theme' ); ?>">
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside>
