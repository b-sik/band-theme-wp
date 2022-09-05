<?php
$page = get_page_by_title( 'About' );
?>

<section id="about" class="container-fluid bg-dark about-wrapper py-5 min-vh-100">
	<div class="row align-items-center h-100">
		<div class="col-10 offset-1 py-3">
			<h3><?php echo __( 'About', 'westferry' ); ?></h3>
		</div>

		<div class="col-10 offset-1 col-lg-8 offset-lg-2">
			<?php echo apply_filters( 'the_content', $page->post_content ); ?>
		</div>
	</div>
</section>
