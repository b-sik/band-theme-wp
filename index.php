<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * Please see /external/bootstrap-utilities.php for info on Starkers_Utilities::get_template_parts()
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
		'parts/shared/news',
		'parts/shared/footer',
		'parts/shared/html-footer',
	)
);
