<?php
/**
 * Template da página "Nossa Equipe" — grid de cards da equipe médica.
 *
 * Sobrepõe page.php apenas para a página de slug "corpo-clinico" (hierarquia
 * de templates do WordPress: page-{slug}.php tem prioridade sobre page.php).
 *
 * Os dados dos médicos ficam num array aqui no template — mesmo padrão já
 * usado para as especialidades em front-page.php. Fica fácil de editar sem
 * precisar de um CPT só para 5 pessoas; se a equipe crescer muito, vale
 * migrar para um Custom Post Type "Médico".
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Fotos individuais de cada médico, nomeadas pelo primeiro nome em
// /images/. Nota: a badge "Responsável Técnica" foi removida do card da
// Dra. Fabiana Gonzaga a pedido do cliente — todos os médicos aparecem no
// grid com o mesmo peso visual. A informação de responsabilidade técnica
// segue exibida no rodapé do site, conforme exigência do CFM.
//
// Lista em ordem alfabética pelo primeiro nome. O campo "role" é um array
// porque alguns médicos têm mais de uma especialidade (ex.: Lucas também
// atende Hepatologia, Paulo também atende Clínica Médica).
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
			__( 'Concursada da Prefeitura do Recife como médica clínica plantonista desde 2009, e da Secretaria de Saúde do Estado de Pernambuco (Hospital Correia Picanço) como infectologista desde 2016 — plantonista e evolucionista.', 'ipi-theme' ),
			__( 'Atua no Controle de Infecção Hospitalar do Hospital do Câncer de Pernambuco desde 2014.', 'ipi-theme' ),
		),
		'education'  => array(),
		'health_plans' => false,
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
			__( 'Hospital Correia Picanço, 2014', 'ipi-theme' ),
			__( 'Ambulatório de Infectologia — Prefeitura de Camaragibe, 2014', 'ipi-theme' ),
		),
		'education'  => array(
			__( 'Especialista em Infectologia — UFPE, 2014', 'ipi-theme' ),
		),
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
		'health_plans' => array(),
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
?>

<main id="primary" class="site-main container section">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header section-header">
			<span class="eyebrow"><?php esc_html_e( 'Quem cuida de você', 'ipi-theme' ); ?></span>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<p>
				<?php esc_html_e( 'Conheça os médicos por trás de cada consulta no IPI — todos especialistas em Infectologia, com registro ativo no Conselho Regional de Medicina de Pernambuco, para você se sentir seguro em cada etapa do cuidado. Toda a equipe atende também por teleconsulta.', 'ipi-theme' ); ?>
			</p>
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
						<h3 class="team-name"><?php echo esc_html( $ipi_doctor['name'] ); ?></h3>
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

	<?php endwhile; ?>

</main><!-- #primary -->

<?php
get_footer();
