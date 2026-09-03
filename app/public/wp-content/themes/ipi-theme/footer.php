<?php
/**
 * Rodapé do tema: identidade, colunas de widgets, menu do rodapé e
 * copyright. O link do Instagram não se repete aqui — já fica na seção
 * "Contato e Localização" da home; ter os dois virou redundância visual.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ipi_footer_text  = get_theme_mod( 'ipi_theme_footer_text', __( 'Instituto Pernambucano de Infectologia. Todos os direitos reservados.', 'ipi-theme' ) );
$ipi_whatsapp_url = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
$ipi_about_text   = get_theme_mod( 'ipi_theme_about_text', __( 'Cuidado especializado, do diagnóstico ao acompanhamento.', 'ipi-theme' ) );
?>

	</div><!-- #content -->

	<?php if ( $ipi_whatsapp_url ) : ?>
		<a
			class="whatsapp-fab"
			href="<?php echo esc_url( $ipi_whatsapp_url ); ?>"
			rel="noopener noreferrer"
			target="_blank"
			aria-label="<?php esc_attr_e( 'Fale com a gente pelo WhatsApp', 'ipi-theme' ); ?>"
		>
			<?php echo ipi_theme_get_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG fixo do tema, sem dado de usuário. ?>
		</a>
	<?php endif; ?>

	<button
		type="button"
		class="back-to-top"
		aria-label="<?php esc_attr_e( 'Voltar ao topo', 'ipi-theme' ); ?>"
		hidden
	>
		<span aria-hidden="true">↑</span>
	</button>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-about">
				<?php
				// Só o ícone (sem o lockup "Instituto Pernambucano de
				// Infectologia" por extenso) — o nome completo já está no
				// header, no topo de toda página; aqui, ao lado da frase de
				// apoio, o ícone sozinho já basta pra identificar a marca.
				// Versão creme pronta pro fundo escuro do rodapé, sem
				// precisar de filtro CSS.
				?>
				<img
					class="footer-about-logo"
					src="<?php echo esc_url( get_template_directory_uri() . '/images/ipi-icone-creme.svg' ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="40"
					height="40"
					loading="lazy"
					decoding="async"
				/>
				<p class="footer-about-text"><?php echo esc_html( $ipi_about_text ); ?></p>
			</div>

			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="footer-widgets">
					<?php foreach ( array( 'footer-1', 'footer-2', 'footer-3' ) as $ipi_footer_sidebar ) : ?>
						<?php if ( is_active_sidebar( $ipi_footer_sidebar ) ) : ?>
							<div class="footer-widget-area">
								<?php dynamic_sidebar( $ipi_footer_sidebar ); ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="footer-bottom">
				<p class="footer-copyright">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $ipi_footer_text ); ?>
				</p>

				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="footer-bottom-nav" aria-label="<?php esc_attr_e( 'Menu do rodapé', 'ipi-theme' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_id'        => 'footer-menu',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
