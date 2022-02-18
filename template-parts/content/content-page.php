<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (!is_front_page()) : ?>

		<?php TTO_Title::for_front(); ?>

	<?php elseif (has_post_thumbnail()) : ?>

		<?php TTO_Title::for_article(); ?>

	<?php endif; ?>

	<div class="entry-content">
	<?php
	
		the_content();

		// Page Navigation
		TTO_PageNav::for_page();

	?>
	</div><!-- .entry-content -->

	<?php TTO_Entry_Footer::for_page(); ?>

</article><!-- #post-<?php the_ID(); ?> -->