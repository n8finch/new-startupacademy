<?php

function start_html5_comment_filter( $defaults ) {
	$defaults['callback'] = 'start_html5_comment_callback';

	return $defaults;
}


/**
 * Custom comment callback for {@link genesis_default_list_comments()} if HTML5 is active.
 *
 * Does `genesis_before_comment` and `genesis_after_comment` actions.
 *
 * Applies `comment_author_says_text` and `genesis_comment_awaiting_moderation` filters.
 *
 * @since 2.0.0
 *
 * @param stdClass $comment Comment object.
 * @param array    $args    Comment args.
 * @param int      $depth   Depth of current comment.
 */
function start_html5_comment_callback( $comment, array $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>




	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<article <?php echo genesis_attr( 'comment' ); ?>>

		<?php do_action( 'genesis_before_comment' ); ?>

		<header <?php echo genesis_attr( 'comment-header' ); ?>>
			<p <?php echo genesis_attr( 'comment-author' ); ?>>
				<?php
				echo get_avatar( $comment, $args['avatar_size'] );

				$author = get_comment_author();
				$url    = get_comment_author_url();

				if ( ! empty( $url ) && 'http://' !== $url ) {
					$author = sprintf( '<a href="%s" %s>%s</a>', esc_url( $url ), genesis_attr( 'comment-author-link' ), $author );
				}

				/**
				 * Filter the "comment author says" text.
				 *
				 * Allows developer to filter the "comment author says" text so it can say something different, or nothing at all.
				 *
				 * @since unknown
				 *
				 * @param string $text Comment author says text.
				 */
				$comment_author_says_text = apply_filters( 'comment_author_says_text', __( 'says', 'genesis' ) );

				if ( ! empty( $comment_author_says_text ) ) {
					$comment_author_says_text = '<span class="says">' . $comment_author_says_text . '</span>';
				}

				printf( '<span itemprop="name">%s</span> %s', $author, $comment_author_says_text );
				?>
			</p>

			<?php
			/**
			 * Allows developer to control whether to print the comment date.
			 *
			 * @since 2.2.0
			 *
			 * @param bool   $comment_date Whether to print the comment date.
			 * @param string $post_type    The current post type.
			 */
			$comment_date = apply_filters( 'genesis_show_comment_date', true, get_post_type() );

			if ( $comment_date ) {
				printf( '<p %s>', genesis_attr( 'comment-meta' ) );
				printf( '<time %s>', genesis_attr( 'comment-time' ) );
				printf( '<a href="%s" %s>', esc_url( get_comment_link( $comment->comment_ID ) ), genesis_attr( 'comment-time-link' ) );
				echo    esc_html( get_comment_date() ) . ' ' . __( 'at', 'genesis' ) . ' ' . esc_html( get_comment_time() );
				echo    '</a></time></p>';
			}

			edit_comment_link( __( '(Edit)', 'genesis' ), ' ' );
			?>
		</header>

		<div <?php echo genesis_attr( 'comment-content' ); ?>>
			<?php if ( ! $comment->comment_approved ) : ?>
				<?php
				/**
				 * Filter the "comment awaiting moderation" text.
				 *
				 * Allows developer to filter the "comment awaiting moderation" text so it can say something different, or nothing at all.
				 *
				 * @since unknown
				 *
				 * @param string $text Comment awaiting moderation text.
				 */
				$comment_awaiting_moderation_text = apply_filters( 'genesis_comment_awaiting_moderation', __( 'Your comment is awaiting moderation.', 'genesis' ) );
				?>
				<p class="alert"><?php echo $comment_awaiting_moderation_text; ?></p>
			<?php endif; ?>

			<?php comment_text(); ?>
		</div>

		<?php
		comment_reply_link( array_merge( $args, array(
			'depth'  => $depth,
			'before' => sprintf( '<div %s>', genesis_attr( 'comment-reply' ) ),
			'after'  => '</div>',
		) ) );
		?>

		<?php do_action( 'genesis_after_comment' ); ?>

	</article>
	<?php
	// No ending </li> tag because of comment threading.
}
