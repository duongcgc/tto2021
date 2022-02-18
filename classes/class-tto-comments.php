<?php
defined('ABSPATH') || exit;

/**
 * Theme HTML functions class
 */

if (!class_exists('TTO_Comments')) {
    class TTO_Comments {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

        }


        // List Comments
        public static function render() {
        ?>
        
        <ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 60,
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

        <?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'twentytwentyone' ); ?></p>
		<?php endif; ?>

        <?php    
        }

        // Comment Form
        public static function render_form() {
            comment_form(
                array(
                    'title_reply'        => esc_html__( 'Leave a comment', 'twentytwentyone' ),
                    'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
                    'title_reply_after'  => '</h2>',
                )
            );
        }

    }

    TTO_Comments::instance()->start();
}
