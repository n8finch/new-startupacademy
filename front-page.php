<?php

//* Template Name: Homepage
//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

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
	$output .= ".site-header > .wrap { background: url({$hero_image_url}); background-size: cover; }";

	printf( '<style type="text/css">%s</style>' . "\n", $output );
}

// Add custom homepage content
add_action( 'genesis_loop', 'one_pager_homepage_content' );
function one_pager_homepage_content() {
	global $post;
	$acf_fields = get_fields($post->ID);
	$hero_url = get_the_post_thumbnail_url($post->ID);
	?>

	<!-- Hero Image Header Section -->
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>'); height: 100vh;">
		<div class="hero-text-wrapper">
			<h1><?php echo $acf_fields['homepage_hero_title']; ?></h1>
			<p><?php echo $acf_fields['homepage_hero_text']; ?></p>
			<div class="">
				<a href="<?php echo $acf_fields['homepage_orange_button_link']; ?>">
					<button class="homepage-hero-orange-button"><?php echo $acf_fields['homepage_orange_button_text']; ?></button>
				</a>
				<a href="<?php echo $acf_fields['homepage_transparent_button_link']; ?>">
					<button class="homepage-hero-transparent-button"><?php echo $acf_fields['homepage_transparent_button_text']; ?></button>
				</a>
			</div>
		</div>
	</section>

	<!-- Video What is StartupAcademy -->
	<section class="slanted-section background-white" >
		<div class="slanted-section-l-r-inner background-white" >
			<div class="skew-inner">
				<div class="div-overlap-top">


				</div>
			</div>
		</div>
	</section>
	<!-- What is 3 Step Start? 1.Think Like An Entrepreneur -->
	<section class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">

			</div>
		</div>
	</section>

	<!-- 2 Launch Your Startup Idea -->
	<section class="slanted-section background-medium">
		<div class="slanted-section-l-r-inner background-medium" >
			<div class="skew-inner">

			</div>
		</div>
	</section>

	<!-- 3. Grow Your Startup -->
	<section class="slanted-section background-dark">
		<div class="slanted-section-r-l-inner background-dark" >
			<div class="skew-inner">

			</div>
		</div>
	</section>

	<!-- LEARN FROM WORLD CLASS ENTREPRENEURS -->
	<section class="homepage-section-learn-from">
		<div class="">

		</div>
	</section>

	<!-- OUR PARTNERS -->
	<section class="homepage-section-partners">
		<div class="">

		</div>
	</section>



<?php }
//* Run the Genesis loop
genesis();
