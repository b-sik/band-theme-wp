<?php
$albums_args = array(
	'post_type'      => 'album',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'meta_value',
	'meta_key'       => 'year',
	'order'          => 'DESC',
);

$query = new WP_Query( $albums_args );
?>

<section id="listen" class="container-fluid listen-wrapper bg-dark py-5">
	<div class="row">
		<div class="shows-section-col col-10 offset-1">	
			<!-- {{-- desktop --}} -->
			<div class="carousel slide d-none d-lg-block" data-interval="false" id="postsCarousel">
				<div class="container">
					<div class="row">
						<div class="col-6 ps-0">
							<h3><?php echo __( 'Listen', 'westferry' ); ?></h3>
						</div>
						<div class="col-6 text-md-right lead d-flex justify-content-end align-items-center">
							<a class="btn btn-outline-white prev" href="" title="go back"><i
									class="fa-solid fa-arrow-left"></i></a>
							<a class="btn btn-outline-white next me-3" href="" title="more"><i
									class="fa-solid fa-arrow-right"></i></a>
						</div>
					</div>
				</div>

				<div class="container mt-3">
					<div class="row mt-0">
						<div class="col-12">
							<div class="carousel-inner">
								<?php
									$card_count = 0;

								while ( $query->have_posts() ) :
									$query->the_post();
										$current_post_index = $query->current_post;
										$total_posts        = $query->found_posts;

									if ( $current_post_index % 3 === 0 ) :
										?>
											<div class="card-deck carousel-item <?php echo $current_post_index === 0 ? 'active' : ''; ?>">
									<?php endif; ?>

									<!-- album card -->
										<?php
										$album             = get_fields();
										$description       = $album['description'];
										$year              = $album['year'];
										$label             = $album['label'];
										$bandcamp          = $album['bandcamp'];
										$bandcamp_track_id = $album['bandcamp_track_id'];
										$bandcamp_id_type  = $album['bandcamp_id_type'];

										$title       = get_the_title();
										$artwork_url = get_the_post_thumbnail_url();
										?>

									<div class="card mb-3 mx-0 mx-sm-5 mx-md-1 rounded-0">
										<div class="card-img-top">
											<img class="img-fluid" src="<?php echo $artwork_url; ?>" alt="show flyer" />
										</div>

										<div class="card-body pb-0">
											<h5 class="card-title mb-0"><?php echo $title; ?><small
													class="card-text text-muted mb-0">&nbsp;&#8212;&nbsp;<?php echo $description; ?></small></h5>
											<p class="card-text mb-3"><small
													class="text-muted"><?php echo $year; ?>&nbsp;&#8212;&nbsp;<?php echo $label; ?></small>
											</p>
											<ul class="list-group list-group-flush">
												<li class="list-group-item">
													<iframe style="border: 0; width: 100%; height: 42px;"
														src="https://bandcamp.com/EmbeddedPlayer/<?php echo $bandcamp_id_type; ?>=<?php echo $bandcamp_track_id; ?>/size=small/bgcol=ffffff/linkcol=177e89/artwork=none/transparent=true/"
														seamless><a href="<?php echo $bandcamp; ?>"><?php echo $title; ?></a></iframe>
												</li>
											</ul>
										</div>
									</div>
									<!-- end album card -->

									<?php
									$card_count++;


									if ( $card_count === 3 || $current_post_index === $total_posts - 1 ) :
										?>
									</div> <!-- .card-deck -->
										<?php
										$card_count = 0;

									endif;
								endwhile;
								?>
							</div> <!-- .carousel-inner -->
						</div> <!-- .col -->
					</div> <!-- .row -->
				</div> <!-- .container -->
			</div> <!-- .carousel -->


	<!-- {{-- mobile & tablet --}} -->
			<div class="row justify-content-center d-lg-none">
			<div class="container">
				<h3><?php echo __( 'Listen', 'westferry' ); ?></h3>
			</div>

				<div class="col-12">
					<div class="card-deck d-flex flex-column flex-md-row">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();

								$current_post = $query->current_post;
								$total_posts  = $query->found_posts;

							if ( $current_post < 2 ) :
								?>
								<!-- album card -->
								<?php
									$album             = get_fields();
									$description       = $album['description'];
									$year              = $album['year'];
									$label             = $album['label'];
									$bandcamp          = $album['bandcamp'];
									$bandcamp_track_id = $album['bandcamp_track_id'];
									$bandcamp_id_type  = $album['bandcamp_id_type'];

									$title       = get_the_title();
									$artwork_url = get_the_post_thumbnail_url();
								?>

								<div class="card mb-3 mx-0 mx-sm-5 mx-md-1 rounded-0 w-md-50">
									<div class="card-img-top">
										<img class="img-fluid" src="<?php echo $artwork_url; ?>" alt="album cover" />
									</div>

									<div class="card-body pb-0">
										<h5 class="card-title mb-0"><?php echo $title; ?><small
												class="card-text text-muted mb-0">&nbsp;&#8212;&nbsp;<?php echo $description; ?></small></h5>
										<p class="card-text mb-3"><small
												class="text-muted"><?php echo $year; ?>&nbsp;&#8212;&nbsp;<?php echo $label; ?></small>
										</p>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">
												<iframe style="border: 0; width: 100%; height: 42px;"
													src="https://bandcamp.com/EmbeddedPlayer/<?php echo $bandcamp_id_type; ?>=<?php echo $bandcamp_track_id; ?>/size=small/bgcol=ffffff/linkcol=177e89/artwork=none/transparent=true/"
													seamless><a href="<?php echo $bandcamp; ?>"><?php echo $title; ?></a></iframe>
											</li>
										</ul>
									</div>
								</div>
								<!-- end album card -->
								<?php
							endif;
						endwhile;
						?>
					</div>

				<div class="w-100 d-flex justify-content-center">
					<button class="btn btn-white my-3 text-uppercase" type="button" data-bs-toggle="collapse"
						data-bs-target="#collapseAlbums" aria-expanded="false" aria-controls="collapseAlbums">
						&darr; more
					</button>
				</div>

				<div id="collapseAlbums" class="card-deck flex-column flex-lg-row collapse mt-3">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

							$current_post = $query->current_post;
							$total_posts  = $query->found_posts;

						if ( $current_post >= 2 ) :
							?>
							<!-- album card -->
							<?php
									$album             = get_fields();
									$description       = $album['description'];
									$year              = $album['year'];
									$label             = $album['label'];
									$bandcamp          = $album['bandcamp'];
									$bandcamp_track_id = $album['bandcamp_track_id'];
									$bandcamp_id_type  = $album['bandcamp_id_type'];

									$title       = get_the_title();
									$artwork_url = get_the_post_thumbnail_url();
							?>

								<div class="card mb-3 mx-0 mx-sm-5 mx-md-1 rounded-0 w-md-50">
									<div class="card-img-top">
										<img class="img-fluid w-100" src="<?php echo $artwork_url; ?>" alt="show flyer" />
									</div>

									<div class="card-body pb-0">
										<h5 class="card-title mb-0"><?php echo $title; ?><small
												class="card-text text-muted mb-0">&nbsp;&#8212;&nbsp;<?php echo $description; ?></small></h5>
										<p class="card-text mb-3"><small
												class="text-muted"><?php echo $year; ?>&nbsp;&#8212;&nbsp;<?php echo $label; ?></small>
										</p>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">
												<iframe style="border: 0; width: 100%; height: 42px;"
													src="https://bandcamp.com/EmbeddedPlayer/<?php echo $bandcamp_id_type; ?>=<?php echo $bandcamp_track_id; ?>/size=small/bgcol=ffffff/linkcol=177e89/artwork=none/transparent=true/"
													seamless><a href="<?php echo $bandcamp; ?>"><?php echo $title; ?></a></iframe>
											</li>
										</ul>
									</div>
								</div>
								<!-- end album card -->
							<?php
						endif;
					endwhile;
					?>
				</div> <!-- #collapseAlbums -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- section col -->
	</div> <!-- section row -->
</section>
