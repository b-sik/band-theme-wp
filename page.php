<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package     WordPress
 * @subpackage  Bootstrap 5.2.0
 * @autor       Babobski
 */
$bs_wp = new BsWp();

$bs_wp->get_template_parts(
	array(
		'parts/shared/html-header',
		'parts/shared/header',
		'parts/shared/featured-music',
		'parts/shared/flyer',
		'parts/shared/shows',
		'parts/shared/newsletter',
		'parts/shared/listen',
		'parts/shared/featured-video',
		'parts/shared/about',
		'parts/shared/contact',
		'parts/shared/footer',
		'parts/shared/html-footer',
	)
);
