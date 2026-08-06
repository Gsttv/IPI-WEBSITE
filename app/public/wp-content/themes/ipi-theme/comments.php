<?php
/**
 * Template de comentários: lista de comentários existentes + formulário.
 *
 * @package IPI_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$ipi_comment_count = get_comments_number();
			if ( 1 === (int) $ipi_comment_count ) {
				esc_html_e( '1 comentário', 'ipi-theme' );
			} else {
				printf(
					/* translators: %s: número de comentários formatado. */
					esc_html( _n( '%s comentário', '%s comentários', (int) $ipi_comment_count, 'ipi-theme' ) ),
					esc_html( number_format_i18n( $ipi_comment_count ) )
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => esc_html__( '← Anteriores', 'ipi-theme' ),
				'next_text' => esc_html__( 'Próximos →', 'ipi-theme' ),
			)
		);
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Os comentários estão encerrados.', 'ipi-theme' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'class_submit'       => 'btn btn-primary',
		)
	);
	?>

</div><!-- #comments -->
