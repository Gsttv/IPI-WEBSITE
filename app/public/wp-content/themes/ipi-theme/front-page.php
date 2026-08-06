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
					<span class="eyebrow"><?php esc_html_e( 'Blog', 'ipi-theme' ); ?></span>
					<h2><?php esc_html_e( 'Notícias e conteúdo educativo', 'ipi-theme' ); ?></h2>
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

</main><!-- #primary -->

<?php
get_footer();
