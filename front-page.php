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
	<section id="homepage-section-video" class="slanted-section background-white" >
		<div class="slanted-section-l-r-inner background-white" >
			<div class="skew-inner">
				<div class="div-overlap-top">
					<div class="homepage-video-container">
						<img src="http://newstartinno.dev/wp-content/uploads/2017/08/video-image-holder.png" />
						<!-- <video>
							<source src="https://player.vimeo.com/video/191234056" type="video/mp4">
							<source src="https://player.vimeo.com/video/191234056" type="video/ogg">
						</video> -->
					</div>
					<div class="homepage-video-content">
						<h2><?php echo $acf_fields['homepage_video_title']?></h2>
						<div class="under-header-div"></div>
						<p><?php echo $acf_fields['homepage_video_text']?></p>
						<a href="<?php echo $acf_fields['homepage_video_button_link']?>">
							<button><?php echo $acf_fields['homepage_video_button_text']?></button>
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
					<a href="<?php echo $acf_fields['section_1_main_button_link']?>">
						<button><?php echo $acf_fields['section_1_main_button_text']?></button>
					</a>
				</div>
				<div id="step-1-lessons" class="lessons align-left">
					<div class="big-lesson-number">1</div>
					<h2><?php echo $acf_fields['section_1_title']?></h2>
					<div class="under-header-div"></div>
					<a href="<?php echo $acf_fields['section_1_button_link']?>">
						<button><?php echo $acf_fields['section_1_button_text']?></button>
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
			<div class="homepage-coaches-container">
				<?php
				$args = array(
					'orderby'          => 'rand',
					'order'            => 'DESC',
					'post_type'        => 'coach',
					'post_status'      => 'publish',
					'posts_per_page'   => 10,
					'suppress_filters' => true
				);
				$coaches = get_posts( $args );
				if( $coaches ) {
					$counter = 1;
					foreach( $coaches as $coach ) {
						$coach_name = $coach->post_title;
						$coach_excerpt = $coach->post_excerpt;
						$coach_pic = get_the_post_thumbnail_url($coach->ID);
						$counter > 5 ? $offset_class = 'offset-class' : '';
						?>
						<div class="coach-card <?php echo $offset_class; ?>">
							<img class="coach-image" src="<?php echo $coach_pic?>" />
							<div>
								<div class="coach-name"><?php echo $coach_name; ?></div>
								<div class="coach_excerpt"><?php echo $coach_excerpt; ?></div>
							</div>
						</div>
						<?php
						$counter++;
					}
				}
				?>
			</div>
			<a href="<?php echo $acf_fields['homepage_learn_button_link']; ?>">
				<button><?php echo $acf_fields['homepage_learn_button_text']; ?></button>
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
			<img class="gen-image" src="http://newstartinno.dev/wp-content/uploads/2016/10/img-gen@2x.png" />
		</div>
	</section>



<?php }
//* Run the Genesis loop
genesis();
