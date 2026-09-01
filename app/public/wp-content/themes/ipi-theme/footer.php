<?php
/**
 * Rodapé do tema: identidade, colunas de widgets, menu do rodapé, redes
 * sociais e copyright.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ipi_social_links = ipi_theme_get_social_links();
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
				<?php if ( has_custom_logo() ) : ?>
					<div class="footer-about-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<img
						class="footer-about-logo"
						src="<?php echo esc_url( get_template_directory_uri() . '/images/ipi-logo.png' ); ?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
						width="180"
						height="48"
						loading="lazy"
						decoding="async"
					/>
				<?php endif; ?>
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

				<?php if ( ! empty( $ipi_social_links ) ) : ?>
					<ul class="social-links" aria-label="<?php esc_attr_e( 'Redes sociais', 'ipi-theme' ); ?>">
						<?php foreach ( $ipi_social_links as $network => $url ) : ?>
							<li>
								<a href="<?php echo esc_url( $url ); ?>" rel="noopener noreferrer" target="_blank">
									<?php echo ipi_theme_get_icon( $network ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG fixo do tema, sem dado de usuário. ?>
									<span class="screen-reader-text"><?php echo esc_html( ucfirst( $network ) ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
