<?php
$today      = date( 'Ymd' );
$shows_args = array(
	'post_type'      => 'show',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'meta_query'     => array(
		array(
			'key'     => 'show_date',
			'compare' => '>=',
			'value'   => $today,
		),
	),
	'meta_key'       => 'show_date',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
);

$query = new WP_Query( $shows_args );


if ( ! $query->have_posts() ) : ?>
	<!-- no flyer to display -->
	<?php
	else :

		while ( $query->have_posts() ) :
			$query->the_post();

			$fields = get_fields();
			$fields = $fields['show'];

			$city    = $fields['city'];
			$venue   = $fields['venue'];
			$date    = date( 'm.d.y', strtotime( $fields['date'] ) );
			$support = $fields['support'];
			$url     = $fields['url'];

			if ( has_post_thumbnail() ) {
				?>
				<section id="flyer" class="container-fluid bg-dark d-flex flex-column align-items-center pt-5">
					<div class="row w-100">
						<div class="col-10 col-lg-8 offset-1 offset-lg-2 d-flex justify-content-center">
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_attr( get_the_post_thumbnail_url( null, 'large' ) ); ?>" class="img-fluid rounded-top" alt="<?php echo esc_attr( $date . ' at ' . $venue . ', ' . $city . ' with ' . $support ); ?>">
							</a>
						</div>
					</div>
				</section>
				<?php
				break;
			}

		endwhile;
	endif;
