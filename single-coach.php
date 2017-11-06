<?php

//* Template Name: Coach
//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

remove_action('genesis_before_footer', 'start_do_before_footer_section', 1 );


add_action( 'wp_head', 'start_hot_switch_logo', 99 );
function start_hot_switch_logo() {

	$hero_image_url = get_stylesheet_directory_uri() . '/images/img-people-standing.jpg';

	$output = '';

	$image_url = get_stylesheet_directory_uri() . '/images/logo-white.png';

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
	$hero_url = get_stylesheet_directory_uri() . '/images/img-people-standing.jpg';
	$coach_pic = get_the_post_thumbnail_url( $coach->ID, 'meidum' );
	$coach_excerpt = get_the_excerpt();
	$coach_website = $acf_fields['coach_website'];
	$coach_linkedin = $acf_fields['coach_linkedin'];
	$coach_twitter = $acf_fields['coach_twitter'];
	?>

	<!-- Hero Image Header Section -->
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>');">
		<div class="hero-text-wrapper">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>

	<!-- Coach Info  Section -->
	<section id="coach-info-section" class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-white" >
			<div class="skew-inner">
				<div class="coach-pic-excerpt">
					<img src="<?php echo $coach_pic; ?>" />
					<p>
						<?php echo $coach_excerpt; ?>
					</p>
					<div class="coach-links">
						<a href="<?php echo esc_url( $coach_website ); ?>"><span class="fa fa-desktop"></span></a>
						<a href="<?php echo esc_url( $coach_linkedin ); ?>"><span class="fa fa-linkedin"></span></a>
						<a href="<?php echo esc_url( $coach_twitter ); ?>"><span class="fa fa-twitter"></span></a>
					</div>
				</div>
				<div class="coach-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>


	<!-- Become a Secti Coach Section -->
	<?php
	$stylesheet_uri = get_stylesheet_directory_uri();
	?>

	<!-- Become and Entrepreneur Section -->
	<section id="become-a-coach" style="background-image: url('<?php echo $stylesheet_uri ; ?>/images/img-background-2.jpg'); height: 80vh;">
		<div>
			<h2>EXTEND YOUR REACH</h2>
			<p>Join our line-up of work class coaches and speakers. Drive leads and earn commissions through our Partner Network by matching your expertise and content with a deeper audience.</p>
			<a href="#">
				<button>BECOME A COACH</button>
			</a>
		</div>
	</section>


<?php }
//* Run the Genesis loop
genesis();
