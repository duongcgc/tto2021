<?php
defined('ABSPATH') || exit;

/**
 * Page Header class
 */

if (!class_exists('TTO_Page_Header')) {
    class TTO_Page_Header {
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

        public static function render($template = '') {

            if ($template == '') :
            ?>

                <header class="page-header alignwide">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header><!-- .page-header -->            

            <?php
            elseif ($template == 'entry') :
            ?>    

                <header class="entry-header alignwide">
			        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		        </header><!-- .entry-header -->

            <?php    
            elseif ($template == 'search') :
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
            endif;
        }
        
    }

    TTO_Page_Header::instance()->start();
}
