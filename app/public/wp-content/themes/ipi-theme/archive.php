<?php
/**
 * Template para arquivos (categorias, tags, autor, data, tipos de post).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main container section">

	<div class="content-area-with-sidebar">
		<div>
			<?php if ( have_posts() ) : ?>

				<header class="page-header section-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header>

				<div class="posts-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
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
		</div>
		<?php get_sidebar(); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
