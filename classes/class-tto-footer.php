<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

defined('ABSPATH') || exit;

/**
 * Template Footer class
 */

if (!class_exists('TTO_Footer')) {
    class TTO_Footer {
        protected static $instance = null;

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Footer here

        }

        public static function render() {

            // Footer Widgets
            TTO_Template_Part::render('footer','widgets');

            ?>
            <footer id="colophon" class="site-footer">

                <?php 

                    TTO_Template_Part::render('footer','menu');
                    TTO_Template_Part::render('footer','site-info');

                ?>

            </footer><!-- #colophon -->
            <?php

        }
    }

    TTO_Footer::instance()->start();

}
