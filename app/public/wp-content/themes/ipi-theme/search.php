<?php
/**
 * Template para resultados de busca.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main container section">

	<header class="page-header section-header">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: termo buscado. */
				esc_html__( 'Resultados da busca por: %s', 'ipi-theme' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination(
			array(
				'prev_text' => esc_html__( '← Anteriores', 'ipi-theme' ),
				'next_text' => esc_html__( 'Próximos →', 'ipi-theme' ),
			)
		);
		?>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
