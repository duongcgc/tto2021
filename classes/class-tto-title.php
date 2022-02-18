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


        // article title
        public static function for_article() {
        ?>    
            
            <header class="entry-header alignwide">
			    <?php TTO_Template_Tag::twenty_twenty_one_post_thumbnail(); ?>
		    </header><!-- .entry-header -->

        <?php
        }

        // front-page title
        public static function for_front() {
        ?>    
            
            <header class="entry-header alignwide">
			    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			    <?php TTO_Template_Tag::twenty_twenty_one_post_thumbnail(); ?>
		    </header><!-- .entry-header -->

        <?php
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

        // page none title
        public static function for_none() {
        ?> 

            <header class="page-header alignwide">
            <?php if ( is_search() ) : ?>

                <h1 class="page-title">
                    <?php
                    printf(
                        /* translators: %s: Search term. */
                        esc_html__( 'Results for "%s"', 'twentytwentyone' ),
                        '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                    );
                    ?>
                </h1>

            <?php else : ?>

                <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'twentytwentyone' ); ?></h1>

            <?php endif; ?>
            </header><!-- .page-header -->

        <?php
        }

        // post excerpt
        public static function for_excerpt() {

            // Don't show the title if the post-format is `aside` or `status`.
            $post_format = get_post_format();
            if ( 'aside' === $post_format || 'status' === $post_format ) {
                return;
            }
            ?>

            <header class="entry-header">
                <?php
                the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );
                TTO_Template_Tag::twenty_twenty_one_post_thumbnail();
                ?>
            </header><!-- .entry-header -->

        <?php
        }

        // post title
        public static function for_post() {
        ?>    

            <header class="entry-header">
                <?php if ( is_singular() ) : ?>
                    <?php the_title( '<h1 class="entry-title default-max-width">', '</h1>' ); ?>
                <?php else : ?>
                    <?php the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php endif; ?>

                <?php TTO_Template_Tag::twenty_twenty_one_post_thumbnail(); ?>
            </header><!-- .entry-header -->

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

        // single title
        public static function for_single() {
        ?>    

            <header class="entry-header alignwide">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                <?php TTO_Template_Tag::twenty_twenty_one_post_thumbnail(); ?>
            </header><!-- .entry-header -->

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
