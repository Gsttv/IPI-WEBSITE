<?php
/**
 * Cabeçalho do tema: <head>, faixa de emergência (opcional), skip link,
 * logo/nome do site e navegação principal.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ipi_emergency_text = get_theme_mod( 'ipi_theme_emergency_text', '' );
$ipi_phone           = get_theme_mod( 'ipi_theme_phone', '' );
$ipi_whatsapp        = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#0a6e79">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Pular para o conteúdo', 'ipi-theme' ); ?></a>

<?php if ( $ipi_emergency_text ) : ?>
	<div class="emergency-strip" role="note">
		<?php echo wp_kses_post( $ipi_emergency_text ); ?>
		<?php if ( $ipi_phone ) : ?>
			<a href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>"><?php echo esc_html( $ipi_phone ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<div id="page" class="site">

	<header id="masthead" class="site-header">
		<div class="container header-inner">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
					?>
					<hgroup>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php else : ?>
							<p class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</p>
						<?php endif; ?>
						<?php
						$ipi_description = get_bloginfo( 'description', 'display' );
						if ( $ipi_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo esc_html( $ipi_description ); ?></p>
						<?php endif; ?>
					</hgroup>
					<?php
				endif;
				?>
			</div><!-- .site-branding -->

			<button
				type="button"
				class="menu-toggle"
				aria-controls="primary-menu"
				aria-expanded="false"
			>
				<span class="icon-bars"></span>
				<span class="menu-toggle-label"><?php esc_html_e( 'Menu', 'ipi-theme' ); ?></span>
			</button>

			<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'ipi-theme' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'depth'          => 2,
						)
					);
				else :
					ipi_theme_fallback_menu();
				endif;
				?>
			</nav>

			<?php if ( $ipi_phone || $ipi_whatsapp ) : ?>
				<div class="header-cta">
					<?php if ( $ipi_whatsapp ) : ?>
						<a class="btn btn-primary" href="<?php echo esc_url( $ipi_whatsapp ); ?>" rel="noopener noreferrer" target="_blank">
							<?php esc_html_e( 'Agendar Consulta', 'ipi-theme' ); ?>
						</a>
					<?php elseif ( $ipi_phone ) : ?>
						<a class="btn btn-primary" href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>">
							<?php esc_html_e( 'Ligar agora', 'ipi-theme' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div><!-- .header-inner -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
