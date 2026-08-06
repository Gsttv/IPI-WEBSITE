<?php
/**
 * Template part: bloco de metadados do post (data + autor), reutilizado
 * por template-parts/content.php e template-parts/content-single.php.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="entry-meta">
	<?php
	ipi_theme_posted_on();
	ipi_theme_posted_by();
	?>
</div>
