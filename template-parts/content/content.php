<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php TTO_Title::for_post(); ?>

	<div class="entry-content">
	<?php
		the_content(
			TTO_Template_Function::twenty_twenty_one_continue_reading_text()
		);

		// Page Navigation for posts with more pages
		TTO_PageNav::for_page();

	?>
	</div><!-- .entry-content -->

	<?php TTO_Entry_Footer::for_post(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
