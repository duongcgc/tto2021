<?php
defined('ABSPATH') || exit;

/**
 * Theme class
 */

if (!class_exists('TTO_Customizer')) {
    class TTO_Customizer
    {
        protected static $instance = null;

        public static function instance()
        {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start()
        {

            /**
             * Enqueue scripts for the customizer preview.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */

            add_action('customize_preview_init', array( $this,'twentytwentyone_customize_preview_init' ));

            /**
             * Enqueue scripts for the customizer.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */

            add_action('customize_controls_enqueue_scripts', array( $this, 'twentytwentyone_customize_controls_enqueue_scripts'));
        }

        public function twentytwentyone_customize_preview_init()
        {
            wp_enqueue_script(
                'twentytwentyone-customize-helpers',
                get_theme_file_uri('/assets/js/customize-helpers.js'),
                array(),
                wp_get_theme()->get('Version'),
                true
            );
        
            wp_enqueue_script(
                'twentytwentyone-customize-preview',
                get_theme_file_uri('/assets/js/customize-preview.js'),
                array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
                wp_get_theme()->get('Version'),
                true
            );
        }
        
        
        public function twentytwentyone_customize_controls_enqueue_scripts()
        {
            wp_enqueue_script(
                'twentytwentyone-customize-helpers',
                get_theme_file_uri('/assets/js/customize-helpers.js'),
                array(),
                wp_get_theme()->get('Version'),
                true
            );
        }
    }

    TTO_Customizer::instance()->start();
}
