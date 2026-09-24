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

// Título do hero como uma frase só, de propósito — nada de duas frases
// cortadas em blocos separados. O contraste de peso/cor entre as duas
// metades (peso cheio e tinta escura na primeira, peso leve e verde da
// marca na segunda) continua, só que fluindo inline na mesma sentença,
// não empilhado em linhas forçadas. Só é possível dividir assim porque o
// texto é fixo; se o cliente configurar uma Página estática como home
// (com título próprio), a marcação abaixo cai para texto simples — não
// faz sentido dividir automaticamente um título arbitrário do wp-admin.
$ipi_hero_title_lead  = __( 'Diagnóstico preciso,', 'ipi-theme' );
$ipi_hero_title_rest  = __( 'cuidado humanizado.', 'ipi-theme' );
$ipi_hero_title       = $ipi_hero_title_lead . ' ' . $ipi_hero_title_rest;
$ipi_hero_title_split = true;
$ipi_hero_lede         = __( 'Da consulta especializada ao acompanhamento contínuo, com uma equipe dedicada em cada etapa do seu tratamento.', 'ipi-theme' );
$ipi_hero_content      = '';

if ( $ipi_front_page ) {
	if ( $ipi_front_page->post_title ) {
		$ipi_hero_title       = get_the_title( $ipi_front_page );
		$ipi_hero_title_split = false;
	}
	if ( has_excerpt( $ipi_front_page ) ) {
		$ipi_hero_lede = get_the_excerpt( $ipi_front_page );
	}
	$ipi_hero_content = apply_filters( 'the_content', $ipi_front_page->post_content );
}

$ipi_whatsapp = get_theme_mod( 'ipi_theme_whatsapp_url', '' );
$ipi_phone    = get_theme_mod( 'ipi_theme_phone', '' );
$ipi_address  = get_theme_mod( 'ipi_theme_address', "Empresarial RioMar Trade Center 4 e 5 — Sala 211\nAvenida República do Líbano, 256 — Pina, Recife/PE" );

// Query do mapa é separada do endereço exibido de propósito: "Sala 211"/
// "Trade Center 4 e 5" não são coisas que o geocodificador do Google
// consegue resolver (não são endereços mapeáveis) — incluir isso na
// busca fazia o pino cair no lugar errado. Rua + número + bairro +
// cidade + CEP, confirmado pelo cliente, é o que geocodifica com
// precisão. Editável em Personalizar → Informações Institucionais →
// "Endereço para o mapa".
$ipi_map_query = get_theme_mod( 'ipi_theme_map_query', 'Avenida República do Líbano, 256, Pina, Recife - PE, 51110-160' );

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

