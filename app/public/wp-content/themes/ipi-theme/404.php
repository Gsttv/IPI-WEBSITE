<?php
/**
 * Template exibido para erros 404 (página não encontrada).
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main container section text-center">

	<section class="error-404 not-found container--narrow">
		<span class="badge"><?php esc_html_e( 'Erro 404', 'ipi-theme' ); ?></span>
		<h1 class="page-title"><?php esc_html_e( 'Página não encontrada', 'ipi-theme' ); ?></h1>
		<p class="lede">
			<?php esc_html_e( 'O conteúdo que você procura pode ter sido removido, renomeado ou está temporariamente indisponível. Use a busca abaixo ou volte para a página inicial.', 'ipi-theme' ); ?>
		</p>

		<div class="hero-actions text-center" style="justify-content:center;">
			<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Voltar para a página inicial', 'ipi-theme' ); ?>
			</a>
		</div>

		<div style="margin-top: var(--space-lg);">
			<?php get_search_form(); ?>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();
