<?php

<div class="homepage-coaches-container">
	<?php
	$args = array(
		'orderby'          => 'rand',
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
			$coach_name = $coach->post_title;
			$coach_excerpt = $coach->post_excerpt;
			$coach_pic = get_the_post_thumbnail_url($coach->ID);
			$coach_url = get_the_permalink($coach->ID);
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
