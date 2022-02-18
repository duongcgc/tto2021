<?php

/**
 * Template part for displaying page content in 404.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<div class="error-404 not-found default-max-width">
	<div class="page-content">
		<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone'); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</div><!-- .error-404 -->