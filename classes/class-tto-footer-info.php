<?php
defined('ABSPATH') || exit;

/**
 * Theme Footer Site Info class
 */

if (!class_exists('TTO_Footer_Info')) {
    class TTO_Footer_Info {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Footer Info 

        }

        // Site Name
        public static function site_name() {
        ?>
            <div class="site-name">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <?php if (get_bloginfo('name') && TTO_Theme::get_setting('display_title_and_tagline', true)) : ?>
                        <?php if (is_front_page() && !is_paged()) : ?>
                            <?php bloginfo('name'); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- .site-name -->
        <?php
        }

        // Private privacy_policy
        public static function privacy_policy() {

            if (function_exists('the_privacy_policy_link')) {
                the_privacy_policy_link('<div class="privacy-policy">', '</div>');
            }

        }


        // Site Info
        public static function site_info() {
        ?>

            <div class="powered-by">
                <?php
                printf(
                    /* translators: %s: WordPress. */
                    esc_html__('Proudly powered by %s.', 'twentytwentyone'),
                    '<a href="' . esc_url(__('https://wordpress.org/', 'twentytwentyone')) . '">WordPress</a>'
                );
                ?>
            </div><!-- .powered-by -->

        <?php    
        }

    }

    TTO_Footer_Info::instance()->start();
}
