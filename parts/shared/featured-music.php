<?php
$home = get_page_by_title( 'home' );

$streaming_services = get_field( 'streaming_services', $home->ID );
$socials            = get_field( 'social_media', $home->ID );

$icons = array_merge( $streaming_services, $socials );
?>

<section id="featured-music" class="container-fluid bg-dark py-5 vh-50">
	<div class="row my-auto py-5">
		<div class="col-10 offset-1 d-flex justify-content-center my-3">
		<iframe style="border: 0; width: 400px; height: 307px;" src="https://bandcamp.com/EmbeddedPlayer/album=834360237/size=large/bgcol=ffffff/linkcol=0687f5/artwork=small/transparent=true/" seamless><a href="https://westferry.bandcamp.com/album/out-of-reach">Out of Reach by west ferry</a></iframe>
		</div>
	</div>
	<div class="row justify-content-center align-items-center">
			<?php
			foreach ( $icons as $icon ) :
				$i_title = $icon['title'];
				$i_url   = $icon['url'];
				?>
				<a class="icon-anchor ms-2 p-0 text-white" href="<?php echo esc_attr( $i_url ); ?>" target="_blank" rel="noopener noreferrer" style="width:50px;height:50px;">
					<i class="fa-brands fa-<?php echo esc_attr( strtolower( $i_title ) ); ?> h-100 w-100"></i>
				</a>
			<?php endforeach; ?>
		</div>
</section>