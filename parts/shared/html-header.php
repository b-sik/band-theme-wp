<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>
		<?php bloginfo('name'); ?>
	</title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico"/>
	  	<script src="https://kit.fontawesome.com/bdbf7f97f2.js" crossorigin="anonymous"></script>
		<?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>
