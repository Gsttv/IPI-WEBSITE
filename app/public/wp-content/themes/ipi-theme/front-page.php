<?php
/**
 * Template da página inicial institucional do IPI.
 *
 * Funciona tanto com uma Página estática definida em
 * Ajustes > Leitura (o título/conteúdo dela é usado no hero) quanto sem
 * nenhuma configurada — nesse caso, textos padrão de exemplo são exibidos.
 * As seções institucionais (especialidades, confiança, CTA) têm texto
 * fixo pensado para o IPI; podem ser convertidas em campos do
 * Personalizador ou padrões de bloco (patterns) quando o conteúdo
 * definitivo estiver definido.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Busca a Página estática da home (se houver) via get_queried_object(),
// sem avançar/rebobinar o ponteiro do loop principal com the_post()/
// rewind_posts() — evita qualquer efeito colateral em código de terceiros
// que dependa do disparo único do hook "the_post".
$ipi_front_page = ( 'page' === get_option( 'show_on_front' ) ) ? get_queried_object() : null;
$ipi_front_page = ( $ipi_front_page instanceof WP_Post ) ? $ipi_front_page : null;

$ipi_hero_title   = __( 'Diagnóstico preciso e tratamento humanizado para doenças infecciosas', 'ipi-theme' );
$ipi_hero_lede    = __( 'O IPI é referência em Recife no cuidado com doenças infecciosas — da consulta especializada ao acompanhamento contínuo, com uma equipe médica dedicada a te ouvir antes de tratar.', 'ipi-theme' );
$ipi_hero_content = '';

if ( $ipi_front_page ) {
	if ( $ipi_front_page->post_title ) {
		$ipi_hero_title = get_the_title( $ipi_front_page );
	}
	if ( has_excerpt( $ipi_front_page ) ) {
		$ipi_hero_lede = get_the_excerpt( $ipi_front_page );
	}
	$ipi_hero_content = apply_filters( 'the_content', $ipi_front_page->post_content );
}

$ipi_whatsapp = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
$ipi_phone    = get_theme_mod( 'ipi_theme_phone', '' );
$ipi_address  = get_theme_mod( 'ipi_theme_address', "Empresarial RioMar Trade Center 5 — Sala 211\nAvenida República do Líbano, 251 — Pina, Recife/PE" );

// String de endereço "achatada" (sem quebra de linha) para usar como termo
// de busca do Google Maps — o campo do Personalizador aceita múltiplas
// linhas, mas a query do mapa fica mais confiável como uma frase só.
$ipi_map_query = str_replace( array( "\r\n", "\n" ), ', ', $ipi_address );

$ipi_instagram = get_theme_mod( 'ipi_theme_social_instagram', 'https://www.instagram.com/ipinfecto' );
$ipi_hours_main = __( 'Segunda a sexta · 8h às 18h', 'ipi-theme' );
$ipi_hours_note = __( 'Exceto às sextas-feiras, quando o atendimento encerra às 17h.', 'ipi-theme' );

// Extrai o número do WhatsApp formatado (DD) 9 XXXX-XXXX a partir da URL
// wa.me cadastrada no Personalizador, em vez de manter um segundo campo
// de telefone duplicado só para exibição.
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

// Fotos individuais de cada médico, nomeadas pelo primeiro nome em
// /images/. A badge "Responsável Técnica" não é exibida no card da
// equipe a pedido do cliente — essa informação segue no rodapé do site,
// conforme exigência do CFM.
$ipi_images_uri = get_template_directory_uri() . '/images/';

$ipi_team = array(
	array(
		'name'  => 'Dr. Paulo Sérgio Ramos',
		'crm'   => 'CRM-PE 11049',
		'role'  => __( 'Infectologia', 'ipi-theme' ),
		'photo' => $ipi_images_uri . 'paulo.jpeg',
	),
	array(
		'name'  => 'Dra. Fabiana Gonzaga',
		'crm'   => 'CRM-PE 16724 | RQE 2246',
		'role'  => __( 'Infectologia', 'ipi-theme' ),
		'photo' => $ipi_images_uri . 'fabiana.jpeg',
	),
	array(
		'name'  => 'Dra. Marcelia Soares',
		'crm'   => 'CRM-PE 19196',
		'role'  => __( 'Infectologia', 'ipi-theme' ),
		'photo' => $ipi_images_uri . 'marcelia.jpeg',
	),
	array(
		'name'  => 'Dr. Lucas Caheté',
		'crm'   => 'CRM-PE 19711',
		'role'  => __( 'Infectologia', 'ipi-theme' ),
		'photo' => $ipi_images_uri . 'lucas.jpeg',
	),
	array(
		'name'  => 'Dra. Marta Iglis',
		'crm'   => 'CRM-PE 17246',
		'role'  => __( 'Infectologia', 'ipi-theme' ),
		'photo' => $ipi_images_uri . 'marta.jpeg',
	),
);

$ipi_faqs = array(
	array(
		'question' => __( 'Quais convênios o IPI aceita?', 'ipi-theme' ),
		'answer'   => __( 'Para confirmar se o seu convênio é aceito, fale com a nossa equipe pelo WhatsApp ou telefone — respondemos rapidamente com todas as informações atualizadas sobre planos de saúde.', 'ipi-theme' ),
	),
	array(
		'question' => __( 'Preciso de encaminhamento médico para marcar uma consulta?', 'ipi-theme' ),
		'answer'   => __( 'Não. Você pode agendar uma consulta particular diretamente com nossos especialistas, sem necessidade de encaminhamento. Caso utilize convênio, recomendamos verificar se o seu plano exige guia de encaminhamento.', 'ipi-theme' ),
	),
	array(
		'question' => __( 'O IPI atende casos de urgência?', 'ipi-theme' ),
		'answer'   => __( 'Nosso atendimento é feito por consulta agendada, de segunda a sexta. Em caso de sintomas graves ou risco à saúde, procure imediatamente um pronto-socorro. Para orientação sobre agendamento prioritário, fale conosco pelo WhatsApp.', 'ipi-theme' ),
	),
	array(
		'question' => __( 'O atendimento é sigiloso?', 'ipi-theme' ),
		'answer'   => __( 'Sim. O sigilo do seu atendimento é garantido pelo Código de Ética Médica e é um compromisso inegociável do IPI — do primeiro contato ao acompanhamento contínuo, sua privacidade é protegida em todas as etapas.', 'ipi-theme' ),
	),
	array(
		'question' => __( 'Preciso levar exames anteriores para a consulta?', 'ipi-theme' ),
		'answer'   => __( 'Não é obrigatório, mas se você já tiver exames ou laudos anteriores, leve-os — eles ajudam o médico a entender seu histórico com mais precisão logo na primeira consulta.', 'ipi-theme' ),
	),
	array(
		'question' => __( 'Quais as formas de pagamento para consulta particular?', 'ipi-theme' ),
		'answer'   => __( 'Aceitamos as principais formas de pagamento. Para detalhes sobre valores e condições, entre em contato com nossa equipe pelo WhatsApp.', 'ipi-theme' ),
	),
);

$ipi_specialties = array(
	array(
		'icon'  => '🩺',
		'title' => __( 'Consultas Especializadas', 'ipi-theme' ),
		'text'  => __( 'Avaliação clínica completa conduzida por infectologistas experientes, com investigação cuidadosa até a definição do diagnóstico e do plano de tratamento mais adequado para você.', 'ipi-theme' ),
	),
	array(
		'icon'  => '🔬',
		'title' => __( 'Diagnóstico Laboratorial', 'ipi-theme' ),
		'text'  => __( 'Solicitação e interpretação de exames específicos, em parceria com laboratórios de referência, para um diagnóstico rápido e preciso.', 'ipi-theme' ),
	),
	array(
		'icon'  => '🧬',
		'title' => __( 'HIV/Aids e ISTs', 'ipi-theme' ),
		'text'  => __( 'Acompanhamento contínuo, sigiloso e sem julgamentos, com terapia antirretroviral atualizada e suporte em cada etapa do tratamento.', 'ipi-theme' ),
	),
	array(
		'icon'  => '🏥',
		'title' => __( 'Doenças Infecciosas Complexas', 'ipi-theme' ),
		'text'  => __( 'Manejo clínico de infecções hospitalares, tropicais e emergentes, com protocolos atualizados e conduta baseada em evidência.', 'ipi-theme' ),
	),
	array(
		'icon'  => '📋',
		'title' => __( 'Acompanhamento Clínico Contínuo', 'ipi-theme' ),
		'text'  => __( 'Consultas de retorno e monitoramento de tratamentos de longo prazo, para que você nunca esteja sozinho durante o cuidado com a sua saúde.', 'ipi-theme' ),
	),
);
?>

<main id="primary" class="site-main">

	<section class="hero">
		<div class="container hero-inner">
			<div class="hero-content">
				<span class="eyebrow"><?php esc_html_e( 'Instituto Pernambucano de Infectologia', 'ipi-theme' ); ?></span>
				<h1><?php echo esc_html( $ipi_hero_title ); ?></h1>
				<p class="lede"><?php echo esc_html( $ipi_hero_lede ); ?></p>

				<div class="hero-actions">
					<?php if ( $ipi_whatsapp ) : ?>
						<a class="btn btn-primary" href="<?php echo esc_url( $ipi_whatsapp ); ?>" rel="noopener noreferrer" target="_blank">
							<?php esc_html_e( '📲 Agende sua consulta', 'ipi-theme' ); ?>
						</a>
					<?php elseif ( $ipi_phone ) : ?>
						<a class="btn btn-primary" href="<?php echo esc_attr( ipi_theme_get_tel_href( $ipi_phone ) ); ?>">
							<?php esc_html_e( 'Ligar agora', 'ipi-theme' ); ?>
						</a>
					<?php else : ?>
						<a class="btn btn-primary" href="#especialidades">
							<?php esc_html_e( 'Conheça nossas especialidades', 'ipi-theme' ); ?>
						</a>
					<?php endif; ?>
					<?php $ipi_about_page = get_page_by_path( 'sobre' ); ?>
					<a class="btn btn-secondary" href="<?php echo esc_url( $ipi_about_page ? get_permalink( $ipi_about_page ) : home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Sobre o Instituto', 'ipi-theme' ); ?>
					</a>
				</div>
			</div>

			<div class="hero-media" aria-hidden="true">
				<?php if ( $ipi_front_page && has_post_thumbnail( $ipi_front_page ) ) : ?>
					<?php
					// get_the_post_thumbnail() recebe o post explicitamente, em vez de
					// depender do ponteiro global $post — mais seguro fora de um loop.
					echo get_the_post_thumbnail(
						$ipi_front_page,
						'ipi-hero',
						array(
							'fetchpriority' => 'high',
							'loading'       => 'eager',
						)
					);
					?>
				<?php else : ?>
					<span style="font-size: 4rem;">🏥</span>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="trust-strip">
			<span><?php esc_html_e( 'Equipe médica especializada', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Atendimento humanizado', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Infraestrutura própria', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Referência em Pernambuco', 'ipi-theme' ); ?></span>
		</div>
	</div>

	<section id="sobre" class="section">
		<div class="container container--narrow entry-content">
			<header class="section-header">
				<span class="eyebrow"><?php esc_html_e( 'Quem somos', 'ipi-theme' ); ?></span>
				<h2><?php esc_html_e( 'Cuidado especializado, do diagnóstico ao acompanhamento', 'ipi-theme' ); ?></h2>
			</header>
			<p>
				<?php esc_html_e( 'O Instituto Pernambucano de Infectologia (IPI) existe para oferecer, em Recife, um espaço de referência no diagnóstico e tratamento de doenças infecciosas — com o rigor técnico de uma equipe especializada e o acolhimento que todo paciente merece ao cuidar da própria saúde.', 'ipi-theme' ); ?>
			</p>
			<p>
				<?php esc_html_e( 'Sabemos que buscar ajuda para uma condição infecciosa muitas vezes vem acompanhado de dúvidas, urgência ou receio. Por isso, conduzimos cada consulta com escuta atenta, sigilo absoluto e decisões clínicas baseadas em evidência — nunca em pressa.', 'ipi-theme' ); ?>
			</p>
		</div>

		<div class="container">
			<header class="section-header">
				<h3><?php esc_html_e( 'Nossa equipe médica', 'ipi-theme' ); ?></h3>
				<p><?php esc_html_e( 'Cada consulta no IPI é conduzida por médicos especialistas, com registro ativo no Conselho Regional de Medicina de Pernambuco.', 'ipi-theme' ); ?></p>
			</header>

			<div class="grid">
				<?php foreach ( $ipi_team as $ipi_doctor ) : ?>
					<article class="team-card">
						<img
							class="team-photo"
							src="<?php echo esc_url( $ipi_doctor['photo'] ); ?>"
							alt="<?php echo esc_attr( $ipi_doctor['name'] ); ?>"
							loading="lazy"
							decoding="async"
						/>
						<div class="team-body">
							<h4 class="team-name"><?php echo esc_html( $ipi_doctor['name'] ); ?></h4>
							<span class="badge"><?php echo esc_html( $ipi_doctor['role'] ); ?></span>
							<p class="team-crm"><?php echo esc_html( $ipi_doctor['crm'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<?php $ipi_team_page = get_page_by_path( 'corpo-clinico' ); ?>
			<?php if ( $ipi_team_page ) : ?>
				<p>
					<a class="btn btn-secondary" href="<?php echo esc_url( get_permalink( $ipi_team_page ) ); ?>">
						<?php esc_html_e( 'Conheça quem vai cuidar de você', 'ipi-theme' ); ?>
					</a>
				</p>
			<?php endif; ?>
		</div>
	</section>

	<section id="especialidades" class="section">
		<div class="container">
			<header class="section-header">
				<span class="eyebrow"><?php esc_html_e( 'O que tratamos', 'ipi-theme' ); ?></span>
				<h2><?php esc_html_e( 'Cuidado completo em doenças infecciosas', 'ipi-theme' ); ?></h2>
				<p><?php esc_html_e( 'Do diagnóstico ao acompanhamento contínuo, cada especialidade abaixo recebe o mesmo padrão de atenção e cuidado técnico do IPI.', 'ipi-theme' ); ?></p>
			</header>

			<div class="grid">
				<?php foreach ( $ipi_specialties as $ipi_item ) : ?>
					<div class="card">
						<div class="card-icon" aria-hidden="true"><?php echo esc_html( $ipi_item['icon'] ); ?></div>
						<h3><?php echo esc_html( $ipi_item['title'] ); ?></h3>
						<p><?php echo esc_html( $ipi_item['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php if ( $ipi_hero_content ) : ?>
		<section class="section section--alt">
			<div class="container container--narrow entry-content">
				<?php echo wp_kses_post( $ipi_hero_content ); ?>
			</div>
		</section>
	<?php endif; ?>

	<section id="faq" class="section">
		<div class="container container--narrow">
			<header class="section-header">
				<span class="eyebrow"><?php esc_html_e( 'Perguntas que ouvimos bastante', 'ipi-theme' ); ?></span>
				<h2><?php esc_html_e( 'Ficou com alguma dúvida?', 'ipi-theme' ); ?></h2>
				<p><?php esc_html_e( 'Reunimos aqui as perguntas mais comuns dos nossos pacientes. Não encontrou a sua? Fale com a gente, é rapidinho.', 'ipi-theme' ); ?></p>
			</header>

			<div class="faq-list">
				<?php foreach ( $ipi_faqs as $ipi_faq ) : ?>
					<details class="faq-item">
						<summary class="faq-question"><?php echo esc_html( $ipi_faq['question'] ); ?></summary>
						<p class="faq-answer"><?php echo esc_html( $ipi_faq['answer'] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-banner">
				<div>
					<h2><?php esc_html_e( 'Pronto para cuidar da sua saúde com quem entende do assunto?', 'ipi-theme' ); ?></h2>
					<p><?php esc_html_e( 'Agende sua consulta com o Instituto Pernambucano de Infectologia e tenha diagnóstico e tratamento conduzidos por especialistas, com toda a atenção que você merece.', 'ipi-theme' ); ?></p>
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
	</section>

	<?php
	$ipi_recent_posts = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	?>

	<?php if ( $ipi_recent_posts->have_posts() ) : ?>
		<section class="section section--alt">
			<div class="container">
				<header class="section-header">
					<span class="eyebrow"><?php esc_html_e( 'Conteúdos', 'ipi-theme' ); ?></span>
					<h2><?php esc_html_e( 'Vídeos, artigos e materiais educativos', 'ipi-theme' ); ?></h2>
					<p><?php esc_html_e( 'Conteúdo produzido pela nossa equipe médica para te ajudar a entender melhor a sua saúde — em texto, imagem e vídeo.', 'ipi-theme' ); ?></p>
				</header>

				<div class="posts-grid">
					<?php
					while ( $ipi_recent_posts->have_posts() ) :
						$ipi_recent_posts->the_post();
						get_template_part( 'template-parts/content' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>

				<?php
				$ipi_blog_page_id = (int) get_option( 'page_for_posts' );
				$ipi_blog_url     = $ipi_blog_page_id ? get_permalink( $ipi_blog_page_id ) : home_url( '/' );
				?>
				<p>
					<a class="btn btn-secondary" href="<?php echo esc_url( $ipi_blog_url ); ?>">
						<?php esc_html_e( 'Ver todas as publicações', 'ipi-theme' ); ?>
					</a>
				</p>
			</div>
		</section>
	<?php endif; ?>

	<section id="localizacao" class="section">
		<div class="container">
			<h2 class="localizacao-title"><?php esc_html_e( 'Contato e Localização', 'ipi-theme' ); ?></h2>

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
	</section>

	</section>


</main><!-- #primary -->

<?php
get_footer();
