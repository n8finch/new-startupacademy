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
	$acf_fields = get_fields($post->ID);
	$hero_url = get_the_post_thumbnail_url($post->ID);
	?>

	<!-- Hero Image Header Section -->
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>'); height: 80vh;">
		<div class="hero-text-wrapper">
			<h1><?php echo $acf_fields['get_your_pass_hero_title']; ?></h1>
			<p><?php echo $acf_fields['get_your_pass_hero_text']; ?></p>
		</div>
	</section>

	<!-- Pricing Section -->
	<section class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div id="get-your-pass-price-boxes">
					<div class="get-your-pass-price-box">
						<h3><?php echo $acf_fields['get_your_pass_price_box_title_1']; ?></h3>
						<p><?php echo $acf_fields['get_your_pass_price_box_text_1']; ?></p>
						<p class="price-box-price"><?php echo $acf_fields['get_your_pass_price_box_price_1']; ?></p>
						<p> </p>
						<a href="<?php echo $acf_fields['get_your_pass_price_box_button_link_1']; ?>">
							<button><?php echo $acf_fields['get_your_pass_price_box_button_text_1']; ?></button>
						</a>
					</div>
					<div class="get-your-pass-price-box">
						<h3><?php echo $acf_fields['get_your_pass_price_box_title_2']; ?></h3>
						<p><?php echo $acf_fields['get_your_pass_price_box_text_2']; ?></p>
						<p class="price-box-price"><?php echo $acf_fields['get_your_pass_price_box_price_2']; ?></p>
						<p>USD / MONTH</p>
						<a href="<?php echo $acf_fields['get_your_pass_price_box_button_link_2']; ?>">
							<button><?php echo $acf_fields['get_your_pass_price_box_button_text_2']; ?></button>
						</a>
					</div>
					<div class="get-your-pass-price-box">
						<h3><?php echo $acf_fields['get_your_pass_price_box_title_3']; ?></h3>
						<p><?php echo $acf_fields['get_your_pass_price_box_text_3']; ?></p>
						<p class="price-box-price"><?php echo $acf_fields['get_your_pass_price_box_price_3']; ?></p>
						<p>USD / MONTH</p>
						<a href="<?php echo $acf_fields['get_your_pass_price_box_button_link_3']; ?>">
							<button><?php echo $acf_fields['get_your_pass_price_box_button_text_3']; ?></button>
						</a>
					</div>
				</div>
				<div id="get-your-pass-price-lists">
					<div class="get-your-pass-price-list">
						<p><?php echo $acf_fields['list_1_content']; ?></p>
					</div>
					<div class="get-your-pass-price-list">
						<p><?php echo $acf_fields['list_2_content']; ?></p>
					</div>
					<div class="get-your-pass-price-list">
						<p><?php echo $acf_fields['list_3_content']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- All Passes Include Section -->
	<section class="slanted-section background-medium">
		<div class="slanted-section-l-r-inner background-medium" >
			<div class="skew-inner">
				<div id="get-your-pass-all-passes-include">
					<h2>ALL PAID PASSES INCLUDE</h2>
					<div class="passes-include-items">
						<?php
						$rows = $acf_fields['all_paid_passes_list_items'];
						if($rows) {
							foreach($rows as $row)	{
								?>
								<div class="passes-include-item">
								<?php
								echo '<img src="'.$acf_fields['all_paid_passes_list_image'].'"/>';
								echo $row["all_paid_passes_list_item"];
								?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<p>
						<?php
						// echo $acf_fields['all_paid_passes_list_text'];
						?>
					</p>
				</div>
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
