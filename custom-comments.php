<?php

/**
 * Custom Comments for Learn Dash
 * @return [type] [description]
 */
function start_do_comments() {

	global $wp_query;
	echo 'custom comments!';
	// Bail if comments are off for this post type.
	if ( ( is_page() && ! genesis_get_option( 'comments_pages' ) ) || ( is_single() && ! genesis_get_option( 'comments_posts' ) ) ) {
		return;
	}

	if ( ! empty( $wp_query->comments_by_type['comment'] ) && have_comments() ) {

		genesis_markup( array(
			'open'   => '<div %s>',
			'context' => 'entry-comments',
		) );

		echo apply_filters( 'genesis_title_comments', __( '<h3>Comments</h3>', 'genesis' ) );
		printf( '<ol %s>', genesis_attr( 'comment-list' ) );
			do_action( 'genesis_list_comments' );
		echo '</ol>';

		// Comment Navigation.
		$prev_link = get_previous_comments_link( apply_filters( 'genesis_prev_comments_link_text', '' ) );
		$next_link = get_next_comments_link( apply_filters( 'genesis_next_comments_link_text', '' ) );

		if ( $prev_link || $next_link ) {

			$pagination = sprintf( '<div class="pagination-previous alignleft">%s</div>', $prev_link );
			$pagination .= sprintf( '<div class="pagination-next alignright">%s</div>', $next_link );

			genesis_markup( array(
				'open'    => '<div %s>',
				'close'   => '</div>',
				'content' => $pagination,
				'context' => 'comments-pagination',
			) );

		}

		genesis_markup( array(
			'close'   => '</div>',
			'context' => 'entry-comments',
		) );

	}
	// No comments so far.
	elseif ( 'open' === get_post()->comment_status && $no_comments_text = apply_filters( 'genesis_no_comments_text', '' ) ) {
		if ( genesis_html5() ) {
			echo sprintf( '<div %s>', genesis_attr( 'entry-comments' ) ) . $no_comments_text . '</div>';
		} else {
			echo '<div id="comments">' . $no_comments_text . '</div>';
		}
	}
	elseif ( $comments_closed_text = apply_filters( 'genesis_comments_closed_text', '' ) ) {
		if ( genesis_html5() ) {
			echo sprintf( '<div %s>', genesis_attr( 'entry-comments' ) ) . $comments_closed_text . '</div>';
		} else {
			echo '<div id="comments">' . $comments_closed_text . '</div>';
		}
	}

}
