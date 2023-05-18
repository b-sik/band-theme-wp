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

$contact = get_page_by_title( 'contact' );
$email   = get_field( 'email', $contact->ID );

$query = new WP_Query( $shows_args );
?>

<section id="shows" class="container-fluid shows-wrapper bg-dark py-5 d-flex flex-column justify-content-center">
	<div class="row flex-column py-5">
		<div class="shows-section-col col-10 offset-1 text-center">
			<h3><?php echo __( 'Shows', 'westferry' ); ?></h3>

			<?php if ( ! $query->have_posts() ) : ?>
				<div class="container show-wrapper wrapper-border-show">
					<p class="my-3">No shows currently booked! Reach out to us at <a
							href='mailto:<?php echo $email; ?>'><?php echo $email; ?></a>.</p>
				</div>
			<? endif;

			while ($query->have_posts()) :
				$query->the_post();
				
					$fields = get_fields();
					$fields = $fields['show'];
					
					$city = $fields['city'];
					$venue = $fields['venue'];
					$date = date('m.d.y', strtotime($fields['date']));
					$support = $fields['support'];
					$url = $fields['url'];
				?>

				<div class="container-fluid container-md show-wrapper wrapper-border-show my-0">
					<div class="row flex-column flex-sm-row">

						<!-- desktop -->
						<div class="col-4 d-none d-lg-flex flex-column justify-content-center">
							<span class="date_time pb-1"><strong><?php echo $date; ?></strong></span>
							<span class="city pt-1"><?php echo $city; ?></span>
						</div>
						<div class="col-6 ps-lg-5 d-none d-lg-flex flex-column justify-content-center text-start">
							<span class="venue pb-1"><?php echo $venue; ?></span>
							<span class="support pt-1">w/&nbsp;<?php echo $support; ?></span>
						</div>

						<!-- mobile -->
						<div
							class="col-12 col-sm-8 d-flex d-lg-none flex-column align-items-center align-items-sm-start justify-content-center">
							<span class="date_time text-center text-sm-start"><strong><?php echo $date; ?></strong></span>
							<span class="city text-center text-sm-start"><?php echo $city; ?></span>
							<span class="venue text-center text-sm-start"><?php echo $venue; ?></span>
							<span class="support text-center text-sm-start">w/&nbsp;<?php echo $support; ?></span>
						</div>

						<!-- button -->
						<div
							class="col-12 col-sm-4 col-lg-2 d-flex py-3 py-sm-0 flex-column justify-content-center align-items-center align-items-sm-end">
							<a class="event btn btn-primary text-uppercase" href='<?php echo $url; ?>' target="_blank"
								rel='noopener noreferrer'><?php echo __( 'Event', 'westferry' ); ?></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div> <!-- col -->
	</div> <!-- row -->
</section>
