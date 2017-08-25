<?php

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Remove standard post content output.
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'genesis_page_archive_content' );
add_action( 'genesis_post_content', 'genesis_page_archive_content' );


add_action( 'wp_head', 'start_hot_switch_logo', 99 );
function start_hot_switch_logo() {

	$hero_image_url = get_the_post_thumbnail_url($post->ID);

	$output = '';

	if ( is_page_template() ) {
		$image_url = get_stylesheet_directory_uri() . '/images/logo-white.png';
	} else {
		$image_url = get_stylesheet_directory_uri() . '/images/logo-black.png';
	}


	//Add the output for the logo style
	$output = ".site-title a { background: url({$image_url}) no-repeat !important; }";
	//add the output for the site title wrap
	if( $hero_image_url ) {
		$output .= ".site-header > .wrap { background: url({$hero_image_url}); background-size: cover; }";

		printf( '<style type="text/css">%s</style>' . "\n", $output );
	}
}

// Add custom homepage content
add_action( 'genesis_loop', 'one_pager_homepage_content' );
function one_pager_homepage_content() {
	global $post;
	$hero_url = get_the_post_thumbnail_url($post->ID);

	if( $hero_url ) {
		$header_style = 'class="hero-image-header" style="background-image: url(' . $hero_url . ');"';
	} else {
		$header_style = 'class="regular-page-class"';
	}

	?>
	<!-- Hero Image Header Section -->
	<section <?php echo $header_style; ?> >
		<div class="hero-text-wrapper">

		</div>
	</section>

	<!-- Pricing Section -->
	<section class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div class="div-overlap-top">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>


<?php }
//* Run the Genesis loop
genesis();
