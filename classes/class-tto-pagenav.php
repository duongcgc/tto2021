<?php
defined('ABSPATH') || exit;

/**
 * Theme Page - Post Navigation class
 */

if (!class_exists('TTO_PageNav')) {
    class TTO_PageNav {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {
        }

        // Comment Navigation
        public static function for_comment() {
            the_comments_pagination(
                array(
                    'before_page_number' => esc_html__( 'Page', 'twentytwentyone' ) . ' ',
                    'mid_size'           => 0,
                    'prev_text'          => sprintf(
                        '%s <span class="nav-prev-text">%s</span>',
                        is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' ) : TTO_Template_Function::twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' ),
                        esc_html__( 'Older comments', 'twentytwentyone' )
                    ),
                    'next_text'          => sprintf(
                        '<span class="nav-next-text">%s</span> %s',
                        esc_html__( 'Newer comments', 'twentytwentyone' ),
                        is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' ) : TTO_Template_Function::twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' )
                    ),
                )
            );
        }

        // Page Navigation
        public static function for_page() {
            wp_link_pages(
                array(
                    'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'twentytwentyone') . '">',
                    'after'    => '</nav>',
                    /* translators: %: Page number. */
                    'pagelink' => esc_html__('Page %', 'twentytwentyone'),
                )
            ); 
        }

        // Post navigation
        public static function for_post() {

            $twentytwentyone_next = is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_left') : TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_right');
            $twentytwentyone_prev = is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_right') : TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_left');

            $twentytwentyone_next_label     = esc_html__('Next post', 'twentytwentyone');
            $twentytwentyone_previous_label = esc_html__('Previous post', 'twentytwentyone');

            the_post_navigation(
                array(
                    'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p><p class="post-title">%title</p>',
                    'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
                )
            );
        }

        // Attachment Navigation
        public static function for_attachment() {

            // Parent post navigation.
            the_post_navigation(
                array(
                    /* translators: %s: Parent post link. */
                    'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone' ), '%title' ),
                )
            );

        }    
    }

    TTO_PageNav::instance()->start();
}
