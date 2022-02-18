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

	<?php TTO_Title::for_single(); ?>	

	<div class="entry-content">
		<?php

		the_content();

		TTO_PageNav::for_page();

		?>
	</div><!-- .entry-content -->

	<?php TTO_Entry_Footer::for_single(); ?>

	<?php if (!is_singular('attachment')) : ?>
		<?php get_template_part('template-parts/post/author-bio'); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->