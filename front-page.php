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
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>');">
		<div class="hero-text-wrapper">
			<h1><?php echo $acf_fields['homepage_hero_title']; ?></h1>
			<p><?php echo $acf_fields['homepage_hero_text']; ?></p>
			<div class="">
				<a class="button button-orange" href="<?php echo $acf_fields['homepage_orange_button_link']; ?>">
					<?php echo $acf_fields['homepage_orange_button_text']; ?>
				</a>
				<a class="button homepage-hero-transparent-button" href="<?php echo $acf_fields['homepage_transparent_button_link']; ?>">
					<?php echo $acf_fields['homepage_transparent_button_text']; ?>
				</a>
			</div>
		</div>
		<div class="home-hero-social">
			<a href="https://twitter.com/startupacademyy" target="_blank"><span class="fa fa-twitter"></span></a>
			<a href="https://www.facebook.com/startupacademy.org" target="_blank"><span class="fa fa-facebook"></span></a>
			<a href="https://www.instagram.com/startupacademyorg/" target="_blank"><span class="fa fa-instagram"></span></a>
			<a href="https://www.linkedin.com/company/startupacademy.org" target="_blank"><span class="fa fa-linkedin"></span></a>
		</div>
	</section>

	<!-- Video What is StartupAcademy -->
	<section id="homepage-section-video" class="slanted-section background-white" >
		<div class="slanted-section-l-r-inner background-white" >
			<div class="skew-inner">
				<div class="div-overlap-top">
					<div class="homepage-video-container">
						<iframe src="https://player.vimeo.com/video/191234056" width="640" height="260" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
					<div class="homepage-video-content">
						<h2><?php echo $acf_fields['homepage_video_title']?></h2>
						<div class="under-header-div"></div>
						<p><?php echo $acf_fields['homepage_video_text']?></p>
						<a class="button orange-button" href="<?php echo $acf_fields['homepage_video_button_link']?>">
							<?php echo $acf_fields['homepage_video_button_text']?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- What is 3 Step Start? 1.Think Like An Entrepreneur -->
	<section id="homepage-section-step-1" class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div class="what-is">
					<h2><?php echo $acf_fields['section_1_main_title']?></h2>
					<div class="under-header-div"></div>
					<p><?php echo $acf_fields['section_1_main_text']?></p>
					<a class="button button-orange" href="<?php echo $acf_fields['section_1_main_button_link']?>">
						<?php echo $acf_fields['section_1_main_button_text']?>
					</a>
				</div>
				<div id="step-1-lessons" class="lessons align-left">
					<div class="big-lesson-number">1</div>
					<h2><?php echo $acf_fields['section_1_title']?></h2>
					<div class="under-header-div"></div>
					<a class="button button-orange" href="<?php echo $acf_fields['section_1_button_link']?>">
						<?php echo $acf_fields['section_1_button_text']?>
					</a>
					<p><small>*STEP 1 is completely free with a discovery pass</small></p>
					<p><?php echo $acf_fields['section_1_text']?></p>
					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_1_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
								<a href="<?php echo $row['class_link']?>">
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-coach">
											<img src="<?php echo esc_attr( $row['class_author_picture'] ); ?>" />
										</div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small><?php echo $row['class_author']?></small>
										</div>
										<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
									</div>
								</a>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 2 Launch Your Startup Idea -->
	<section id="homepage-section-step-2" class="slanted-section background-medium">
		<div class="slanted-section-l-r-inner background-medium" >
			<div class="skew-inner">
				<div id="step-2-lessons" class="lessons align-right">
					<div class="big-lesson-number">2</div>
					<h2><?php echo $acf_fields['section_2_title']?></h2>
					<div class="under-header-div"></div>
					<p class="section-text"><?php echo $acf_fields['section_2_text']?></p>
					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_2_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
								<a href="<?php echo $row['class_link']?>">
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-coach">
											<img src="<?php echo esc_attr( $row['class_author_picture'] ); ?>" />
										</div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small><?php echo $row['class_author']?></small>
										</div>
										<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
									</div>
								</a>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. Grow Your Startup -->
	<section id="homepage-section-step-3" class="slanted-section background-dark">
		<div class="slanted-section-r-l-inner background-dark" >
			<div class="skew-inner">
				<div id="step-3-lessons" class="lessons align-left">
					<div class="big-lesson-number">3</div>
					<h2><?php echo $acf_fields['section_3_title']?></h2>
					<div class="under-header-div"></div>
					<p class="section-text"><?php echo $acf_fields['section_3_text']?></p>
					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_3_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
								<a href="<?php echo $row['class_link']?>">
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-coach">
											<img src="<?php echo esc_attr( $row['class_author_picture'] ); ?>" />
										</div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small><?php echo $row['class_author']?></small>
										</div>
										<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
									</div>
								</a>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- LEARN FROM WORLD CLASS ENTREPRENEURS -->
	<section id="homepage-section-learn-from">
		<div class="skew-inner">
			<h2><?php echo $acf_fields['homepage_learn_title']; ?></h2>
			<div class="under-header-div"></div>
			<p><?php echo $acf_fields['homepage_learn_text']; ?></p>
			<a class="button button-orange" href="<?php echo $acf_fields['homepage_learn_button_link']; ?>">
				<?php echo $acf_fields['homepage_learn_button_text']; ?>
			</a>
		</div>
	</section>

	<!-- OUR PARTNERS -->
	<section id="homepage-section-partners">
		<div class="skew-inner">
			<h2><?php echo $acf_fields['homepage_our_partners_title']; ?></h2>
			<div class="under-header-div"></div>
			<p><?php echo $acf_fields['homepage_our_partners_text']; ?></p>
			<div class="partner-list">
				<?php
				$rows = $acf_fields['homepage_our_partners_list'];
				if ( $rows ) {
					foreach( $rows as $row ) {
						?>
						<a href="<?php echo $row['partner_link']?>">
							<img src="<?php echo $row['partner_image']?>" />
						</a>
						<?php
					}
				}
				?>
			</div>
			<p>We are also a proud supporter of</p><br />
			<img class="gen-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-gen@2x.png" />
		</div>
	</section>



<?php }
//* Run the Genesis loop
genesis();
