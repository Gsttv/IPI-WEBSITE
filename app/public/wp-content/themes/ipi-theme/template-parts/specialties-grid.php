<?php
/**
 * Grade de cards de "O que tratamos" — usada tanto na Home (dentro da
 * seção #especialidades) quanto na página própria "Áreas de Atuação"
 * (page-areas-de-atuacao.php). Dados centralizados em
 * ipi_theme_get_specialties(), ver inc/template-tags.php.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="grid">
	<?php
	foreach ( ipi_theme_get_specialties() as $ipi_item ) :
		// Cada especialidade vira uma página própria no wp-admin quando
		// o cliente criar uma Página com slug igual ao título (ex.: título
		// "HIV/Aids e ISTs" → slug "hiv-aids-e-ists", gerado pelo próprio
		// WordPress a partir do título digitado). Até lá, o card continua
		// funcionando como um resumo estático — nada quebra.
		$ipi_specialty_page = get_page_by_path( sanitize_title( $ipi_item['title'] ) );
		$ipi_card_tag       = $ipi_specialty_page ? 'a' : 'div';
		?>
		<<?php echo esc_html( $ipi_card_tag ); ?>
			class="card card--link"
			<?php echo $ipi_specialty_page ? 'href="' . esc_url( get_permalink( $ipi_specialty_page ) ) . '"' : ''; ?>
		>
			<div class="card-icon" aria-hidden="true"><?php echo esc_html( $ipi_item['icon'] ); ?></div>
			<h3><?php echo esc_html( $ipi_item['title'] ); ?></h3>
			<p><?php echo esc_html( $ipi_item['text'] ); ?></p>
			<?php if ( ! empty( $ipi_item['conditions'] ) ) : ?>
				<ul class="card-conditions">
					<?php foreach ( $ipi_item['conditions'] as $ipi_condition_item ) : ?>
						<li><?php echo esc_html( $ipi_condition_item ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( $ipi_specialty_page ) : ?>
				<span class="card-link-affordance" aria-hidden="true"><?php esc_html_e( 'Saiba mais', 'ipi-theme' ); ?> →</span>
			<?php endif; ?>
		</<?php echo esc_html( $ipi_card_tag ); ?>>
	<?php endforeach; ?>
</div>
