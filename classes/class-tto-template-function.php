<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


if (!class_exists('TTO_Template_Function')) {
    class TTO_Template_Function
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
        }

        /**
         * Creates continue reading text.
         *
         * @since Twenty Twenty-One 1.0
         */
        public static function twenty_twenty_one_continue_reading_text()
        {
            $continue_reading = sprintf(
                /* translators: %s: Name of current post. */
                esc_html__('Continue reading %s', 'twentytwentyone'),
                the_title('<span class="screen-reader-text">', '</span>', false)
            );

            return $continue_reading;
        }

        /**
         * Gets the SVG code for a given icon.
         *
         * @since Twenty Twenty-One 1.0
         *
         * @param string $group The icon group.
         * @param string $icon  The icon.
         * @param int    $size  The icon size in pixels.
         * @return string
         */
        public static function twenty_twenty_one_get_icon_svg($group, $icon, $size = 24)
        {
            return TTO_SVG_Icons::get_svg($group, $icon, $size);
        }

        /**
         * Get custom CSS.
         *
         * Return CSS for non-latin language, if available, or null
         *
         * @since Twenty Twenty-One 1.0
         *
         * @param string $type Whether to return CSS for the "front-end", "block-editor", or "classic-editor".
         * @return string
         */
        public static function twenty_twenty_one_get_non_latin_css($type = 'front-end')
        {

            // Fetch site locale.
            $locale = get_bloginfo('language');

            /**
             * Filters the fallback fonts for non-latin languages.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param array $font_family An array of locales and font families.
             */
            $font_family = apply_filters(
                'twenty_twenty_one_get_localized_font_family_types',
                array(

                    // Arabic.
                    'ar'    => array('Tahoma', 'Arial', 'sans-serif'),
                    'ary'   => array('Tahoma', 'Arial', 'sans-serif'),
                    'azb'   => array('Tahoma', 'Arial', 'sans-serif'),
                    'ckb'   => array('Tahoma', 'Arial', 'sans-serif'),
                    'fa-IR' => array('Tahoma', 'Arial', 'sans-serif'),
                    'haz'   => array('Tahoma', 'Arial', 'sans-serif'),
                    'ps'    => array('Tahoma', 'Arial', 'sans-serif'),

                    // Chinese Simplified (China) - Noto Sans SC.
                    'zh-CN' => array('\'PingFang SC\'', '\'Helvetica Neue\'', '\'Microsoft YaHei New\'', '\'STHeiti Light\'', 'sans-serif'),

                    // Chinese Traditional (Taiwan) - Noto Sans TC.
                    'zh-TW' => array('\'PingFang TC\'', '\'Helvetica Neue\'', '\'Microsoft YaHei New\'', '\'STHeiti Light\'', 'sans-serif'),

                    // Chinese (Hong Kong) - Noto Sans HK.
                    'zh-HK' => array('\'PingFang HK\'', '\'Helvetica Neue\'', '\'Microsoft YaHei New\'', '\'STHeiti Light\'', 'sans-serif'),

                    // Cyrillic.
                    'bel'   => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'bg-BG' => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'kk'    => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'mk-MK' => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'mn'    => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'ru-RU' => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'sah'   => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'sr-RS' => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'tt-RU' => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),
                    'uk'    => array('\'Helvetica Neue\'', 'Helvetica', '\'Segoe UI\'', 'Arial', 'sans-serif'),

                    // Devanagari.
                    'bn-BD' => array('Arial', 'sans-serif'),
                    'hi-IN' => array('Arial', 'sans-serif'),
                    'mr'    => array('Arial', 'sans-serif'),
                    'ne-NP' => array('Arial', 'sans-serif'),

                    // Greek.
                    'el'    => array('\'Helvetica Neue\', Helvetica, Arial, sans-serif'),

                    // Gujarati.
                    'gu'    => array('Arial', 'sans-serif'),

                    // Hebrew.
                    'he-IL' => array('\'Arial Hebrew\'', 'Arial', 'sans-serif'),

                    // Japanese.
                    'ja'    => array('sans-serif'),

                    // Korean.
                    'ko-KR' => array('\'Apple SD Gothic Neo\'', '\'Malgun Gothic\'', '\'Nanum Gothic\'', 'Dotum', 'sans-serif'),

                    // Thai.
                    'th'    => array('\'Sukhumvit Set\'', '\'Helvetica Neue\'', 'Helvetica', 'Arial', 'sans-serif'),

                    // Vietnamese.
                    'vi'    => array('\'Libre Franklin\'', 'sans-serif'),

                )
            );

            // Return if the selected language has no fallback fonts.
            if (empty($font_family[$locale])) {
                return '';
            }

            /**
             * Filters the elements to apply fallback fonts to.
             *
             * @since Twenty Twenty-One 1.0
             *
             * @param array $elements An array of elements for "front-end", "block-editor", or "classic-editor".
             */
            $elements = apply_filters(
                'twenty_twenty_one_get_localized_font_family_elements',
                array(
                    'front-end'      => array('body', 'input', 'textarea', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', '.has-drop-cap:not(:focus)::first-letter', '.entry-content .wp-block-archives', '.entry-content .wp-block-categories', '.entry-content .wp-block-cover-image', '.entry-content .wp-block-latest-comments', '.entry-content .wp-block-latest-posts', '.entry-content .wp-block-pullquote', '.entry-content .wp-block-quote.is-large', '.entry-content .wp-block-quote.is-style-large', '.entry-content .wp-block-archives *', '.entry-content .wp-block-categories *', '.entry-content .wp-block-latest-posts *', '.entry-content .wp-block-latest-comments *', '.entry-content p', '.entry-content ol', '.entry-content ul', '.entry-content dl', '.entry-content dt', '.entry-content cite', '.entry-content figcaption', '.entry-content .wp-caption-text', '.comment-content p', '.comment-content ol', '.comment-content ul', '.comment-content dl', '.comment-content dt', '.comment-content cite', '.comment-content figcaption', '.comment-content .wp-caption-text', '.widget_text p', '.widget_text ol', '.widget_text ul', '.widget_text dl', '.widget_text dt', '.widget-content .rssSummary', '.widget-content cite', '.widget-content figcaption', '.widget-content .wp-caption-text'),
                    'block-editor'   => array('.editor-styles-wrapper > *', '.editor-styles-wrapper p', '.editor-styles-wrapper ol', '.editor-styles-wrapper ul', '.editor-styles-wrapper dl', '.editor-styles-wrapper dt', '.editor-post-title__block .editor-post-title__input', '.editor-styles-wrapper .wp-block h1', '.editor-styles-wrapper .wp-block h2', '.editor-styles-wrapper .wp-block h3', '.editor-styles-wrapper .wp-block h4', '.editor-styles-wrapper .wp-block h5', '.editor-styles-wrapper .wp-block h6', '.editor-styles-wrapper .has-drop-cap:not(:focus)::first-letter', '.editor-styles-wrapper cite', '.editor-styles-wrapper figcaption', '.editor-styles-wrapper .wp-caption-text'),
                    'classic-editor' => array('body#tinymce.wp-editor', 'body#tinymce.wp-editor p', 'body#tinymce.wp-editor ol', 'body#tinymce.wp-editor ul', 'body#tinymce.wp-editor dl', 'body#tinymce.wp-editor dt', 'body#tinymce.wp-editor figcaption', 'body#tinymce.wp-editor .wp-caption-text', 'body#tinymce.wp-editor .wp-caption-dd', 'body#tinymce.wp-editor cite', 'body#tinymce.wp-editor table'),
                )
            );

            // Return if the specified type doesn't exist.
            if (empty($elements[$type])) {
                return '';
            }

            // Include file if function doesn't exist.
            if (!function_exists('twenty_twenty_one_generate_css')) {
                require_once get_theme_file_path('inc/custom-css.php'); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
            }

            // Return the specified styles.
            return twenty_twenty_one_generate_css( // @phpstan-ignore-line.
                implode(',', $elements[$type]),
                'font-family',
                implode(',', $font_family[$locale]),
                null,
                null,
                false
            );
        }

        /**
         * Print the first instance of a block in the content, and then break away.
         *
         * @since Twenty Twenty-One 1.0
         *
         * @param string      $block_name The full block type name, or a partial match.
         *                                Example: `core/image`, `core-embed/*`.
         * @param string|null $content    The content to search in. Use null for get_the_content().
         * @param int         $instances  How many instances of the block will be printed (max). Default  1.
         * @return bool Returns true if a block was located & printed, otherwise false.
         */
        public static function twenty_twenty_one_print_first_instance_of_block($block_name, $content = null, $instances = 1)
        {
            $instances_count = 0;
            $blocks_content  = '';

            if (!$content) {
                $content = get_the_content();
            }

            // Parse blocks in the content.
            $blocks = parse_blocks($content);

            // Loop blocks.
            foreach ($blocks as $block) {

                // Sanity check.
                if (!isset($block['blockName'])) {
                    continue;
                }

                // Check if this the block matches the $block_name.
                $is_matching_block = false;

                // If the block ends with *, try to match the first portion.
                if ('*' === $block_name[-1]) {
                    $is_matching_block = 0 === strpos($block['blockName'], rtrim($block_name, '*'));
                } else {
                    $is_matching_block = $block_name === $block['blockName'];
                }

                if ($is_matching_block) {
                    // Increment count.
                    $instances_count++;

                    // Add the block HTML.
                    $blocks_content .= render_block($block);

                    // Break the loop if the $instances count was reached.
                    if ($instances_count >= $instances) {
                        break;
                    }
                }
            }

            if ($blocks_content) {
                /** This filter is documented in wp-includes/post-template.php */
                echo apply_filters('the_content', $blocks_content); // phpcs:ignore WordPress.Security.EscapeOutput
                return true;
            }

            return false;
        }
    }
}
