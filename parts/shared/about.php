<?php
$page = get_page_by_title( 'About' );
?>

<section id="about" class="container-fluid bg-dark about-wrapper py-5 gx-5">
	<h3><?php echo __( 'About', 'westferry' ); ?></h3>

	<div class="row justify-content-center">
		<div class="col-12">
			<?php echo apply_filters( 'the_content', $page->post_content ); ?>
		</div>
	</div>
</section>
