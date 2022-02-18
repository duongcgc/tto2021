<?php

/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

defined('ABSPATH') || exit;

/**
 * Template Header class
 */

if (!class_exists('TTO_Header')) {
    class TTO_Header {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // starting object
        }

        // get wrapper_classes of header
        protected static function wrapper_classes() {

            $wrapper_classes  = 'site-header';
            $wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
            $wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
            $wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';

            return $wrapper_classes;
        }

        public function render() {
        ?>
            <header id="masthead" class="<?php echo esc_attr(self::wrapper_classes()); ?>">

                <?php get_template_part('template-parts/header/site-branding'); ?>
                <?php get_template_part('template-parts/header/site-nav'); ?>

            </header><!-- #masthead -->
        <?php
        }
    }

    TTO_Header::instance()->start();

}
