<?php
$home = get_page_by_title( 'home' );

$band_name        = get_field( 'band_name', $home->ID );
$featured_img_url = get_the_post_thumbnail_url( $home->ID );
$header_shoutout  = get_field( 'header_shoutout', $home->ID );
?>

<header id="header" class="vh-100 d-flex flex-column position-relative">
	<a class="d-none" rel="me" href="https://mstdn.social/@bsik">Mastodon</a>
	<section id="hero" class="container-fluid hero flex-grow-1 mb-3 px-0"
		style="background-image:url(<?php echo esc_attr( $featured_img_url ); ?>);background-position:center;background-size:cover;">
	</section>
	<div id="hero-content-overlay" class="container-fluid min-vh-100 w-100 position-absolute px-2" style="z-index:1033;">
		<div class="col-12 min-vh-100 w-100 d-flex flex-column justify-content-between text-center text-lg-start px-0">
			<div class="row flex-grow-1 position-relative">	
				<div class="text-outline ">
					<h1 class="band-name sticky-top"><em><?php echo $band_name; ?></em></h1>
				</div>
			</div>
			<div class="row px-2">
				<div class="text-outline col-lg-9" style="color:#fff;">
					<?php echo $header_shoutout; ?>
				</div>
				<div class="col-lg-3 d-flex align-items-center">
					<iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/78ClihQBWOkKN4hnCYyeTB?utm_source=generator" width="100%" height="90" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
				</div>
			</div>
		</div>
	</div>
</header>