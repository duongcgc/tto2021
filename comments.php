<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

?>

<div id="comments" class="comments-area default-max-width <?php echo TTO_Theme::get_option('show_avatars') ? 'show-avatars' : ''; ?>">

	<?php
	if (have_comments()) :
	?>

		<?php TTO_Title::for_comments(); ?>

		<?php TTO_Comments::render(); ?>

		<?php TTO_PageNav::for_comment(); ?>

	<?php endif; ?>

	<?php
	TTO_Comments::render_form();
	?>

</div><!-- #comments -->