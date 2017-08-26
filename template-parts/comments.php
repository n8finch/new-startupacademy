<?php
function start_comments_template( $comment, $args, $depth ) {

	//TODO
	// compare where the current user ID is the same as the comment user ID
	// compare if the current user role[0] is mentor or admin.
	// Also need to assign people with a mento role permissions in MM

	//Get meta and user role
	$comment_ID_this = $comment->comment_ID;
	$comment_ID_parent = $comment->comment_parent;
	$comment_is_private = get_comment_meta($comment_ID_this, 'private-comment-checkbox', true);
	$comment_author = $comment->comment_author;
	$comment_author_ID = $comment->user_id;
	$parent_comment_user_ID = intval(get_comment($comment_ID_parent)->user_id);
	$current_user = wp_get_current_user();
	$current_user_ID = $current_user->ID;
	$current_user_roles = $current_user->roles;
	$user_is_admin = in_array( 'administrator', $current_user_roles);
	$user_is_mentor = in_array( 'mentor', $current_user_roles);
	$is_private_comment = '';

	// Add CSS classes based on whether comment is public or private.
	if ( $comment_is_private && ( $user_is_mentor || $user_is_admin || $current_user_ID == $comment_author_ID ) ) {

		$is_private_comment = 'is-private-comment';

	} elseif( $comment_is_private && ( $current_user_ID === $parent_comment_user_ID ) ) {

		$is_private_comment = 'is-private-comment';

	} elseif ($comment_is_private) {

		$is_private_comment = 'hidden';

	}


	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">



		<div class="mk-single-comment <?php echo $is_private_comment; ?>" id="comment-<?php comment_ID(); ?>" <?php echo get_schema_markup('comment'); ?>>
			<div class="gravatar"><?php echo get_avatar( $comment, $size='45', $default='' ); ?></div>
			<div class="comment-meta">
					<?php printf( '<span class="comment-author" '.get_schema_markup('comment_author_link').'>%s</span>', get_comment_author_link() ) ?>

                    <?php edit_comment_link( '', '', '' ) ?>
                    <time class="comment-time" <?php echo get_schema_markup('comment_time'); ?>><?php echo get_comment_date(); ?></time>
			</div>
			<span class="comment-reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</span>
			<div class="clearboth"></div>
			<div class="comment-content" <?php echo get_schema_markup('comment_text'); ?>>
					<?php comment_text() ?>

<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="unapproved"><?php _e( 'Your comment is awaiting moderation.', 'mk_framework' );?></span>
<?php endif; ?>
				<div class="clearboth"></div>
			</div>


		</div>
<?php
	// } //end if $comment_author_ID === $current_user_ID
 }

function list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap comments-pings">

			<div class="comment-content">

				<div class="comment-meta">

					<?php printf( '<span class="comment_author"><b>%s</b></span>', get_comment_author_link() ) ?>

				</div>
				<div class="comment-data">
					<?php comment_text() ?>

								<time class="comment-time"><?php echo get_comment_time('F jS, Y h:i A'); ?></time>
<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="unapproved">Your comment is awaiting moderation.</span>
<?php endif; ?>
				</div>
                <div class="clearboth"></div>
	</div>

<?php } ?>

<section id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mk_framework' );?></p>
</section><!-- #comments -->
<?php
return;
endif;

if ( have_comments() ) : ?>
	<div class="blog-comment-title"><?php printf( _n( 'Comments ', 'Showing %1$s comments', get_comments_number(), 'mk_framework' ),
	number_format_i18n( get_comments_number() )); ?></div>
	<ul class="mk-commentlist">
		<?php
wp_list_comments( 'callback=theme_comments&type=comment' );
?>
	</ul>





<?php
if ( have_comments() ) : ?>
<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
<div class="blog-comment-title"><?php _e( 'pingbacks / trackbacks', 'mk_framework' ); ?></div>

<ul class="mk-commentlist">
<?php wp_list_comments( 'callback=list_pings&type=pings' ); ?>
</ul>
<?php endif; endif; ?>

<?php else :
	if ( ! comments_open() ) :
		endif;
	endif;
?>

 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav class="comments-navigation">
		<div class="comments-previous"><?php previous_comments_link(); ?></div>
		<div class="comments-next"><?php next_comments_link(); ?></div>
	</nav>
<?php endif;?>



	<?php

		$fields =  array(
			'author'=> '<div class="comment-form-name comment-form-row"><input type="text" name="author" class="text_input" id="author" tabindex="54" placeholder="' . esc_html__( 'Name (Required)', 'mk_framework' ) . '"  /></div>',
			'email' => '<div class="comment-form-email comment-form-row"><input type="text" name="email" class="text_input" id="email" tabindex="56" placeholder="' . esc_html__( 'Email (Required)', 'mk_framework' ) . '" /></div>',
			'url' 	=> '<div class="comment-form-website comment-form-row"><input type="text" name="url" class="text_input" id="url" tabindex="57" placeholder="' . esc_html__( 'Website', 'mk_framework' ) . '" /></div>',
		);

		//Comment Form Args
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>'<div class="respond-heading">' . esc_html__( 'Leave a Comment', 'mk_framework' ) . '</div>',
			'comment_field' => '<div class="comment-textarea"><textarea placeholder="' . esc_html__( 'LEAVE YOUR COMMENT', 'mk_framework' ) . '" class="textarea" name="comment" rows="8" id="comment" tabindex="58"></textarea></div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'label_submit' => esc_html__( 'POST COMMENT','mk_framework' )
		);
		comment_form($comments_args);
	?>



</section>