// 'health_plans' tem 3 estados possíveis, não só vazio/preenchido:
// array() = ainda não informado (mostra convite pra confirmar por
// WhatsApp); array com itens = lista de fato; false = o médico não
// atende por convênio, só particular (mostra aviso direto, sem sugerir
// "fale com a gente" à toa). Ver template-parts do card mais abaixo.
$ipi_team = array(
	array(
		'name'       => 'Dra. Fabiana Gonzaga',
		'crm'        => 'CRM-PE 16724 | RQE 2246',
		'role'       => array( __( 'Infectologia', 'ipi-theme' ) ),
		'photo'      => $ipi_images_uri . 'doc-fabiana.jpg',
		'instagram'  => 'https://www.instagram.com/dra_fabiana_infecto',
		'experience' => array(
			__( 'Médica infectologista, graduada em Medicina pela Universidade de Pernambuco em 2007.', 'ipi-theme' ),
			__( 'Residência Médica em Infectologia no Hospital das Clínicas de Pernambuco (HC-UFPE), entre 2010 e 2013.', 'ipi-theme' ),
			__( 'Infectologista pela Secretaria de Saúde do Estado de Pernambuco (Hospital Correia Picanço) desde 2016 — plantonista e evolucionista.', 'ipi-theme' ),
			__( 'Médica evolucionista da Unimed Recife.', 'ipi-theme' ),
		),
		'education'  => array(),
		'health_plans' => array(
			__( 'Unimed Recife', 'ipi-theme' ),
			__( 'Bradesco Saúde', 'ipi-theme' ),
		),
	),
	array(
		'name'       => 'Dr. Lucas Caheté',
		'crm'        => 'CRM-PE 19711 | RQE 4548 (Infectologia) · RQE 4549 (Hepatologia)',
		'role'       => array( __( 'Infectologia', 'ipi-theme' ), __( 'Hepatologia', 'ipi-theme' ) ),
		'photo'      => $ipi_images_uri . 'doc-lucas.jpg',
		'instagram'  => 'https://www.instagram.com/lucas.cahete',
		'experience' => array(),
		'education'  => array(
			__( 'Pós-graduação em Medicina do Trabalho — Universidade Estácio de Sá, 2013', 'ipi-theme' ),
			__( 'Residência Médica em Infectologia — Universidade Federal de Pernambuco (UFPE), 2016', 'ipi-theme' ),
			__( 'Residência Médica em Hepatologia — Instituto de Medicina Integral Prof. Fernando Figueira (IMIP), 2018', 'ipi-theme' ),
		),
		'health_plans' => array(
			__( 'Bradesco Saúde', 'ipi-theme' ),
			__( 'Sul América Saúde', 'ipi-theme' ),
			__( 'Amil', 'ipi-theme' ),
			__( 'Medservice', 'ipi-theme' ),
		),
	),
	array(
		'name'       => 'Dra. Marcélia Soares',
		'crm'        => 'CRM-PE 19196 | RQE 2414',
		'role'       => array( __( 'Infectologia', 'ipi-theme' ) ),
		'photo'      => $ipi_images_uri . 'doc-marcelia.jpg',
		'instagram'  => 'https://www.instagram.com/marceliasoaresinfecto',
		'experience' => array(
			__( 'Médica infectologista, graduada em Medicina pela Faculdade Integral Diferencial em 2010.', 'ipi-theme' ),
			__( 'Residência Médica em Infectologia no Hospital das Clínicas de Pernambuco (HC-UFPE), entre 2011 e 2014.', 'ipi-theme' ),
			__( 'Concursada da Secretaria de Saúde do Estado de Pernambuco (Hospital Correia Picanço) como infectologista desde 2014 — plantonista e evolucionista.', 'ipi-theme' ),
		),
		'education'  => array(),
		'health_plans' => array(
			__( 'Bradesco Saúde', 'ipi-theme' ),
			__( 'Sul América Saúde', 'ipi-theme' ),
			__( 'Amil', 'ipi-theme' ),
		),
	),
	array(
		'name'       => 'Dra. Marta Iglis',
		'crm'        => 'CRM-PE 17246 | RQE 1646',
		'role'       => array( __( 'Infectologia', 'ipi-theme' ) ),
		'photo'      => $ipi_images_uri . 'doc-marta.jpg',
		'instagram'  => 'https://www.instagram.com/martaiglis',
		'experience' => array(
			__( 'Doutorado em Medicina Tropical — UFPE.', 'ipi-theme' ),
			__( 'Mestrado em Ciências da Saúde — UFPE.', 'ipi-theme' ),
			__( 'Preceptora na Residência de Infectologia do Hospital das Clínicas (HC-UFPE).', 'ipi-theme' ),
			__( 'Atuação em enfermaria e ambulatório de doenças infecciosas — HC-UFPE.', 'ipi-theme' ),
		),
		'education'  => array(),
		'health_plans' => array(
			__( 'Cassi', 'ipi-theme' ),
		),
	),
	array(
		'name'       => 'Dr. Paulo Sérgio Ramos',
		'crm'        => 'CRM-PE 11049 | RQE 001 (Clínica Médica) · RQE 002 (Infectologia)',
		'role'       => array( __( 'Infectologia', 'ipi-theme' ), __( 'Clínica Médica', 'ipi-theme' ) ),
		'photo'      => $ipi_images_uri . 'doc-paulo.jpg',
		'instagram'  => 'https://www.instagram.com/dr_paulo_sergio_infecto',
		'experience' => array(
			__( 'Atua há 28 anos atendendo pacientes na área de Clínica Médica e há 26 anos na área de Infectologia. Faz supervisão de estudantes e médicos residentes em Infectologia no Hospital das Clínicas da UFPE, onde é professor e preceptor. Atende em consultório desde o ano 2000 e orienta alunos de mestrado e doutorado, com linhas de pesquisa voltadas a infecções em pacientes imunossuprimidos.', 'ipi-theme' ),
		),
		'education'  => array(
			__( 'Graduação — Universidade de Pernambuco', 'ipi-theme' ),
			__( 'Residência Médica em Clínica Médica — Hospital Getúlio Vargas', 'ipi-theme' ),
			__( 'Residência Médica em Infectologia — Hospital Universitário Oswaldo Cruz', 'ipi-theme' ),
			__( 'Mestrado em Medicina Tropical — UFPE', 'ipi-theme' ),
			__( 'Doutorado em Medicina Tropical — UFPE', 'ipi-theme' ),
			__( 'MBA em Gestão de Saúde e Controle de Infecção Hospitalar', 'ipi-theme' ),
		),
		'health_plans' => false,
	),
);

