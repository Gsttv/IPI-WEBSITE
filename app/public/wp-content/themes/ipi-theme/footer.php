<?php
/**
 * Rodapé do tema: colunas de widgets, menu do rodapé, redes sociais e copyright.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ipi_social_links = ipi_theme_get_social_links();
$ipi_footer_text  = get_theme_mod( 'ipi_theme_footer_text', __( 'Instituto Pernambucano de Infectologia. Todos os direitos reservados.', 'ipi-theme' ) );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
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
									<?php echo esc_html( ucfirst( $network ) ); ?>
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
