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

?>

<?php if ( have_posts() ) : ?>

	<?php TTO_Title::for_archive(); ?>

	<?php while ( have_posts() ) : ?>

		<?php the_post(); ?>
		<?php TTO_Template_Part::render('content', TTO_Theme::get_setting('display_excerpt_or_full_post', 'excerpt')) ?>
		
	<?php endwhile; ?>

	<?php TTO_Template_Tag::twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php TTO_Template_Part::render('none'); ?>
<?php endif; ?>

<?php get_footer(); ?>
