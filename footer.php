<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

			TTO_HTML_Tag::instance()->close('', 'content');
		TTO_HTML_Tag::instance()->close('', 'primary');
	TTO_HTML_Tag::instance()->close('main', 'main');

	TTO_Footer::instance()->render(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
