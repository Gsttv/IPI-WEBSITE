<?php
/**
 * Formulário de busca acessível.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ipi_search_id = 'search-form-' . wp_unique_id();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $ipi_search_id ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Buscar por:', 'ipi-theme' ); ?></span>
	</label>
	<input
		type="search"
		id="<?php echo esc_attr( $ipi_search_id ); ?>"
		class="search-field"
		placeholder="<?php echo esc_attr_x( 'Buscar no site&hellip;', 'placeholder', 'ipi-theme' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
	/>
	<button type="submit" class="btn btn-primary search-submit">
		<?php echo esc_html_x( 'Buscar', 'submit button', 'ipi-theme' ); ?>
	</button>
</form>
