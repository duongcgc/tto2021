<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/**
 * Define constant
 */

$theme = wp_get_theme();

if ( ! empty( $theme['Template']) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'TTO_THEME_NAME', $theme['Name'] );
define( 'TTO_THEME_VERSION', $theme['Version'] );
define( 'TTO_THEME_DIR', get_template_directory() );
define( 'TTO_THEME_URI', get_template_directory_uri() );
define( 'TTO_THEME_ASSETS_URI', get_template_directory_uri() . '/assets' );
define( 'TTO_THEME_IMAGES_URI', TTO_THEME_ASSETS_URI . '/images' );
define( 'TTO_CLASSES_DIR', get_template_directory() . DS . 'classes' );
define( 'TTO_WIDGETS_DIR', get_template_directory() . DS . 'widgets' );
define( 'TTO_CUSTOMIZER_DIR', TTO_THEME_DIR . DS . 'customizer' );
define( 'TTO_PROTOCOL', is_ssl() ? 'https' : 'http' );
define( 'TTO_IS_RTL', is_rtl() ? true : false );

define( 'TTO_ELEMENTOR_DIR', get_template_directory() . DS . 'elementor' );
define( 'TTO_ELEMENTOR_URI', get_template_directory_uri() . '/elementor' );
define( 'TTO_ELEMENTOR_ASSETS_URI', get_template_directory_uri() . '/elementor/assets' );


// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/** 
 * Load Theme Classes
*/

// Enhance the theme by hooking into WordPress.
require_once TTO_CLASSES_DIR . '/class-tto-action-filter.php';

// Template Function.
require_once TTO_CLASSES_DIR . '/class-tto-template-function.php';

// Custom template tags for the theme.
require_once TTO_CLASSES_DIR . '/class-tto-template-tag.php';


// Customizer additions.
require_once TTO_CLASSES_DIR . '/class-tto-customize.php';

// Gutenberg Blocks.
require_once TTO_CLASSES_DIR . '/class-tto-blocks.php';

// Menu Functions.
require_once TTO_CLASSES_DIR . '/class-tto-menu.php';

// Starter Content.
require_once TTO_CLASSES_DIR . '/class-tto-content.php';

// Dark Mode.
require_once TTO_CLASSES_DIR . '/class-tto-dark-mode.php';

// Theme HTML Properties.
require_once TTO_CLASSES_DIR . '/class-tto-theme-prop.php';

// Theme Widgets.
require_once TTO_CLASSES_DIR . '/class-tto-widgets.php';

// Custom Scripts for Customizer
require_once TTO_CLASSES_DIR . '/class-tto-customize-custom.php';

// Theme Enqueue class.
require_once TTO_CLASSES_DIR . '/class-tto-theme-enqueue.php';

// SVG Icons class.
require_once TTO_CLASSES_DIR . '/class-tto-svg-icons.php';

// Custom color classes.
require_once TTO_CLASSES_DIR . '/class-tto-custom-colors.php';

// Theme Class
require_once TTO_CLASSES_DIR . '/class-tto-theme.php';