<?php
defined('ABSPATH') || exit;

/**
 * Theme HTML functions class
 */

if (!class_exists('TTO_Theme_Prop')) {
    class TTO_Theme_Prop {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            /**
             * Add "is-IE" class to body if the user is on Internet Explorer.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */
            add_action('wp_footer', array($this, 'twentytwentyone_add_ie_class'));
        }

        /**
         * Calculate classes for the main <html> element.
         *
         * @since Twenty Twenty-One 1.0
         *
         * @return void
         */
        public static function twentytwentyone_the_html_classes() {
            /**
             * Filters the classes for the main <html> element.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param string The list of classes. Default empty string.
             */
            $classes = apply_filters('twentytwentyone_html_classes', '');
            if (!$classes) {
                return;
            }
            echo 'class="' . esc_attr($classes) . '"';
        }

        public function twentytwentyone_add_ie_class() {
?>
            <script>
                if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
                    document.body.classList.add('is-IE');
                }
            </script>
<?php
        }
    }

    TTO_Theme_Prop::instance()->start();
}
