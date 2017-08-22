<?php

//* Template Name: 3 Step Start
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

// Add custom page content
add_action( 'genesis_loop', 'one_pager_homepage_content' );
function one_pager_homepage_content() {
	global $post;
	$acf_fields = get_fields($post->ID);
	$hero_url = get_the_post_thumbnail_url($post->ID);
	?>

	<!-- Hero Image Header Section -->
	<section class="hero-image-header" style="background-image: url('<?php echo $hero_url; ?>');">
		<div class="hero-text-wrapper">
			<h1><?php echo $acf_fields['3_step_hero_title']; ?></h1>
			<p><?php echo $acf_fields['3_step_hero_text']; ?></p>
		</div>
	</section>

	<div class="three-step-floating-menu">
		<a href="#step-1-lessons">STEP 1</a>
		<a href="#step-2-lessons">STEP 2</a>
		<a href="#step-3-lessons">STEP 3</a>
		<a href="#">GET A PASS</a>
	</div>

	<!-- Section 1  -->
<section id="step-1-lessons" class="slanted-section background-light" >
		<div class="slanted-section-r-l-inner background-light" >
			<div class="skew-inner">
				<div  class="lessons align-left">
					<span class="big-lesson-number">1</span>
					<span>*STEP 1 is completely free with a discovery pass</span>
					<h2><?php echo $acf_fields['section_1_title']?></h2>
					<div class="under-header-div"></div>
					<a href="<?php echo $acf_fields['section_1_button_link']?>">
						<button><?php echo $acf_fields['section_1_button_text']?></button>
					</a>
					<p>
						<b><?php echo $acf_fields['section_1_subhead']?></b><br />
						<small><?php echo $acf_fields['section_1_text']?></small>
					</p>

					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_1_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small>with: <span class="author"><?php echo $row['class_author'];?></span></small>
										</div>
										<div class="lesson-button"><a href="<?php echo $row['class_link']; ?>"><button>FREE</button></a></div>
										<div class="lesson-activities">
											<?php if($row['activity_1_title']) {?>
												<a href="<?php echo $row['activity_1_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_1_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_2_title']) {?>
												<a href="<?php echo $row['activity_2_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_2_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_3_title']) {?>
												<a href="<?php echo $row['activity_3_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_3_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
										</div> <!-- end lesson activities-->
									</div>
								<?php
							}
						}
						?>
					</div> <!-- end lesson-cards -->
				</div>
			</div>
		</div>
	</section>

	<!-- Section 2 -->
	<section id="step-2-lessons" class="slanted-section background-medium">
		<div class="slanted-section-l-r-inner background-medium" >
			<div class="skew-inner">
				<div  class="lessons align-right">
					<div class="big-lesson-number">2</div>
					<h2><?php echo $acf_fields['section_2_title']?></h2>
					<div class="under-header-div"></div>
					<p class="section-text">
						<b><?php echo $acf_fields['section_2_subhead']?></b><br />
						<small><?php echo $acf_fields['section_2_text']?></small>
					</p>
					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_2_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small>with: <span class="author"><?php echo $row['class_author'];?></span></small>
										</div>
										<div class="lesson-button"><a href="<?php echo $row['class_link']; ?>"><button><span class="fa fa-lock"></span> VIEW</button></a></div>
										<div class="lesson-activities">
											<?php if($row['activity_1_title']) {?>
												<a href="<?php echo $row['activity_1_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_1_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_2_title']) {?>
												<a href="<?php echo $row['activity_2_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_2_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_3_title']) {?>
												<a href="<?php echo $row['activity_3_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_3_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
										</div> <!-- end lesson activities-->
									</div>
								<?php
							}
						}
						?>
					</div> <!-- end lesson-cards -->
				</div>
			</div>
		</div>
	</section>

	<!-- Section 3 -->
	<section id="step-3-lessons" class="slanted-section background-dark">
		<div class="slanted-section-r-l-inner background-dark" >
			<div class="skew-inner">
				<div class="lessons align-left">
					<div class="big-lesson-number">3</div>
					<h2><?php echo $acf_fields['section_3_title']?></h2>
					<div class="under-header-div"></div>
					<p class="section-text">
						<b><?php echo $acf_fields['section_3_subhead']?></b><br />
						<small><?php echo $acf_fields['section_3_text']?></small>
					</p>
					<div class="lesson-cards">
						<?php
						$rows = $acf_fields['section_3_classes'];
						if ( $rows ) {
							foreach( $rows as $row ) {
								?>
									<div class="lesson-card">
										<div class="lesson-number"><?php echo $row['class_number']?></div>
										<div class="lesson-info">
											<div><?php echo $row['class_title']?></div>
											<br/>
											<small>with: <span class="author"><?php echo $row['class_author'];?></span></small>
										</div>
										<div class="lesson-button"><a href="<?php echo $row['class_link']; ?>"><button><span class="fa fa-lock"></span> VIEW</button></a></div>
										<div class="lesson-activities">
											<?php if($row['activity_1_title']) {?>
												<a href="<?php echo $row['activity_1_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_1_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_2_title']) {?>
												<a href="<?php echo $row['activity_2_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_2_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
											<?php if($row['activity_3_title']) {?>
												<a href="<?php echo $row['activity_3_link']; ?>">
													<div class="activity-wrapper">
														<div>
															<?php echo $row['activity_3_title']; ?>
														</div>
														<div class="lesson-chevron"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
													</div>
												</a>
											<?php } //end if?>
										</div> <!-- end lesson activities-->
									</div>
								<?php
							}
						}
						?>
					</div> <!-- end lesson-cards -->
				</div>
			</div>
		</div>
	</section>

<?php }
//* Run the Genesis loop
genesis();
