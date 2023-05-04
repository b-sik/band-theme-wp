<?php
$latest_post_args = array(
	'posts_per_page' => 1,
	'offset'         => 0,
	'orderby'        => 'post_date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
);

$query = new WP_Query( $latest_post_args );
?>

<section id="news" <?php echo post_class( 'container-fluid p-3 bg-dark' ); ?>>
	<h3 class="text-center"><?php echo __( 'News', 'westferry' ); ?></h3>

	<?php
	while ( $query->have_posts() ) :
		$query->the_post();
			global $post;

			$photo = get_the_post_thumbnail_url();
			$alt   = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );

			$show_id  = get_field( 'related_show' );
			$show_url = get_field( 'url', $show_id );
		?>

		<article class="row border-top border-bottom d-flex flex-column flex-md-row py-3 mx-5">
			<div class="col-2 mb-md-1 d-flex align-items-center">
				<small><time class="updated"
						datetime="<?php echo get_post_time( 'c', true ); ?>"><?php echo get_the_date( 'm.d.y' ); ?></time></small>
			</div>
			<div
				class="col-12 <?php echo $photo ? 'col-md-7 col-lg-8 py-3 py-md-0' : 'col-md-10 pt-3 pt-md-0'; ?> d-flex flex-column justify-content-center">
				<header>
					<h4 class="entry-title"><?php echo get_the_title(); ?></h4>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="<?php echo $photo ? 'col-12 col-md-3 col-lg-2 d-flex align-items-center' : 'd-none'; ?>">
				<div class="container-fluid h-100 d-flex justify-content-center align-items-center">
					<a href="<?php echo $show_url; ?>" target="_blank" rel="noopener noreferrer">
						<img src="<?php echo $photo; ?>" alt="<?php echo $alt; ?>"
							class="post-img img-fluid border border-info rounded">
					</a>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</section>
