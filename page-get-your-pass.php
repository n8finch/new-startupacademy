<?php

//* Template Name: Get Your Pass
//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Add custom homepage content
add_action( 'genesis_loop', 'one_pager_homepage_content' );
function one_pager_homepage_content() {
	global $post;
	$hero_url = get_the_post_thumbnail_url($post->ID);

	?>

	<!-- Hero Image Header Section -->
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>'); height: 80vh;">
		Hero Image Header Section
	</section>

	<!-- Hero Image Header Section -->
	<section class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<p>
					Pricing Section
				</p>
			</div>
		</div>
	</section>

	<!-- All Passes Include Section -->
	<section class="slanted-section background-medium">
		<div class="slanted-section-l-r-inner background-medium" >
			<div class="skew-inner">
				<p>
					All passes include
				</p>
			</div>
		</div>
	</section>

	<!-- Every Pass Includes Section -->
	<section class="slanted-section background-dark">
		<div class="slanted-section-r-l-inner background-dark" >
			<div class="skew-inner">
				<p>
					Every pass includes
				</p>
			</div>
		</div>
	</section>

	<?php the_content(); ?>


<?php }


//* Run the Genesis loop
genesis();
