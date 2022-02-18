<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php TTO_Theme_Prop::twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?>
	</a>

	<?php TTO_Header::instance()->render(); ?>

	<?php
	
		TTO_HTML_Tag::instance()->open('', 'content', 'site-content');
		TTO_HTML_Tag::instance()->open('', 'primary', 'content-area');
		TTO_HTML_Tag::instance()->open('main', 'main', 'site-main');
			
	?>