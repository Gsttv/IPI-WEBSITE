<?php
/**
 * Template Name: Especialidade
 *
 * Página individual de uma área de atuação/especialidade (ex.: "HIV/Aids e
 * ISTs", "Diagnóstico Laboratorial"). Atribuível a qualquer Página pelo
 * painel "Atributos da página" no wp-admin — não depende de slug fixo.
 *
 * Dá ao IPI a mesma arquitetura de navegação de referência apontada pelo
 * cliente (rafaelmalta.com.br): cada área de atuação com URL própria, em
 * vez de só uma seção dentro da home. Os cards de especialidade na home
 * (front-page.php) já linkam para cá automaticamente assim que uma Página
 * com este template existir com slug igual ao título da especialidade.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$ipi_whatsapp = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
$ipi_phone    = get_theme_mod( 'ipi_theme_phone', '' );

// Outras páginas que usam este mesmo template — vira a "navegação
// relacionada" no rodapé do conteúdo, para o visitante continuar
// circulando pelas especialidades em vez de esbarrar num beco sem saída.
$ipi_related_query = new WP_Query(
	array(
		'post_type'              => 'page',
		'posts_per_page'         => -1,
		'meta_key'                => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'meta_value'               => 'template-especialidade.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		'post__not_in'            => array( get_the_ID() ),
		'orderby'                 => 'menu_order title',
		'order'                   => 'ASC',
		'no_found_rows'           => true,
		'update_post_term_cache'  => false,
	)
);
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="specialty-hero">
			<div class="container container--narrow">
				<span class="eyebrow"><?php esc_html_e( 'Área de atuação', 'ipi-theme' ); ?></span>
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php if ( has_excerpt() ) : ?>
					<p class="lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<div class="container container--narrow entry-content section">
			<?php the_content(); ?>
		</div>

		<div class="container container--narrow">
			<div class="cta-banner cta-banner--inline">
				<div>
					<h2><?php esc_html_e( 'Pronto para cuidar da sua saúde?', 'ipi-theme' ); ?></h2>
					<p><?php esc_html_e( 'Fale com a nossa equipe e agende sua consulta.', 'ipi-theme' ); ?></p>
				</div>
				<div class="hero-actions">
					<?php if ( $ipi_whatsapp ) : ?>
						<a class="btn btn-secondary" href="<?php echo esc_url( $ipi_whatsapp ); ?>" rel="noopener noreferrer" target="_blank">
							<?php esc_html_e( '📲 Agende sua consulta', 'ipi-theme' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $ipi_phone ) : ?>
						<a class="btn btn-secondary" href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>">
							<?php echo esc_html( $ipi_phone ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php endwhile; ?>

	<?php if ( $ipi_related_query->have_posts() ) : ?>
		<section class="section section--alt">
			<div class="container">
				<header class="section-header">
					<span class="eyebrow"><?php esc_html_e( 'Continue conhecendo o IPI', 'ipi-theme' ); ?></span>
					<h2><?php esc_html_e( 'Outras áreas de atuação', 'ipi-theme' ); ?></h2>
				</header>

				<div class="grid">
					<?php
					while ( $ipi_related_query->have_posts() ) :
						$ipi_related_query->the_post();
						?>
						<a class="card card--link" href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
							<?php if ( has_excerpt() ) : ?>
								<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
							<span class="card-link-affordance" aria-hidden="true"><?php esc_html_e( 'Saiba mais', 'ipi-theme' ); ?> →</span>
						</a>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();