<div class="newsletter-wrapper container-fluid pb-5">
	<div class="row">
		<div class="col-10 col-lg-8 offset-1 offset-lg-2">
        <?php //phpcs:ignore
        if ( function_exists( 'newsletters_hardcode' ) ) {
			newsletters_hardcode( false, false, false, 1 );
		}
		?>
		</div>
	</div>
</div>
