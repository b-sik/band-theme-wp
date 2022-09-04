<?php
$contact                  = get_page_by_title( 'contact' );
$email                    = get_field( 'email', $contact->ID );
$email_exploded           = explode( '@', $email );
$contact_featured_img_url = get_the_post_thumbnail_url( $contact->ID );


$home               = get_page_by_title( 'home' );
$socials            = get_field( 'social_media', $home->ID );
$streaming_services = get_field( 'streaming_services', $home->ID );
$footer_text        = get_field( 'footer_text', $home->ID );

$icon_logo = get_site_icon_url();

$icons = array_merge( $streaming_services, $socials );
?>

<footer class="container-fluid justify-content-center vh-100 d-flex align-items-end flex-column mx-0 px-0" style="background-image: linear-gradient(to top, #0e0e2600 25%, #0e0e26ff), url(<?php echo esc_attr( $contact_featured_img_url ); ?>);background-position:center bottom;background-size:cover;background-repeat:no-repeat;">

	<section id="contact" class="container contact-wrapper flex-grow-1 d-flex flex-column justify-content-center">
		<h3 class="text-center"><?php echo __( 'Contact', 'westferry' ); ?></h3>
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<a class="text-center btn btn-primary" href="mailto:<?php echo $email; ?>">
					<span class="d-inline-block h1"><?php echo $email_exploded[0]; ?></span><span class="d-inline-block h1">&commat;<?php echo $email_exploded[1]; ?></span>
				</a>
			</div>
		</div>
	</section>

	<div class="row py-2 mx-0 flex-grow-0 w-100">
		<div
			class="col-12 col-lg-5 d-flex flex-column align-items-center align-items-lg-start justify-content-center order-2 order-lg-0">
			<small class='d-block'>&copy;&nbsp;<?php echo date( 'Y' ); ?></small>
			<small class='d-block'><?php echo $footer_text; ?></small>
		</div>
		<div class="col-12 col-lg-2 d-flex justify-content-center align-items center">
			<img src="<?php echo $icon_logo; ?>" class="img-fluid w-50 mb-3 mb-lg-0" style="max-width:100px;height:auto;">
		</div>
		<div class="col-12 col-lg-5 pb-3 pb-lg-0 d-flex justify-self-lg-end align-items-center">
			<div class="container d-flex justify-content-center justify-content-lg-end">
				<div class="row">
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
		</div>
	</div>
</footer>
