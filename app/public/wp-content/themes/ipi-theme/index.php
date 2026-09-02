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

	<?php if ( is_home() && ! is_front_page() ) : ?>
		<?php
		// index.php também serve de fallback genérico (busca, categoria
		// etc.) — o cabeçalho abaixo só faz sentido quando esta é
		// especificamente a página de posts configurada em Ajustes >
		// Leitura (ver page_for_posts, definido em front-page.php/menu).
		?>
		<header class="section-header">
			<span class="eyebrow"><?php esc_html_e( 'Conteúdos', 'ipi-theme' ); ?></span>
			<h1><?php esc_html_e( 'Vídeos, artigos e materiais educativos', 'ipi-theme' ); ?></h1>
			<p><?php esc_html_e( 'Conteúdo produzido pela nossa equipe médica para te ajudar a entender melhor a sua saúde — em texto, imagem e vídeo.', 'ipi-theme' ); ?></p>
		</header>
	<?php endif; ?>

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
