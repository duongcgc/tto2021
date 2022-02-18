<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

defined('ABSPATH') || exit;

/**
 * Theme Actions and Filters class
 */

if (!class_exists('TTO_Action_Filter')) {
    class TTO_Action_Filter
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
             * Filters the list of attachment image attributes.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param string[]     $attr       Array of attribute values for the image markup, keyed by attribute name.
             *                                 See wp_get_attachment_image().
             * @param WP_Post      $attachment Image attachment post.
             * @param string|int[] $size       Requested image size. Can be any registered image size name, or
             *                                 an array of width and height values in pixels (in that order).
             * @return string[] The filtered attributes for the image markup.
             */

            add_filter('wp_get_attachment_image_attributes', array($this, 'twenty_twenty_one_get_attachment_image_attributes'), 10, 3);

            /**
             * Retrieve protected post password form content.
             *
             * @since Twenty Twenty-One 1.0
             * @since Twenty Twenty-One 1.4 Corrected parameter name for `$output`,
             *                              added the `$post` parameter.
             *
             * @param string      $output The password form HTML output.
             * @param int|WP_Post $post   Optional. Post ID or WP_Post object. Default is global $post.
             * @return string HTML content for password form for password protected post.
             */

            add_filter('the_password_form', array($this, 'twenty_twenty_one_password_form'), 10, 2);

            /**
             * Changes the default navigation arrows to svg icons
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param string $calendar_output The generated HTML of the calendar.
             * @return string
             */

            add_filter('get_calendar', array($this, 'twenty_twenty_one_change_calendar_nav_arrows'));

            /**
             * Adds a title to posts and pages that are missing titles.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param string $title The title.
             * @return string
             */

            add_filter('the_title', array($this, 'twenty_twenty_one_post_title'));

            // Filter the excerpt more link.
            add_filter('excerpt_more', array($this, 'twenty_twenty_one_continue_reading_link_excerpt'));

            // Filter the excerpt more link.
            add_filter('the_content_more_link', array($this, 'twenty_twenty_one_continue_reading_link'));

            /**
             * Adds custom classes to the array of body classes.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param array $classes Classes for the body element.
             * @return array
             */

            add_filter('body_class', array($this, 'twenty_twenty_one_body_classes'));

            /**
             * Adds custom class to the array of posts classes.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param array $classes An array of CSS classes.
             * @return array
             */

            add_filter('post_class', array($this, 'twenty_twenty_one_post_classes'), 10, 3);

            /**
             * Add a pingback url auto-discovery header for single posts, pages, or attachments.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */

            add_action('wp_head', array($this, 'twenty_twenty_one_pingback_header'));

            /**
             * Remove the `no-js` class from body if JS is supported.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @return void
             */

            add_action('wp_footer', array($this, 'twenty_twenty_one_supports_js'));

            /**
             * Changes comment form default fields.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param array $defaults The form defaults.
             * @return array
             */

            add_filter('comment_form_defaults', array($this, 'twenty_twenty_one_comment_form_defaults'));
        }

        public function twenty_twenty_one_post_classes($classes)
        {
            $classes[] = 'entry';

            return $classes;
        }

        public function twenty_twenty_one_pingback_header()
        {
            if (is_singular() && pings_open()) {
                echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
            }
        }

        public function twenty_twenty_one_supports_js()
        {
            echo '<script>document.body.classList.remove("no-js");</script>';
        }

        public function twenty_twenty_one_comment_form_defaults($defaults)
        {

            // Adjust height of comment form.
            $defaults['comment_field'] = preg_replace('/rows="\d+"/', 'rows="5"', $defaults['comment_field']);

            return $defaults;
        }

        public function twenty_twenty_one_post_title($title)
        {
            return '' === $title ? esc_html_x('Untitled', 'Added to posts and pages that are missing titles', 'twentytwentyone') : $title;
        }

        public function twenty_twenty_one_change_calendar_nav_arrows($calendar_output)
        {
            $calendar_output = str_replace('&laquo; ', is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_right') : TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_left'), $calendar_output);
            $calendar_output = str_replace(' &raquo;', is_rtl() ? TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_left') : TTO_Template_Function::twenty_twenty_one_get_icon_svg('ui', 'arrow_right'), $calendar_output);
            return $calendar_output;
        }

        public function twenty_twenty_one_password_form($output, $post = 0)
        {
            $post   = get_post($post);
            $label  = 'pwbox-' . (empty($post->ID) ? wp_rand() : $post->ID);
            $output = '<p class="post-password-message">' . esc_html__('This content is password protected. Please enter a password to view.', 'twentytwentyone') . '</p>
            <form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form" method="post">
            <label class="post-password-form__label" for="' . esc_attr($label) . '">' . esc_html_x('Password', 'Post password form', 'twentytwentyone') . '</label><input class="post-password-form__input" name="post_password" id="' . esc_attr($label) . '" type="password" size="20" /><input type="submit" class="post-password-form__submit" name="' . esc_attr_x('Submit', 'Post password form', 'twentytwentyone') . '" value="' . esc_attr_x('Enter', 'Post password form', 'twentytwentyone') . '" /></form>
            ';
            return $output;
        }

        public function twenty_twenty_one_get_attachment_image_attributes($attr, $attachment, $size)
        {
            if (is_admin()) {
                return $attr;
            }

            if (isset($attr['class']) && false !== strpos($attr['class'], 'custom-logo')) {
                return $attr;
            }

            $width  = false;
            $height = false;

            if (is_array($size)) {
                $width  = (int) $size[0];
                $height = (int) $size[1];
            } elseif ($attachment && is_object($attachment) && $attachment->ID) {
                $meta = wp_get_attachment_metadata($attachment->ID);
                if (isset($meta['width']) && isset($meta['height'])) {
                    $width  = (int) $meta['width'];
                    $height = (int) $meta['height'];
                }
            }

            if ($width && $height) {

                // Add style.
                $attr['style'] = isset($attr['style']) ? $attr['style'] : '';
                $attr['style'] = 'width:100%;height:' . round(100 * $height / $width, 2) . '%;max-width:' . $width . 'px;' . $attr['style'];
            }

            return $attr;
        }

        /**
         * Creates the continue reading link.
         *
         * @since Twenty Twenty-One 1.0
         */
        public function twenty_twenty_one_continue_reading_link()
        {
            if (!is_admin()) {
                return '<div class="more-link-container"><a class="more-link" href="' . esc_url(get_permalink()) . '#more-' . esc_attr(get_the_ID()) . '">' . TTO_Template_Function::twenty_twenty_one_continue_reading_text() . '</a></div>';
            }
        }

        /**
         * Creates the continue reading link for excerpt.
         *
         * @since Twenty Twenty-One 1.0
         */
        public function twenty_twenty_one_continue_reading_link_excerpt()
        {
            if (!is_admin()) {
                return '&hellip; <a class="more-link" href="' . esc_url(get_permalink()) . '">' . TTO_Template_Function::twenty_twenty_one_continue_reading_text() . '</a>';
            }
        }

        /**
         * Returns the size for avatars used in the theme.
         *
         * @since Twenty Twenty-One 1.0
         *
         * @return int
         */
        public function twenty_twenty_one_get_avatar_size()
        {
            return 60;
        }

        /**
         * Determines if post thumbnail can be displayed.
         *
         * @since Twenty Twenty-One 1.0
         *
         * @return bool
         */
        public static function twenty_twenty_one_can_show_post_thumbnail()
        {
            /**
             * Filters whether post thumbnail can be displayed.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param bool $show_post_thumbnail Whether to show post thumbnail.
             */
            return apply_filters(
                'twenty_twenty_one_can_show_post_thumbnail',
                !post_password_required() && !is_attachment() && has_post_thumbnail()
            );
        }

        public function twenty_twenty_one_body_classes($classes)
        {

            // Helps detect if JS is enabled or not.
            $classes[] = 'no-js';

            // Adds `singular` to singular pages, and `hfeed` to all other pages.
            $classes[] = is_singular() ? 'singular' : 'hfeed';

            // Add a body class if main navigation is active.
            if (has_nav_menu('primary')) {
                $classes[] = 'has-main-navigation';
            }

            // Add a body class if there are no footer widgets.
            if (!is_active_sidebar('sidebar-1')) {
                $classes[] = 'no-widgets';
            }

            return $classes;
        }
    }

    TTO_Action_Filter::instance()->start();
}
