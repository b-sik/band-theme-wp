<?php
$home = get_page_by_title( 'home' );

$menu_args_desktop = array(
	'theme_location'  => 'primary',
	'depth'           => 1,
	'container'       => 'div',
	'container_class' => 'd-flex justify-content-center align-items-center h-100 desktop-nav',
	'container_id'    => '',
	'menu_class'      => 'navbar-nav h-100',
	'fallback_cb'     => '__return_false',
	'walker'          => new bootstrap_5_wp_nav_menu_walker(),
);

$menu_args_mobile = array(
	'theme_location'  => 'primary',
	'depth'           => 1,
	'container'       => 'div',
	'container_class' => 'collapse navbar-collapse d-lg-none',
	'container_id'    => 'navbarSupportedContent',
	'menu_class'      => 'navbar-nav d-flex justify-content-center align-items-center',
	'fallback_cb'     => '__return_false',
	'walker'          => new bootstrap_5_wp_nav_menu_walker(),
);

$band_name        = get_field( 'band_name', $home->ID );
$featured_img_url = get_the_post_thumbnail_url( $home->ID );
?>

<header id="header" class="vh-100 d-flex flex-column position-relative">
	<a class="d-none" rel="me" href="https://indieweb.social/@bsik234">Mastodon</a>
	<section id="hero" class="container-fluid hero flex-grow-1 mb-3 px-0"
		style="background-image:url(<?php echo esc_attr( $featured_img_url ); ?>);background-position:center;background-size:cover;">
	</section>
	<div id="hero-content-overlay" class="container-fluid min-vh-100 w-100 position-absolute px-2" style="z-index:1033;">
		<div class="col-12 min-vh-100 w-100 d-flex flex-column justify-content-between text-center text-lg-start px-0">
			<div class="row flex-grow-1 position-relative">	
				<div class="text-outline ">
					<h1 class="band-name sticky-top"><em>west ferry</em></h1>
				</div>
			</div>
			<div class="text-outline" style="color:#fff;">
				<h1>NEW EP 'OUT OF REACH'</h1>
				<h2>available now</h2>
			</div>
		</div>
	</div>
</header>

