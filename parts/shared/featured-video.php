<?php
$home       = bsik_get_page_by_title( 'home' );
$video      = get_field( 'featured_video', $home->ID, false, false );
$video_desc = get_field( 'featured_video_desc', $home->ID );
?>

<section id="featured_video" class="container-fluid bg-dark d-flex flex-column align-items-center py-5">
	<div class="row w-100">
		<div class="col-10 col-lg-8 offset-1 offset-lg-2">
			<div class="ratio ratio-16x9">
				<?php echo $video; ?>
			</div>
		</div>
	</div>
</section>
