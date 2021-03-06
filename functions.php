<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add Custom Post Types and Template Parts
include_once( get_stylesheet_directory() . '/cpts/coaches-cards.php' );
include_once( get_stylesheet_directory() . '/template-parts/above-footer.php' );

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600,800', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fontawesome', '//opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . "/js/custom.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( '', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'default-image'   => '',
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//* Register Custom Post Type Sidebars
genesis_register_sidebar( array(
	'id'			=> 'sidebar-sessions',
	'name'			=> __( 'Sessions Sidebar', 'CHILD_THEME_NAME' ),
	'description'	=> __( 'Widgets for the sidebar on Sessions pages.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-lessons',
	'name'			=> __( 'Lessons Sidebar', 'CHILD_THEME_NAME' ),
	'description'	=> __( 'Widgets for the sidebar on Lessons pages.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-activities',
	'name'			=> __( 'Activites Sidebar', 'CHILD_THEME_NAME' ),
	'description'	=> __( 'Widgets for the sidebar on Activities pages.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-quiz',
	'name'			=> __( 'Quiz Sidebar', 'CHILD_THEME_NAME' ),
	'description'	=> __( 'Widgets for the sidebar on Quiz pages.', 'CHILD_THEME_NAME' ),
) );

//* Change the footer text
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] All Rights Reserved. StartupAcademy.org is a StartInno venture.';
	return $creds;
}


add_shortcode( 'start_footer_social', 'start_footer_social_shortcode' );
function start_footer_social_shortcode() {
	echo '<p>
		<a href="#"><span class="fa fa-twitter"></span></a>
		<a href="#"><span class="fa fa-facebook"></span></a>
		<a href="#"><span class="fa fa-instagram"></span></a>
		<a href="#"><span class="fa fa-linkedin"></span></a>
		</p>';
}

/**
 * Custom Comments filter: adds private or hidden classes to Learn Dash Comments
 * @param [type] $classes    [description]
 * @param [type] $class      [description]
 * @param [type] $comment_ID [description]
 * @param [type] $comment    [description]
 * @param [type] $post_id    [description]
 */
function start_add_custom_comment_class( $classes, $class, $comment_ID, $comment, $post_id ) {

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

	array_push( $classes, $is_private_comment );

	return $classes;
}



/**
 * Google Analytics Tracking Code
 */
add_action( 'wp_footer', 'sta_add_google_optimize', 1 );
function sta_add_google_optimize() {
	?>
	<script>
		// Add Google Optimize Script
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-54220154-2', 'auto');
		ga('require', 'GTM-MZTCP2P');
		ga('send', 'pageview');
	</script>
	<?php
}
