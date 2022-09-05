<?php
$home       = get_page_by_title( 'home' );
$video      = get_field( 'featured_video', $home->ID );
$video_desc = get_field( 'featured_video_desc', $home->ID );
?>

<section id="featured_video" class="container-fluid bg-dark d-flex flex-column align-items-center py-5">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="embed-container">
				<?php echo $video; ?>
			</div>
		</div>
	</div>
</section>
