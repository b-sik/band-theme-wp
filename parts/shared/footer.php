<?php
$bs_wp = new BsWp();

$contact                  = get_page_by_title( 'contact' );
$email                    = get_field( 'email', $contact->ID );
$email_exploded           = explode( '@', $email );
$contact_featured_img_url = get_the_post_thumbnail_url( $contact->ID );

$home               = get_page_by_title( 'home' );
$socials            = get_field( 'social_media', $home->ID );
$streaming_services = get_field( 'streaming_services', $home->ID );
$footer_text        = get_field( 'footer_text', $home->ID );

$icons = array_merge( $streaming_services, $socials );
?>

<footer class="container-fluid justify-content-center vh-100 d-flex align-items-end flex-column mx-0 px-0" style="background-image: linear-gradient(to top, #0e0e2600 25%, #0e0e26ff), url(<?php echo esc_attr( $contact_featured_img_url ); ?>);background-position:center bottom;background-size:cover;background-repeat:no-repeat;">

	<section id="contact" class="container-fluid contact-wrapper flex-grow-1 d-flex flex-column justify-content-center">
		<div class="row bg-dark py-5" style="--bs-bg-opacity: .9;">
			<div class="col-12 d-flex justify-content-center w-100" >
				<a class="text-center email-anchor" href="mailto:<?php echo $email; ?>">
					<span class="d-inline-block h1"><?php echo $email_exploded[0]; ?></span><span class="d-inline-block h1">&commat;<?php echo $email_exploded[1]; ?></span>
				</a>
			</div>
			<div class="row justify-content-center pt-3">
				<?php
				foreach ( $icons as $icon ) :
					$i_title = $icon['title'];
					$i_url   = $icon['url'];
					?>
					<a class="icon-anchor ms-2 p-0" href="<?php echo esc_attr( $i_url ); ?>" target="_blank" rel="noopener noreferrer" style="width:60px;height:60px;">
						<i class="fa-brands fa-<?php echo esc_attr( strtolower( $i_title ) ); ?> h-100 w-100"></i>
					</a>
				<?php endforeach; ?>
			</div>
			<?php
			$bs_wp->get_template_parts(
				array(
					'parts/components/newsletter',
				)
			);
			?>
		</div>

	</section>

	<div class="row py-2 mx-0 w-100">
		<div
			class="col-12 d-flex flex-column align-items-center align-items-lg-start justify-content-center order-2 order-lg-0">
			<small>
				<?php echo $footer_text; ?>
				<p class="m-0 p-0">Made with 🖤 by <a href="https://bsik.dev" target="_blank" rel="noopener noreferrer">bsik.dev</a></p>
			</small>
		</div>
	</div>
</footer>
