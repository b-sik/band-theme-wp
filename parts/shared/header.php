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

$band_name          = get_field( 'band_name', $home->ID );
$featured_img_url   = get_the_post_thumbnail_url( $home->ID );
?>

<header id="header" class="vh-100 d-flex flex-column position-relative">
	<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-info bg-gradient px-2 py-1 py-lg-0 position-fixed w-100">
		<div class="row justify-content-apart px-0 mx-0 w-100">
			<div class="col-9 col-lg-3 d-flex align-items-center ps-0">
				<a href="#" class="h1 brand"><?php echo esc_html( $band_name ); ?></a>
			</div>
			<div class="col-6 d-none d-lg-flex align-items-center justify-content-center">
				<?php wp_nav_menu( $menu_args_desktop ); ?>
			</div>
			<div class="col-3 d-lg-flex align-items-center justify-content-end pe-0">
				<div class="container d-none d-lg-flex justify-content-end">
					<div class="row flex-nowrap">
						<?php
						foreach ( $icons as $icon ) :
							$i_title = $icon['title'];
							$i_url   = $icon['url'];
							?>
							<a class="icon-anchor ms-2 p-0" href="<?php echo esc_attr( $i_url ); ?>" target="_blank" rel="noopener noreferrer" style="width:40px;height:40px;">
								<i class="fa-brands fa-<?php echo esc_attr( strtolower( $i_title ) ); ?> h-100 w-100"></i>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="container h-100 d-flex d-lg-none align-items-center px-0">
					<button id="navbar-toggle" class="navbar-toggle btn btn-primary ms-auto" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon d-flex align-items-center justify-content-center">
							<i class="fas fa-bars"></i>
						</span>
					</button>
				</div>
			</div>
			<div class="col-12 mobile-menu d-lg-none p-0 text-center h-100">
				<?php wp_nav_menu( $menu_args_mobile ); ?>
			</div>
		</div>
	</nav> -->
	<section class="container-fluid hero flex-grow-1 mb-3 px-0"
		style="background-image:url(<?php echo esc_attr( $featured_img_url ); ?>);background-position:center;background-size:cover;">
	</section>
	<div id="hero-content-overlay" class="container-fluid min-vh-100 w-100 position-absolute px-2" style="z-index:1033;">
		<div class="col-12 min-vh-100 w-100 d-flex flex-column justify-content-between text-center text-lg-start px-0">
			<div class="text-outline">
				<h1 style="color:#c270d6;"><em>west ferry</em></h1>
			</div>
			<div class="text-outline" style="color:#fff;">
				<h1>NEW EP 'OUT OF REACH'</h1>
				<h2>available now</h2>
			</div>
		</div>
	</div>
</header>

