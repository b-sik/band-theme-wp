<?php
$home       = get_page_by_title( 'home' );
$video      = get_field( 'featured_video', $home->ID );
$video_desc = get_field( 'featured_video_desc', $home->ID );
?>

<section id="featured_video" class="container d-flex flex-column align-items-center">
	<div class="row">
		<div class="col-12">
			<div class="embed-container">
				<?php echo $video; ?>
			</div>
		</div>
	</div>
</section>
