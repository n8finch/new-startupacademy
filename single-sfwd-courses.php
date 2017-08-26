<?php

//* Template Name: Courses Template
//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'wp_head', 'start_hot_switch_logo', 99 );
function start_hot_switch_logo() {

	$hero_image_url = '';

	$output = '';

	if ( is_page_template() || $hero_image_url ) {
		$image_url = get_stylesheet_directory_uri() . '/images/logo-white.png';
	} else {
		$image_url = get_stylesheet_directory_uri() . '/images/logo-black.png';
	}

	//Add the output for the logo style
	$output = ".site-title a { background: url({$image_url}) no-repeat !important; }";
	//add the output for the site title wrap
	if( $hero_image_url ) {
		$output .= ".site-header > .wrap { background: url({$hero_image_url}); background-size: cover; } .genesis-nav-menu a { color: white; }";

		printf( '<style type="text/css">%s</style>' . "\n", $output );
	}
}

// Add custom homepage content
add_action( 'genesis_loop', 'start_main_content' );
function start_main_content() {
	global $post;
	$hero_url = '';

	if( $hero_url ) {
		$header_style = 'class="hero-image-header" style="background-image: url(' . $hero_url . ');"';
	} else {
		$header_style = 'class="regular-page-class"';
	}

	?>
	<!-- Hero Image Header Section -->
	<section <?php echo $header_style; ?> >
		<div class="hero-text-wrapper">
			<h1><?php if( $hero_url ) { the_title(); } ?></h1>
		</div>
	</section>

	<!-- Pricing Section -->
	<section class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div class="div-overlap-top">
					<h1><?php if( !$hero_url ) { the_title(); } ?></h1>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

<?php }

add_action( 'genesis_loop', 'genesis_get_comments_template' );

//* Run the Genesis loop
genesis();
