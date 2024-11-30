<?php
$page = bsik_get_page_by_title( 'About' );
?>

<section id="about" class="container-fluid bg-dark about-wrapper py-5 min-vh-100">
	<div class="row align-items-center h-100">
		<div class="col-10 col-lg-8 offset-1 offset-lg-2 pt-3 mb-3 text-center border-bottom">
			<h3><?php echo __( 'About the Band', 'westferry' ); ?></h3>
		</div>

		<div class="col-10 offset-1 col-lg-8 offset-lg-2">
			<?php echo apply_filters( 'the_content', $page->post_content ); ?>
		</div>
	</div>
</section>
