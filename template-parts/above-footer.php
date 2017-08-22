<?php

add_action('genesis_before_footer', 'start_do_before_footer_section', 1 );

function start_do_before_footer_section() {
	$stylesheet_uri = get_stylesheet_directory_uri();
	?>

	<!-- Become and Entrepreneur Section -->
	<section id="become-an-entrepreneur" style="background-image: url('<?php echo $stylesheet_uri ; ?>/images/img-background-1@3x.jpg'); height: 80vh;">
		<h2>BECOME AN ENTREPRENEUR<br/>#JUSTSTART</h2>
		<p>Start your journey today and get instant access to online tools and resources.</p>
		<a href="#">
			<button>START FOR FREE</button>
		</a>

	</section>
	<?php
}
