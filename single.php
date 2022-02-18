<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	TTO_Template_Part::render('content', 'single');	

	if ( is_attachment() ) {

		// Parent post navigation.
		TTO_PageNav::for_attachment();

	}

	// Comment Teamplate
	TTO_Comments::render_template();

	// Previous/next post navigation.
	TTO_PageNav::for_post();

endwhile; // End of the loop.

get_footer();
