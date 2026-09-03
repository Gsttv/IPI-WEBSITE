<?php
/**
 * Template da página "Sobre o IPI" — texto institucional ao lado de uma
 * foto real da equipe, em vez de só parágrafos soltos.
 *
 * Sobrepõe page.php apenas para a página de slug "sobre" (hierarquia de
 * templates do WordPress: page-{slug}.php tem prioridade sobre page.php).
 *
 * O texto continua vindo de the_content() — editável normalmente pelo
 * wp-admin, como qualquer Página — só o layout ao redor dele que muda.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="specialty-hero">
			<div class="container container--narrow">
				<?php
				// Título do H1 fixo em vez de the_title(): o título da Página no
				// wp-admin ("Sobre o IPI") é só o nome interno/slug de referência;
				// o que aparece no site é "Conheça o IPI", igual ao item do menu
				// que leva pra cá.
				?>
				<span class="eyebrow"><?php esc_html_e( 'Quem somos', 'ipi-theme' ); ?></span>
				<h1><?php esc_html_e( 'Conheça o IPI', 'ipi-theme' ); ?></h1>
				<p class="lede"><?php esc_html_e( 'Diagnóstico preciso e cuidado humano, do primeiro contato ao acompanhamento contínuo.', 'ipi-theme' ); ?></p>
			</div>
		</header>

		<div class="container sobre-content">
			<div class="about-grid">
				<div class="about-text entry-content">
					<?php the_content(); ?>
				</div>

				<div class="about-media-wrap">
					<div class="about-media">
						<img
							src="<?php echo esc_url( get_template_directory_uri() . '/images/ipi-equipe-sobre.jpg' ); ?>"
							alt="<?php esc_attr_e( 'Equipe médica do IPI', 'ipi-theme' ); ?>"
							loading="lazy"
							decoding="async"
						/>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; ?>

</main><!-- #primary -->

<?php
get_footer();
