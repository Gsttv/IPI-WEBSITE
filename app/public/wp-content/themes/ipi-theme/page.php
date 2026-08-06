<?php
/**
 * Template para páginas estáticas.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main container section">

	<?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
		<div class="content-area-with-sidebar">
			<div>
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	<?php else : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
