<?php
defined('ABSPATH') || exit;

/**
 * Theme HTML functions class
 */

if (!class_exists('TTO_Image')) {
    class TTO_Image {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Image here
        }

        // get image data
        public static function getImage($image_size) {
            return wp_get_attachment_image( get_the_ID(), $image_size );
        }

        // get image caption
        public static function render_caption() {
        ?>

            <figcaption class="wp-caption-text">
                <?php echo wp_kses_post( wp_get_attachment_caption() ); ?>
            </figcaption>

        <?php    
        }

        // render full image
        public static function render() {
        ?>

            <figure class="wp-block-image">
				<?php
				/**
				 * Filter the default image attachment size.
				 *
				 * @since Twenty Twenty-One 1.0
				 *
				 * @param string $image_size Image size. Default 'full'.
				 */
				$image_size = TTO_Hooks::instance()->tto_image_size();
				echo self::getImage($image_size);
				?>

				<?php if ( wp_get_attachment_caption() ) : ?>
					<?php self::render_caption(); ?>
				<?php endif; ?>
			</figure><!-- .wp-block-image -->

        <?php
        }
    }

    TTO_Image::instance()->start();
}
