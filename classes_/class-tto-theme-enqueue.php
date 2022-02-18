<?php
defined('ABSPATH') || exit;

/**
 * Theme class
 */

if (!class_exists('TTO_Theme_Enqueue')) {
    class TTO_Theme_Enqueue
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
             * Enqueue scripts and styles.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */
            add_action('wp_enqueue_scripts', array( $this, 'twenty_twenty_one_scripts'));

            /**
             * Enqueue block editor script.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */

            add_action('enqueue_block_editor_assets', array( $this, 'twentytwentyone_block_editor_script'));

            /**
             * Fix skip link focus in IE11.
             *
             * This does not enqueue the script because it is tiny and because it is only for IE11,
             * thus it does not warrant having an entire dedicated blocking script being loaded.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @link https://git.io/vWdr2
             */
            add_action('wp_print_footer_scripts', array( $this, 'twenty_twenty_one_skip_link_focus_fix'));

            /**
             * Enqueue non-latin language styles.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */
            add_action('wp_enqueue_scripts', array( $this, 'twenty_twenty_one_non_latin_languages'));

            // Editor Styles
            add_action('after_setup_theme', array( $this, 'tto_editor_styles'));
        }

        public function twenty_twenty_one_non_latin_languages()
        {
            $custom_css = TTO_Template_Function::twenty_twenty_one_get_non_latin_css('front-end');

            if ($custom_css) {
                wp_add_inline_style('twenty-twenty-one-style', $custom_css);
            }
        }
        
        public function twenty_twenty_one_skip_link_focus_fix()
        {

            // If SCRIPT_DEBUG is defined and true, print the unminified file.
            if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
                echo '<script>';
                include TTO_THEME_DIR . '/assets/js/skip-link-focus-fix.js';
                echo '</script>';
            } else {
                // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
                ?>
                <script>
                /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
                </script>
                <?php
            }
        }

        public function tto_editor_styles()
        {
            $editor_stylesheet_path = './assets/css/style-editor.css';
    
            // Note, the is_IE global variable is defined by WordPress and is used
            // to detect if the current browser is internet explorer.
            global $is_IE;
            if ($is_IE) {
                $editor_stylesheet_path = './assets/css/ie-editor.css';
            }
    
            // Enqueue editor styles.
            add_editor_style($editor_stylesheet_path);
        }

        public function twentytwentyone_block_editor_script()
        {
            wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array( 'wp-blocks', 'wp-dom' ), TTO_THEME_VERSION, true);
        }
        
        public function twenty_twenty_one_scripts()
        {
            // Note, the is_IE global variable is defined by WordPress and is used
            // to detect if the current browser is internet explorer.
            global $is_IE, $wp_scripts;
            if ($is_IE) {
                // If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
                wp_enqueue_style('twenty-twenty-one-style', TTO_THEME_URI . '/assets/css/ie.css', array(), TTO_THEME_VERSION);
            } else {
                // If not IE, use the standard stylesheet.
                wp_enqueue_style('twenty-twenty-one-style', TTO_THEME_URI . '/style.css', array(), TTO_THEME_VERSION);
            }

            // RTL styles.
            wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

            // Print styles.
            wp_enqueue_style('twenty-twenty-one-print-style', TTO_THEME_ASSETS_URI . '/css/print.css', array(), TTO_THEME_VERSION, 'print');

            // Threaded comment reply styles.
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }

            // Register the IE11 polyfill file.
            wp_register_script(
                'twenty-twenty-one-ie11-polyfills-asset',
                TTO_THEME_URI . '/assets/js/polyfills.js',
                array(),
                TTO_THEME_VERSION,
                true
            );

            // Register the IE11 polyfill loader.
            wp_register_script(
                'twenty-twenty-one-ie11-polyfills',
                null,
                array(),
                TTO_THEME_VERSION,
                true
            );
            wp_add_inline_script(
                'twenty-twenty-one-ie11-polyfills',
                wp_get_script_polyfill(
                    $wp_scripts,
                    array(
                        'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
                    )
                )
            );

            // Main navigation scripts.
            if (has_nav_menu('primary')) {
                wp_enqueue_script(
                    'twenty-twenty-one-primary-navigation-script',
                    TTO_THEME_URI . '/assets/js/primary-navigation.js',
                    array( 'twenty-twenty-one-ie11-polyfills' ),
                    TTO_THEME_VERSION,
                    true
                );
            }

            // Responsive embeds script.
            wp_enqueue_script(
                'twenty-twenty-one-responsive-embeds-script',
                TTO_THEME_ASSETS_URI . '/js/responsive-embeds.js',
                array( 'twenty-twenty-one-ie11-polyfills' ),
                TTO_THEME_VERSION,
                true
            );
        }
    }

    TTO_Theme_Enqueue::instance()->start();
}
