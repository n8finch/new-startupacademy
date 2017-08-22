<?php

//* Template Name: Coaches
//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

remove_action('genesis_before_footer', 'start_do_before_footer_section', 1 );


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
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>');">
		<div class="hero-text-wrapper">
			<h1><?php echo $acf_fields['coaches_hero_image_title']; ?></h1>
			<p><?php echo $acf_fields['coaches_hero_image_text']; ?></p>
		</div>
	</section>

	<!-- Coaches Cards Section -->
	<section id="coaches-cards-section" class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div class="div-overlap-top">
					<div class="coaches-cards-container">
						<?php
						$args = array(
							'orderby'          => 'title',
							'order'            => 'DESC',
							'post_type'        => 'coach',
							'post_status'      => 'publish',
							'posts_per_page'   => 12,
							'suppress_filters' => true
						);
						$coaches = get_posts( $args );
						if( $coaches ) {
							$counter = 1;
							foreach( $coaches as $coach ) {
								$coach_url = get_the_permalink($coach->ID);
								$coach_name = $coach->post_title;
								$coach_excerpt = $coach->post_excerpt;
								$coach_pic = get_the_post_thumbnail_url($coach->ID);
								$counter > 6 ? $offset_class = 'offset-class' : '';
								?>
								<a href="<?php echo $coach_url; ?>">
									<div class="coach-card <?php echo $offset_class; ?>">
										<img class="coach-image" src="<?php echo $coach_pic?>" />
										<div>
											<div class="coach-name"><?php echo $coach_name; ?></div>
											<div class="coach_excerpt"><?php echo $coach_excerpt; ?></div>
										</div>
									</div>
								</a>
								<?php
								$counter++;
							}
						}
						?>
					</div>
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
