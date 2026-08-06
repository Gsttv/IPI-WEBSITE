<?php
/**
 * Template part: exibido quando nenhum conteúdo é encontrado.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nada encontrado', 'ipi-theme' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %s: link para criar um novo post. */
						__( 'Pronto para publicar seu primeiro conteúdo? <a href="%s">Comece por aqui</a>.', 'ipi-theme' ),
						array( 'a' => array( 'href' => array() ) )
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Desculpe, nenhum resultado corresponde à sua busca. Tente novamente com outros termos.', 'ipi-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'Não foi possível encontrar conteúdo para exibir. Que tal usar a busca?', 'ipi-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
