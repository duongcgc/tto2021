<?php
defined('ABSPATH') || exit;

/**
 * Page Header class
 */

if (!class_exists('TTO_Title')) {
    class TTO_Title {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Page Header here
            
        }


        // entry title
        public static function for_entry() {
        ?>    

            <header class="entry-header alignwide">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

        <?php
        }

        // 404 title
        public static function for_404() {
        ?>
            <header class="page-header alignwide">
                <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'twentytwentyone' ); ?></h1>
            </header><!-- .page-header -->

        <?php
        }

        // archive title
        public static function for_archive() {

            $description = get_the_archive_description();

        ?> 

            <header class="page-header alignwide">
                <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php if ( $description ) : ?>
                    <div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
                <?php endif; ?>
            </header><!-- .page-header -->

        <?php
        }

        // search title
        public static function for_search() {
        ?>    

            <header class="page-header alignwide">
                <h1 class="page-title">
                    <?php 
                    printf(
                        /* translators: %s: Search term. */
                        esc_html__( 'Results for "%s"', 'twentytwentyone' ),
                        '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                    );
                    ?>
                </h1>
            </header><!-- .page-header -->

        <?php
        }

        // page title
        public static function for_page() {
        ?>    

            <header class="page-header alignwide">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header><!-- .page-header --> 

        <?php
        }

        // commnents title
        public static function for_comments() {
        
            $twenty_twenty_one_comment_count = get_comments_number();
        ?>
        
            <h2 class="comments-title">
                <?php if ( '1' === $twenty_twenty_one_comment_count ) : ?>
                    <?php esc_html_e( '1 comment', 'twentytwentyone' ); ?>
                <?php else : ?>
                    <?php
                    printf(
                        /* translators: %s: Comment count number. */
                        esc_html( _nx( '%s comment', '%s comments', $twenty_twenty_one_comment_count, 'Comments title', 'twentytwentyone' ) ),
                        esc_html( number_format_i18n( $twenty_twenty_one_comment_count ) )
                    );
                    ?>
                <?php endif; ?>
            </h2><!-- .comments-title -->

        <?php
        }

        public static function render($template = '') {
        ?>

            <header class="page-header alignwide">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header><!-- .page-header --> 

        <?php
        }
        
    }

    TTO_Title::instance()->start();
}
