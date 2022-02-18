<?php
defined('ABSPATH') || exit;

/**
 * Theme class
 */

if (!class_exists('TTO_Widgets')) {
    class TTO_Widgets
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
             * Register widget area.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
             *
             * @return void
             */
            add_action('widgets_init', array( $this, 'twenty_twenty_one_widgets_init'));
        }

        public function twenty_twenty_one_widgets_init()
        {
            register_sidebar(
                array(
                    'name'          => esc_html__('Footer', 'twentytwentyone'),
                    'id'            => 'sidebar-1',
                    'description'   => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h2 class="widget-title">',
                    'after_title'   => '</h2>',
                )
            );
        }
    }

    TTO_Widgets::instance()->start();
}
