<?php
/**
 * Template da página "Corpo Clínico" — grid de cards da equipe médica.
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
?>

<main id="primary" class="site-main container section">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header section-header">
			<span class="eyebrow"><?php esc_html_e( 'Quem cuida de você', 'ipi-theme' ); ?></span>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<p>
				<?php esc_html_e( 'Conheça os médicos por trás de cada consulta no IPI — todos especialistas em Infectologia, com registro ativo no Conselho Regional de Medicina de Pernambuco, para você se sentir seguro em cada etapa do cuidado.', 'ipi-theme' ); ?>
			</p>
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
						<h3 class="team-name"><?php echo esc_html( $ipi_doctor['name'] ); ?></h3>
						<span class="badge"><?php echo esc_html( $ipi_doctor['role'] ); ?></span>
						<p class="team-crm"><?php echo esc_html( $ipi_doctor['crm'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	<?php endwhile; ?>

</main><!-- #primary -->

<?php
get_footer();
