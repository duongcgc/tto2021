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

        function tto_image_size() {
            return apply_filters( 'twenty_twenty_one_attachment_size', 'full' );
        }
    }

    TTO_Hooks::instance()->start();
}
