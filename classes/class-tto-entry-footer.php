<?php
defined('ABSPATH') || exit;

/**
 * Entry footer class
 */

if (!class_exists('TTO_Entry_Footer')) {
    class TTO_Entry_Footer {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Entry Footer here

        }

        // for page content
        public static function for_page() {

            if (get_edit_post_link()) : 
            ?>

                <footer class="entry-footer default-max-width">
                    <?php
                    edit_post_link(
                        sprintf(
                            /* translators: %s: Name of current post. Only visible to screen readers. */
                            esc_html__('Edit %s', 'twentytwentyone'),
                            '<span class="screen-reader-text">' . get_the_title() . '</span>'
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->

            <?php 
            endif;

        }

        // for page excerpt
        public static function for_excerpt() {

        ?>

            <footer class="entry-footer default-max-width">

                <?php TTO_Template_Tag::twenty_twenty_one_entry_meta_footer(); ?>

            </footer><!-- .entry-footer -->

        <?php    

        }

        // for single
        public static function for_single() {

        ?>

            <footer class="entry-footer default-max-width">
                <?php TTO_Template_Tag::twenty_twenty_one_entry_meta_footer(); ?>
            </footer><!-- .entry-footer -->

        <?php    

        }

        // for post
        public static function for_post() {

        ?>

            <footer class="entry-footer default-max-width">
                <?php TTO_Template_Tag::twenty_twenty_one_entry_meta_footer(); ?>
            </footer><!-- .entry-footer -->

        <?php    

        }
    }

    TTO_Entry_Footer::instance()->start();
}
