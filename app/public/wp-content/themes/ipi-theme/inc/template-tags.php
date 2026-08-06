<?php
/**
 * Funções auxiliares (template tags) usadas nos arquivos de template.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ipi_theme_posted_on' ) ) :
	/**
	 * Exibe a data de publicação e, quando aplicável, a de atualização.
	 */
	function ipi_theme_posted_on(): void {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s</span>',
			wp_kses_post( $time_string )
		);
	}
endif;

if ( ! function_exists( 'ipi_theme_posted_by' ) ) :
	/**
	 * Exibe o autor do post.
	 */
	function ipi_theme_posted_by(): void {
		printf(
			'<span class="byline"> %1$s <a class="author" href="%2$s">%3$s</a></span>',
			esc_html__( 'por', 'ipi-theme' ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'ipi_theme_entry_footer' ) ) :
	/**
	 * Exibe categorias, tags e link de edição no rodapé do post.
	 */
	function ipi_theme_entry_footer(): void {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( wp_kses( __( ', ', 'ipi-theme' ), array() ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">%1$s %2$s</span> ', esc_html__( 'Categorias:', 'ipi-theme' ), wp_kses_post( $categories_list ) );
			}

			$tags_list = get_the_tag_list( '', wp_kses( __( ', ', 'ipi-theme' ), array() ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s %2$s</span>', esc_html__( 'Tags:', 'ipi-theme' ), wp_kses_post( $tags_list ) );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				esc_html__( 'Deixe um comentário', 'ipi-theme' ),
				esc_html__( '1 comentário', 'ipi-theme' ),
				esc_html__( '% comentários', 'ipi-theme' )
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: nome do post. */
					__( 'Editar <span class="screen-reader-text">%s</span>', 'ipi-theme' ),
					array( 'span' => array( 'class' => array() ) )
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'ipi_theme_post_thumbnail' ) ) :
	/**
	 * Exibe a imagem destacada do post de forma responsiva e acessível.
	 */
	function ipi_theme_post_thumbnail(): void {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php
				// Sem override de "alt": the_post_thumbnail() já usa o texto
				// alternativo cadastrado na mídia. Repetir o título do post ali
				// duplicaria o anúncio do <h1> para quem usa leitor de tela.
				the_post_thumbnail( 'ipi-hero' );
				?>
			</div>
			<?php
		else :
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'ipi-card', array( 'alt' => '' ) ); ?>
			</a>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'ipi_theme_get_tel_href' ) ) :
	/**
	 * Normaliza um número de telefone para uso em links "tel:" (mantém
	 * apenas dígitos e o sinal de "+" do DDI). Centraliza a lógica usada
	 * pelo cabeçalho, faixa de emergência e CTAs da página inicial.
	 */
	function ipi_theme_get_tel_href( string $phone ): string {
		return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
	}
endif;
