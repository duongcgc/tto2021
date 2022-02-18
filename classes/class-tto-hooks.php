<?php
defined('ABSPATH') || exit;

/**
 * Theme Hooks - actions and filters class
 */

if (!class_exists('TTO_Hooks')) {
    class TTO_Hooks {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Hooks here

        }

        function tto_svg_icons_social($icons) {
            return apply_filters('tto_svg_icons_social', $icons);
        }

        function tto_social_icons_map($icons_map) {
            return apply_filters('twenty_twenty_one_social_icons_map', $icons_map);
        }

        function tto_image_size($size = 'full') {
            return apply_filters('twenty_twenty_one_attachment_size', $size);
        }
    }

    TTO_Hooks::instance()->start();
}
