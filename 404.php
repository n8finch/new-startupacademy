<?php

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
				<?php
				genesis_markup( array(
					'open' => '<article class="entry">',
					'context' => 'entry-404',
				) );

					printf( '<h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'genesis' ) ) );
					echo '<div class="entry-content">';

						if ( genesis_html5() ) :

							echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );

							get_search_form();

						else :
				?>

						<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), trailingslashit( home_url() ) ); ?></p>



				<?php
						endif;

						if ( genesis_a11y( '404-page' ) ) {
							echo '<h2>' . __( 'Sitemap', 'genesis' ) . '</h2>';
							genesis_sitemap( 'h3' );
						} else {
							genesis_sitemap( 'h4' );
						}

					echo '</div>';

				genesis_markup( array(
					'close' => '</article>',
					'context' => 'entry-404',
				) );



				?>
				</div>
			</div>
		</div>
	</section>


<?php }
//* Run the Genesis loop
genesis();
