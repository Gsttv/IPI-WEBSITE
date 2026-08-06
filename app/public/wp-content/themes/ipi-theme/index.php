<?php
/**
 * Template principal (fallback), usado quando nenhum template mais
 * específico se aplica.
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
				<?php if ( have_posts() ) : ?>
					<div class="posts-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;
						?>
					</div>
					<?php the_posts_pagination(
						array(
							'prev_text' => esc_html__( '← Anteriores', 'ipi-theme' ),
							'next_text' => esc_html__( 'Próximos →', 'ipi-theme' ),
						)
					); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	<?php else : ?>
		<?php if ( have_posts() ) : ?>
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
	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
