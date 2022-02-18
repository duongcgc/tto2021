<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

	<?php TTO_Title::for_404(); ?>

	<?php TTO_Template_Part::render('content','404'); ?>
	

<?php
get_footer();