$ipi_faqs = array(
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
?>

<main id="primary" class="site-main">

	<section class="hero">
		<div class="hero-inner">
			<div class="hero-content">
				<?php
				// Sem eyebrow (logo + nome do Instituto) e sem botão de CTA
				// aqui — os dois já estão no header, que fica fixo/flutuante
				// por cima do hero (ver body.header-overlay-hero). Repetir
				// os dois de novo a poucos pixels de distância é redundância
				// visual, não reforço de marca.
				?>
				<h1>
					<?php if ( $ipi_hero_title_split ) : ?>
						<span class="hero-title-lead"><?php echo esc_html( $ipi_hero_title_lead ); ?></span>
						<span class="hero-title-accent"><?php echo esc_html( $ipi_hero_title_rest ); ?></span>
					<?php else : ?>
						<?php echo esc_html( $ipi_hero_title ); ?>
					<?php endif; ?>
				</h1>
				<p class="lede"><?php echo esc_html( $ipi_hero_lede ); ?></p>
			</div>

			<div class="hero-media-wrap">
				<div class="hero-media">
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
						<img
							src="<?php echo esc_url( get_template_directory_uri() . '/images/ipi-equipe-hero.jpg' ); ?>"
							alt="<?php esc_attr_e( 'Equipe médica do IPI', 'ipi-theme' ); ?>"
							fetchpriority="high"
							loading="eager"
						/>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="trust-strip">
			<span><?php esc_html_e( 'Equipe médica especializada', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Atendimento humanizado', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Infraestrutura própria', 'ipi-theme' ); ?></span>
			<span><?php esc_html_e( 'Atendimento por teleconsulta', 'ipi-theme' ); ?></span>
		</div>
	</div>

	<section id="sobre" class="section">
		<div class="container">
			<header class="section-header">
				<span class="eyebrow"><?php esc_html_e( 'Quem somos', 'ipi-theme' ); ?></span>
				<h2><?php esc_html_e( 'Cuidado especializado, do diagnóstico ao acompanhamento', 'ipi-theme' ); ?></h2>
			</header>
			<p>
				<?php esc_html_e( 'O Instituto Pernambucano de Infectologia (IPI) existe para oferecer, em Recife, um espaço de referência no diagnóstico e tratamento de doenças infecciosas — com o rigor técnico de uma equipe especializada e o acolhimento que todo paciente merece ao cuidar da própria saúde.', 'ipi-theme' ); ?>
			</p>
			<p>
				<?php esc_html_e( 'Sabemos que buscar ajuda para uma condição infecciosa muitas vezes vem acompanhado de dúvidas, urgência ou receio. Por isso, conduzimos cada consulta com escuta atenta, sigilo absoluto e decisões clínicas baseadas em evidência.', 'ipi-theme' ); ?>
			</p>
		</div>

		<div class="container">
			<header class="section-header">
				<h3><?php esc_html_e( 'Nossa equipe médica', 'ipi-theme' ); ?></h3>
				<p><?php esc_html_e( 'Cada consulta no IPI é conduzida por médicos especialistas, com registro ativo no Conselho Regional de Medicina de Pernambuco. Toda a equipe atende também por teleconsulta.', 'ipi-theme' ); ?></p>
			</header>
			<div class="team-grid">
				<?php foreach ( $ipi_team as $ipi_doctor ) : ?>
					<?php
					$ipi_doctor_wa = ipi_theme_get_doctor_whatsapp_link( $ipi_doctor['name'] );
					// @handle exibido a partir da própria URL, em vez de manter um
					// segundo campo redundante — o Instagram usa a última parte do
					// caminho da URL como identificador do perfil.
					$ipi_doctor_ig_handle = ! empty( $ipi_doctor['instagram'] ) ? trim( (string) wp_parse_url( $ipi_doctor['instagram'], PHP_URL_PATH ), '/' ) : '';
					?>
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
							<div class="team-roles">
								<?php foreach ( $ipi_doctor['role'] as $ipi_role ) : ?>
									<span class="badge"><?php echo esc_html( $ipi_role ); ?></span>
								<?php endforeach; ?>
							</div>
							<p class="team-crm"><?php echo esc_html( $ipi_doctor['crm'] ); ?></p>
							<?php if ( $ipi_doctor_ig_handle ) : ?>
								<a class="team-instagram" href="<?php echo esc_url( $ipi_doctor['instagram'] ); ?>" rel="noopener noreferrer" target="_blank">
									<?php echo ipi_theme_get_icon( 'instagram' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG fixo do tema, sem dado de usuário. ?>
									<span>@<?php echo esc_html( $ipi_doctor_ig_handle ); ?></span>
								</a>
							<?php endif; ?>
							<?php if ( $ipi_doctor_wa ) : ?>
								<a class="btn btn-secondary team-cta" href="<?php echo esc_url( $ipi_doctor_wa ); ?>" rel="noopener noreferrer" target="_blank">
									<?php esc_html_e( 'Agendar consulta', 'ipi-theme' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $ipi_doctor['experience'] ) || ! empty( $ipi_doctor['education'] ) ) : ?>
								<details class="team-education">
									<summary class="team-education-summary"><?php esc_html_e( 'Formação e experiência profissional', 'ipi-theme' ); ?></summary>
									<?php foreach ( $ipi_doctor['experience'] as $ipi_experience_item ) : ?>
										<p class="team-education-paragraph"><?php echo esc_html( $ipi_experience_item ); ?></p>
									<?php endforeach; ?>
									<?php if ( ! empty( $ipi_doctor['education'] ) ) : ?>
										<ul class="team-education-list">
											<?php foreach ( $ipi_doctor['education'] as $ipi_education_item ) : ?>
												<li><?php echo esc_html( $ipi_education_item ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</details>
							<?php endif; ?>
							<details class="team-education">
								<summary class="team-education-summary"><?php esc_html_e( 'Planos de saúde aceitos', 'ipi-theme' ); ?></summary>
								<?php if ( is_array( $ipi_doctor['health_plans'] ) && ! empty( $ipi_doctor['health_plans'] ) ) : ?>
									<ul class="team-education-list">
										<?php foreach ( $ipi_doctor['health_plans'] as $ipi_plan_item ) : ?>
											<li><?php echo esc_html( $ipi_plan_item ); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php elseif ( false === $ipi_doctor['health_plans'] ) : ?>
									<p class="team-education-fallback">
										<?php esc_html_e( 'Atendimento particular (não atende por convênio).', 'ipi-theme' ); ?>
									</p>
								<?php else : ?>
									<p class="team-education-fallback">
										<?php esc_html_e( 'Fale com a nossa equipe pelo WhatsApp para confirmar se o seu convênio é aceito.', 'ipi-theme' ); ?>
									</p>
								<?php endif; ?>
							</details>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<?php $ipi_team_page = get_page_by_path( 'nossa-equipe' ); ?>
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

			<?php get_template_part( 'template-parts/specialties-grid' ); ?>
		</div>
	</section>

	<?php if ( $ipi_hero_content ) : ?>
		<section class="section section--alt">
			<div class="container entry-content">
				<?php echo wp_kses_post( $ipi_hero_content ); ?>
			</div>
		</section>
	<?php endif; ?>

	<section id="faq" class="section">
		<div class="container">
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

	<?php
	// A seção "Conteúdos" saiu da Home — agora é a própria página
	// "Conteúdos" (page_for_posts, ver index.php), com link no menu ao
	// lado de "Contato". Home fica só com o que é específico dela.
	?>

	<section id="localizacao" class="section">
		<div class="container">
			<header class="section-header">
				<span class="eyebrow"><?php esc_html_e( 'Fale com a gente', 'ipi-theme' ); ?></span>
				<h2><?php esc_html_e( 'Contato e Localização', 'ipi-theme' ); ?></h2>
			</header>

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

</main><!-- #primary -->

<?php
get_footer();
