<div class="newsletter-wrapper container-fluid pt-5">
	<div class="row">
		<div class="col-10 col-lg-8 offset-1 offset-lg-2">
			<p class="text-center w-100">Sign up for our newsletter and never miss a show&nbsp;&darr;</p>
        <?php //phpcs:ignore
		if ( function_exists( 'newsletters_hardcode' ) ) {
			newsletters_hardcode( false, false, false, 1 );
		}
		?>
		</div>
	</div>
</div>
