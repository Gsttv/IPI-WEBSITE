<?php
/**
 * Template da página "Áreas de Atuação" — mesma grade de especialidades
 * exibida na Home (seção #especialidades), como página própria e
 * independente, pra dar ao item "Áreas de Atuação" do menu um destino
 * de verdade em vez de só rolar até a Home.
 *
 * Sobrepõe page.php apenas para a página de slug "areas-de-atuacao"
 * (hierarquia de templates do WordPress: page-{slug}.php tem prioridade
 * sobre page.php). Dados dos cards centralizados em
 * ipi_theme_get_specialties(), ver inc/template-tags.php — a Home usa a
 * mesma fonte, então os dois lugares nunca dessincronizam.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main container section">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header section-header">
			<span class="eyebrow"><?php esc_html_e( 'O que tratamos', 'ipi-theme' ); ?></span>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<p>
				<?php esc_html_e( 'Do diagnóstico ao acompanhamento contínuo, cada especialidade abaixo recebe o mesmo padrão de atenção e cuidado técnico do IPI.', 'ipi-theme' ); ?>
			</p>
		</header>

		<?php get_template_part( 'template-parts/specialties-grid' ); ?>

	<?php endwhile; ?>

</main><!-- #primary -->

<?php
get_footer();
