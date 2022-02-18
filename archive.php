<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if (have_posts()) :

	TTO_Title::for_archive();

	while (have_posts()) :

		the_post();

		TTO_Template_Part::render('content', TTO_Theme::get_setting('display_excerpt_or_full_post', 'excerpt'));

	endwhile;

	TTO_Template_Tag::twenty_twenty_one_the_posts_navigation();

else :

	TTO_Template_Part::render('none');
	
endif;

get_footer();
