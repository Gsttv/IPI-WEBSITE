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
			// Sem os prefixos "Categorias:"/"Tags:" — jargão de painel de blog
			// que não agrega para quem está lendo. As próprias categorias/tags
			// já se leem como assunto graças ao estilo de pill em .cat-links/
			// .tags-links (ver style.css).
			$categories_list = get_the_category_list( wp_kses( __( ', ', 'ipi-theme' ), array() ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">%1$s</span> ', wp_kses_post( $categories_list ) );
			}

			$tags_list = get_the_tag_list( '', wp_kses( __( ', ', 'ipi-theme' ), array() ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s</span>', wp_kses_post( $tags_list ) );
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

if ( ! function_exists( 'ipi_theme_post_format_badge' ) ) :
	/**
	 * Exibe um selo indicando o formato do post (vídeo, galeria, imagem)
	 * nos cards de listagem da área de conteúdo. Posts em formato "standard"
	 * não recebem selo — só os formatos que se destacam visualmente.
	 */
	function ipi_theme_post_format_badge(): void {
		$format = get_post_format();

		if ( ! $format ) {
			return;
		}

		$labels = array(
			'video'   => array(
				'icon'  => '▶',
				'label' => __( 'Vídeo', 'ipi-theme' ),
			),
			'gallery' => array(
				'icon'  => '🖼',
				'label' => __( 'Galeria', 'ipi-theme' ),
			),
			'image'   => array(
				'icon'  => '📷',
				'label' => __( 'Imagem', 'ipi-theme' ),
			),
		);

		if ( ! isset( $labels[ $format ] ) ) {
			return;
		}

		printf(
			'<span class="post-format-badge post-format-badge--%1$s"><span aria-hidden="true">%2$s</span> %3$s</span>',
			esc_attr( $format ),
			esc_html( $labels[ $format ]['icon'] ),
			esc_html( $labels[ $format ]['label'] )
		);
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

if ( ! function_exists( 'ipi_theme_get_doctor_whatsapp_link' ) ) :
	/**
	 * Monta o link do WhatsApp com uma mensagem pré-preenchida pedindo
	 * consulta com um médico específico — usado nos botões dos cards da
	 * equipe (home e página Corpo Clínico). Centraliza a lógica pra não
	 * duplicar a montagem da URL/mensagem em cada template.
	 */
	function ipi_theme_get_doctor_whatsapp_link( string $doctor_name ): string {
		$whatsapp = get_theme_mod( 'ipi_theme_whatsapp_url', '' );

		if ( ! $whatsapp ) {
			return '';
		}

		$message = sprintf(
			/* translators: %s: nome do médico (já inclui "Dr."/"Dra."). */
			__( 'Olá! Gostaria de agendar uma consulta com %s.', 'ipi-theme' ),
			$doctor_name
		);

		$separator = str_contains( $whatsapp, '?' ) ? '&' : '?';

		return $whatsapp . $separator . 'text=' . rawurlencode( $message );
	}
endif;

if ( ! function_exists( 'ipi_theme_get_icon' ) ) :
	/**
	 * Retorna o markup de um ícone SVG inline (24×24, `currentColor`) para
	 * uso em links de contato/redes sociais — evita depender de imagens
	 * genéricas ou de uma biblioteca de ícones externa. Ícones desenhados
	 * como representações simplificadas de cada marca (formas básicas),
	 * não uma reprodução pixel-a-pixel do logotipo oficial de terceiros.
	 */
	function ipi_theme_get_icon( string $name ): string {
		$icons = array(
			'whatsapp'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.5 1.3 5L2 22l5.2-1.4c1.4.8 3.1 1.2 4.8 1.2 5.5 0 10-4.5 10-10S17.5 2 12 2Zm0 18.2c-1.6 0-3.1-.4-4.4-1.2l-.3-.2-3.1.8.8-3-.2-.3C4 14.9 3.6 13.5 3.6 12c0-4.6 3.8-8.4 8.4-8.4s8.4 3.8 8.4 8.4-3.8 8.2-8.4 8.2Zm4.6-6.1c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.3-.6.8-.8 1-.1.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.5-1.5-1.8-.1-.3 0-.4.1-.5l.4-.5c.1-.1.2-.3.2-.4.1-.2 0-.3 0-.4-.1-.1-.6-1.4-.8-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.5 1.1 2.7c.1.2 2 3 4.7 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1.1.2-1.2 0-.2-.2-.2-.5-.4Z"/></svg>',
			'facebook'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 4h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3v3h3.3a1 1 0 0 1 1 1.2l-.6 3A1 1 0 0 1 16.7 17H14v6a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1v-6H7a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h2V9a5 5 0 0 1 5-5Z"/></svg>',
			'instagram' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r="0.8" fill="currentColor" stroke="none"/></svg>',
			'linkedin'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="3" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="7.5" cy="8" r="1.3"/><path d="M6.7 10.8h1.6V17H6.7v-6.2Zm3.4 0h1.5v.9c.4-.6 1.1-1.1 2.1-1.1 1.6 0 2.6 1 2.6 3v3.4h-1.6v-3.1c0-1-.4-1.6-1.3-1.6-.9 0-1.4.6-1.4 1.6v3.1h-1.9v-6.2Z" stroke="none"/></svg>',
			'youtube'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="M10.5 9.3v5.4l4.8-2.7-4.8-2.7Z" fill="currentColor" stroke="none"/></svg>',
		);

		return $icons[ $name ] ?? '';
	}
endif;

if ( ! function_exists( 'ipi_theme_get_specialties' ) ) :
	/**
	 * Dados dos cards de "O que tratamos" — usados tanto na Home (seção
	 * #especialidades) quanto na página própria "Áreas de Atuação"
	 * (page-areas-de-atuacao.php). Centralizado aqui, em vez de duplicado
	 * nos dois arquivos, pra editar num lugar só e nunca dessincronizar.
	 *
	 * Cada item pode trazer, opcionalmente, uma lista 'conditions' com os
	 * diagnósticos específicos que aquela frente cobre — são os termos que
	 * o paciente de fato procura (ex.: "infectologista sífilis Recife"),
	 * exibidos como chips dentro do próprio card. Existem só nos cards
	 * onde fazem sentido: evita repetir a mesma doença em dois lugares.
	 */
	function ipi_theme_get_specialties(): array {
		return array(
			array(
				'icon'       => '🩺',
				'title'      => __( 'Consultas Especializadas', 'ipi-theme' ),
				'text'       => __( 'Avaliação clínica completa conduzida por infectologistas experientes, com investigação cuidadosa até a definição do diagnóstico e do plano de tratamento mais adequado para você.', 'ipi-theme' ),
				'conditions' => array(
					__( 'Herpes zoster', 'ipi-theme' ),
					__( 'Infecções urinárias de repetição', 'ipi-theme' ),
					__( 'Dermatopatias infecciosas', 'ipi-theme' ),
					__( 'Investigação de febre prolongada', 'ipi-theme' ),
				),
			),
			array(
				'icon'       => '🧬',
				'title'      => __( 'HIV/Aids e ISTs', 'ipi-theme' ),
				'text'       => __( 'Acompanhamento contínuo, sigiloso e sem julgamentos, com terapia antirretroviral atualizada e suporte em cada etapa do tratamento.', 'ipi-theme' ),
				'conditions' => array(
					__( 'HIV/Aids', 'ipi-theme' ),
					__( 'Sífilis', 'ipi-theme' ),
					__( 'HPV', 'ipi-theme' ),
					__( 'Herpes genital', 'ipi-theme' ),
					__( 'Candidíase', 'ipi-theme' ),
					__( 'PrEP (profilaxia pré-exposição)', 'ipi-theme' ),
					__( 'Avaliação após exposição sexual de risco', 'ipi-theme' ),
				),
			),
			array(
				'icon'       => '🏥',
				'title'      => __( 'Doenças Infecciosas Complexas', 'ipi-theme' ),
				'text'       => __( 'Manejo clínico de infecções hospitalares, tropicais e emergentes, com protocolos atualizados e conduta baseada em evidência.', 'ipi-theme' ),
				'conditions' => array(
					__( 'Infecção hospitalar', 'ipi-theme' ),
					__( 'Infecções bacterianas', 'ipi-theme' ),
					__( 'COVID-19', 'ipi-theme' ),
					__( 'Hepatites virais', 'ipi-theme' ),
					__( 'Toxoplasmose', 'ipi-theme' ),
					__( 'Esquistossomose', 'ipi-theme' ),
					__( 'Doenças parasitárias', 'ipi-theme' ),
				),
			),
			array(
				'icon'  => '📋',
				'title' => __( 'Acompanhamento Clínico Contínuo', 'ipi-theme' ),
				'text'  => __( 'Consultas de retorno e monitoramento de tratamentos de longo prazo, para que você nunca esteja sozinho durante o cuidado com a sua saúde.', 'ipi-theme' ),
			),
		);
	}
endif;
