<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php TTO_Title::for_excerpt(); ?>

	<div class="entry-content">

		<?php TTO_Template_Part::render( 'template-parts/excerpt/excerpt', get_post_format() ); ?>

	</div><!-- .entry-content -->

	<?php TTO_Entry_Footer::for_excerpt(); ?>
	
</article><!-- #post-${ID} -->
