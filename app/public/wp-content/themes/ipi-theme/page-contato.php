<?php
/**
 * Template da página "Contato" — mesmo bloco de contato/mapa já usado na
 * home (seção "Contato e Localização"), só que como página própria.
 *
 * Sobrepõe page.php apenas para a página de slug "contato" (hierarquia de
 * templates do WordPress: page-{slug}.php tem prioridade sobre page.php).
 *
 * O conteúdo da Página em si (o que está salvo no wp-admin) não é usado
 * aqui de propósito — ele tinha emojis soltos e endereço desatualizado.
 * Esta página busca os mesmos dados (telefone, WhatsApp, endereço, mapa)
 * direto do Personalizador, fonte única já usada na home — editar lá
 * atualiza as duas ao mesmo tempo, sem duplicar informação em dois
 * lugares que podem ficar dessincronizados.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$ipi_phone    = get_theme_mod( 'ipi_theme_phone', '' );
$ipi_whatsapp = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
$ipi_address  = get_theme_mod( 'ipi_theme_address', "Empresarial RioMar Trade Center 4 e 5 — Sala 211\nAvenida República do Líbano, 256 — Pina, Recife/PE" );
$ipi_map_query = get_theme_mod( 'ipi_theme_map_query', 'Avenida República do Líbano, 256, Pina, Recife - PE, 51110-160' );
$ipi_instagram = get_theme_mod( 'ipi_theme_social_instagram', 'https://www.instagram.com/ipinfecto' );
$ipi_hours_main = __( 'Segunda a sexta · 8h às 18h', 'ipi-theme' );
$ipi_hours_note = __( 'Exceto às sextas-feiras, quando o atendimento encerra às 17h.', 'ipi-theme' );

// Extrai o número do WhatsApp formatado (DD) 9 XXXX-XXXX a partir da URL
// wa.me cadastrada no Personalizador — mesma lógica da home, pra exibir
// o número por extenso em vez de só o link.
$ipi_whatsapp_display = '';
$ipi_whatsapp_digits  = preg_replace( '/\D/', '', (string) $ipi_whatsapp );
if ( 13 === strlen( $ipi_whatsapp_digits ) && str_starts_with( $ipi_whatsapp_digits, '55' ) ) {
	$ipi_ddd  = substr( $ipi_whatsapp_digits, 2, 2 );
	$ipi_rest = substr( $ipi_whatsapp_digits, 4 );
	$ipi_whatsapp_display = sprintf(
		'(%s) %s %s-%s',
		$ipi_ddd,
		substr( $ipi_rest, 0, 1 ),
		substr( $ipi_rest, 1, 4 ),
		substr( $ipi_rest, 5, 4 )
	);
}
?>

<main id="primary" class="site-main page-contato">

	<header class="specialty-hero">
		<div class="container container--narrow">
			<span class="eyebrow"><?php esc_html_e( 'Fale com a gente', 'ipi-theme' ); ?></span>
			<?php the_title( '<h1>', '</h1>' ); ?>
			<p class="lede"><?php esc_html_e( 'Escolha o canal mais conveniente para você — respondemos com atenção e agilidade.', 'ipi-theme' ); ?></p>
		</div>
	</header>

	<div class="container contato-content">
		<div class="map-section-grid">
			<ul class="contact-info">
				<?php if ( $ipi_phone || $ipi_whatsapp_display ) : ?>
					<li class="contact-info-item">
						<span class="contact-info-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
						</span>
						<div>
							<h3><?php esc_html_e( 'Contatos', 'ipi-theme' ); ?></h3>
							<?php if ( $ipi_phone ) : ?>
								<p><a href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>"><?php echo esc_html( $ipi_phone ); ?></a></p>
							<?php endif; ?>
							<?php if ( $ipi_whatsapp_display ) : ?>
								<p>
									<a href="<?php echo esc_url( $ipi_whatsapp ); ?>" rel="noopener noreferrer" target="_blank">
										<?php echo esc_html( $ipi_whatsapp_display ); ?> <?php esc_html_e( '(WhatsApp)', 'ipi-theme' ); ?>
									</a>
								</p>
							<?php endif; ?>
						</div>
					</li>
				<?php endif; ?>

				<li class="contact-info-item">
					<span class="contact-info-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
					</span>
					<div>
						<h3><?php esc_html_e( 'Horário de funcionamento', 'ipi-theme' ); ?></h3>
						<p><?php echo esc_html( $ipi_hours_main ); ?></p>
						<p class="contact-info-note"><?php echo esc_html( $ipi_hours_note ); ?></p>
					</div>
				</li>

				<li class="contact-info-item">
					<span class="contact-info-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.5 7-11.5A7 7 0 0 0 5 9.5C5 14.5 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.3"/></svg>
					</span>
					<div>
						<h3><?php esc_html_e( 'Endereço', 'ipi-theme' ); ?></h3>
						<p><?php echo nl2br( esc_html( $ipi_address ) ); ?></p>
						<p>
							<a class="btn btn-secondary" href="https://www.google.com/maps/dir/?api=1&destination=<?php echo rawurlencode( $ipi_map_query ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'Abrir no Google Maps', 'ipi-theme' ); ?>
							</a>
						</p>
					</div>
				</li>

				<?php if ( $ipi_instagram ) : ?>
					<li class="contact-info-item">
						<span class="contact-info-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r="0.8" fill="currentColor" stroke="none"/></svg>
						</span>
						<div>
							<h3><?php esc_html_e( 'Instagram', 'ipi-theme' ); ?></h3>
							<p>
								<a href="<?php echo esc_url( $ipi_instagram ); ?>" rel="noopener noreferrer" target="_blank">@ipinfecto</a>
							</p>
						</div>
					</li>
				<?php endif; ?>
			</ul>

			<div class="map-embed map-embed--compact">
				<iframe
					src="https://www.google.com/maps?q=<?php echo rawurlencode( $ipi_map_query ); ?>&output=embed"
					title="<?php esc_attr_e( 'Mapa com a localização do IPI no Google Maps', 'ipi-theme' ); ?>"
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
				></iframe>
			</div>
		</div>
	</div>

</main><!-- #primary -->

<?php
get_footer();
