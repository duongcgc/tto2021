<?php
defined('ABSPATH') || exit;

/**
 * Template Sidebar class
 */

if (!class_exists('TTO_Sidebar')) {
    class TTO_Sidebar {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            echo 'Sidebar';
        }

        public static function render() {
            TTO_Sidebar::instance()->start();
        }
    }
}
