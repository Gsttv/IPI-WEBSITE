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
	<meta name="theme-color" content="#667058">
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
				// Logo definitiva enviada pelo cliente via Personalizador
				// (Aparência → Personalizar → Identidade do Site) tem
				// prioridade; enquanto isso não é configurado, cai para a
				// logo oficial do IPI já embutida no tema (identidade
				// visual aprovada — ver images/ipi-logo.png). Usamos o PNG
				// com fundo transparente (gerado a partir do ipi-logo.jpg
				// original) em vez do JPG — o header flutua transparente
				// sobre o hero na home, e um fundo branco sólido no logo
				// apareceria como uma caixa por cima do degradê.
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
					$ipi_logo_url  = get_template_directory_uri() . '/images/ipi-logo.png';
					$ipi_logo_link = '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home"><img src="' . esc_url( $ipi_logo_url ) . '" class="custom-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="240" height="64" /></a>';

					// Na home, o nome do site precisa estar em um heading (H1) por
					// SEO/acessibilidade; nas demais páginas isso cabe ao <h1> do
					// próprio conteúdo, então a marca vira só um link.
					if ( is_front_page() && is_home() ) {
						echo '<h1 class="site-logo-heading">' . $ipi_logo_link . '</h1>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- montado acima com esc_url()/esc_attr().
					} else {
						echo $ipi_logo_link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- montado acima com esc_url()/esc_attr().
					}
				endif;
				?>
			<span class="header-trust-badge">
				<span class="header-trust-badge-dot" aria-hidden="true"></span>
				<?php esc_html_e( 'Cuidado · Prevenção · Confiança', 'ipi-theme' ); ?>
			</span>
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
						<a class="btn btn-primary btn-cta" href="<?php echo esc_url( $ipi_whatsapp ); ?>" rel="noopener noreferrer" target="_blank">
							<?php esc_html_e( 'Agendar uma consulta', 'ipi-theme' ); ?>
							<span class="btn-cta-arrow" aria-hidden="true">→</span>
						</a>
					<?php elseif ( $ipi_phone ) : ?>
						<a class="btn btn-primary btn-cta" href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>">
							<?php esc_html_e( 'Ligar agora', 'ipi-theme' ); ?>
							<span class="btn-cta-arrow" aria-hidden="true">→</span>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div><!-- .header-inner -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
