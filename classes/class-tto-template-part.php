<?php
defined('ABSPATH') || exit;

/**
 * Theme HTML functions class
 */

if (!class_exists('TTO_Template_Part')) {
    class TTO_Template_Part {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {
        }

        // Render the template part
        public static function render($folder = '', $part = '') {


            if ( ($folder != '') && ($part != 'none') )  {

                if ( strpos($folder, '/') ) {
                    get_template_part($folder, $part);
                } else {
                    get_template_part('template-parts/' . $folder . '/' . $folder, $part);
                }                

            } else {

                get_template_part('template-parts/content/content-none');
            }
        }
    }

    TTO_Template_Part::instance()->start();
}
