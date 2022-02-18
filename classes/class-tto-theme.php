<?php
defined('ABSPATH') || exit;

/**
 * Theme class
 */

if (!class_exists('TTO_Theme')) {
    class TTO_Theme {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            /**
             * Set the content width in pixels, based on the theme's design and stylesheet.
             *
             * Priority 0 to make it available to lower priority callbacks.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @global int $content_width Content width.
             *
             * @return void
             */
            add_action('after_setup_theme', array($this, 'twenty_twenty_one_content_width'), 0);

            /**
             * Sets up theme defaults and registers support for various WordPress features.
             *
             * Note that this function is hooked into the after_setup_theme hook, which
             * runs before the init hook. The init hook is too late for some features, such
             * as indicating support for post thumbnails.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */
            add_action('after_setup_theme', array($this, 'twenty_twenty_one_setup'));
        }

        // Get Settings
        public static function get_setting($name, $default) {
            return get_theme_mod( $name, $default );
        }

        // Get Options
        public static function get_option($name, $default = '') {
            return get_option($name, $default);
        }

        public function twenty_twenty_one_content_width() {
            // This variable is intended to be overruled from themes.
            // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
        }

        public function twenty_twenty_one_setup() {
            /*
                * Make theme available for translation.
                * Translations can be filed in the /languages/ directory.
                * If you're building a theme based on Twenty Twenty-One, use a find and replace
                * to change 'twentytwentyone' to the name of your theme in all the template files.
                */
            load_theme_textdomain('twentytwentyone', get_template_directory() . '/languages');

            // Add default posts and comments RSS feed links to head.
            add_theme_support('automatic-feed-links');

            /**
             * Let WordPress manage the document title.
             * This theme does not use a hard-coded <title> tag in the document head,
             * WordPress will provide it for us.
             */
            add_theme_support('title-tag');

            /**
             * Add post-formats support.
             */
            add_theme_support('post-formats', array('link', 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
            add_theme_support('post-thumbnails');
            set_post_thumbnail_size(1568, 9999);

            // Main Menus
            register_nav_menus(
                array(
                    'primary' => esc_html__('Primary menu', 'twentytwentyone'),
                    'footer'  => esc_html__('Secondary menu', 'twentytwentyone'),
                )
            );

            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets'));

            /*
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */
            $logo_width  = 300;
            $logo_height = 100;

            add_theme_support(
                'custom-logo',
                array(
                    'height'               => $logo_height,
                    'width'                => $logo_width,
                    'flex-width'           => true,
                    'flex-height'          => true,
                    'unlink-homepage-logo' => true,
                )
            );

            // Add theme support for selective refresh for widgets.
            add_theme_support('customize-selective-refresh-widgets');

            // Add support for Block Styles.
            add_theme_support('wp-block-styles');

            // Add support for full and wide align images.
            add_theme_support('align-wide');

            // Add support for editor styles.
            add_theme_support('editor-styles');
            $background_color = get_theme_mod('background_color', 'D1E4DD');
            if (127 > TTO_Custom_Colors::get_relative_luminance_from_hex($background_color)) {
                add_theme_support('dark-editor-style');
            }

            // Add custom editor font sizes.
            add_theme_support(
                'editor-font-sizes',
                array(
                    array(
                        'name'      => esc_html__('Extra small', 'twentytwentyone'),
                        'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
                        'size'      => 16,
                        'slug'      => 'extra-small',
                    ),
                    array(
                        'name'      => esc_html__('Small', 'twentytwentyone'),
                        'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
                        'size'      => 18,
                        'slug'      => 'small',
                    ),
                    array(
                        'name'      => esc_html__('Normal', 'twentytwentyone'),
                        'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
                        'size'      => 20,
                        'slug'      => 'normal',
                    ),
                    array(
                        'name'      => esc_html__('Large', 'twentytwentyone'),
                        'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
                        'size'      => 24,
                        'slug'      => 'large',
                    ),
                    array(
                        'name'      => esc_html__('Extra large', 'twentytwentyone'),
                        'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
                        'size'      => 40,
                        'slug'      => 'extra-large',
                    ),
                    array(
                        'name'      => esc_html__('Huge', 'twentytwentyone'),
                        'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
                        'size'      => 96,
                        'slug'      => 'huge',
                    ),
                    array(
                        'name'      => esc_html__('Gigantic', 'twentytwentyone'),
                        'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
                        'size'      => 144,
                        'slug'      => 'gigantic',
                    ),
                )
            );

            // Custom background color.
            add_theme_support(
                'custom-background',
                array(
                    'default-color' => 'd1e4dd',
                )
            );

            // Editor color palette.
            $black     = '#000000';
            $dark_gray = '#28303D';
            $gray      = '#39414D';
            $green     = '#D1E4DD';
            $blue      = '#D1DFE4';
            $purple    = '#D1D1E4';
            $red       = '#E4D1D1';
            $orange    = '#E4DAD1';
            $yellow    = '#EEEADD';
            $white     = '#FFFFFF';

            add_theme_support(
                'editor-color-palette',
                array(
                    array(
                        'name'  => esc_html__('Black', 'twentytwentyone'),
                        'slug'  => 'black',
                        'color' => $black,
                    ),
                    array(
                        'name'  => esc_html__('Dark gray', 'twentytwentyone'),
                        'slug'  => 'dark-gray',
                        'color' => $dark_gray,
                    ),
                    array(
                        'name'  => esc_html__('Gray', 'twentytwentyone'),
                        'slug'  => 'gray',
                        'color' => $gray,
                    ),
                    array(
                        'name'  => esc_html__('Green', 'twentytwentyone'),
                        'slug'  => 'green',
                        'color' => $green,
                    ),
                    array(
                        'name'  => esc_html__('Blue', 'twentytwentyone'),
                        'slug'  => 'blue',
                        'color' => $blue,
                    ),
                    array(
                        'name'  => esc_html__('Purple', 'twentytwentyone'),
                        'slug'  => 'purple',
                        'color' => $purple,
                    ),
                    array(
                        'name'  => esc_html__('Red', 'twentytwentyone'),
                        'slug'  => 'red',
                        'color' => $red,
                    ),
                    array(
                        'name'  => esc_html__('Orange', 'twentytwentyone'),
                        'slug'  => 'orange',
                        'color' => $orange,
                    ),
                    array(
                        'name'  => esc_html__('Yellow', 'twentytwentyone'),
                        'slug'  => 'yellow',
                        'color' => $yellow,
                    ),
                    array(
                        'name'  => esc_html__('White', 'twentytwentyone'),
                        'slug'  => 'white',
                        'color' => $white,
                    ),
                )
            );

            add_theme_support(
                'editor-gradient-presets',
                array(
                    array(
                        'name'     => esc_html__('Purple to yellow', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'purple-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__('Yellow to purple', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
                        'slug'     => 'yellow-to-purple',
                    ),
                    array(
                        'name'     => esc_html__('Green to yellow', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'green-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__('Yellow to green', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
                        'slug'     => 'yellow-to-green',
                    ),
                    array(
                        'name'     => esc_html__('Red to yellow', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
                        'slug'     => 'red-to-yellow',
                    ),
                    array(
                        'name'     => esc_html__('Yellow to red', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
                        'slug'     => 'yellow-to-red',
                    ),
                    array(
                        'name'     => esc_html__('Purple to red', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
                        'slug'     => 'purple-to-red',
                    ),
                    array(
                        'name'     => esc_html__('Red to purple', 'twentytwentyone'),
                        'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
                        'slug'     => 'red-to-purple',
                    ),
                )
            );

            /*
            * Adds starter content to highlight the theme on fresh sites.
            * This is done conditionally to avoid loading the starter content on every
            * page load, as it is a one-off operation only needed once in the customizer.
            */
            if (is_customize_preview()) {
                add_theme_support('starter-content', TTO_Content::starter_content());
            }

            // Add support for responsive embedded content.
            add_theme_support('responsive-embeds');

            // Add support for custom line height controls.
            add_theme_support('custom-line-height');

            // Add support for experimental link color control.
            add_theme_support('experimental-link-color');

            // Add support for experimental cover block spacing.
            add_theme_support('custom-spacing');

            // Add support for custom units.
            // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
            add_theme_support('custom-units');

            // Remove feed icon link from legacy RSS widget.
            add_filter('rss_widget_feed_link', '__return_false');
        }
    }

    TTO_Theme::instance()->start();
}
