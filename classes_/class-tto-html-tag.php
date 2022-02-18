<?php
defined('ABSPATH') || exit;

/**
 * HTML tag functions class
 */

if (!class_exists('TTO_HTML_Tag')) {

    class TTO_HTML_Tag {
        protected static $instance = null;
        protected static $tagname = 'div';
        protected static $id = '';
        protected static $class = '';

        public static function instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function start() {

            // Init Code for Footer here

        }

        public function open($tagname = 'div', $id = '', $class = '') {
            
            self::$tagname = $tagname;
            self::$id = $id;
            self::$class = $class;

            $html_tag = '<div';
            if ( self::$tagname != '' ) {
                $html_tag = '<' . self::$tagname;
            }

            if ( self::$id != '' ) {
                $html_tag .= ' id="' . self::$id . '"';
            }

            if ( self::$class != '' ) {
                $html_tag .= ' class="' . self::$class . '"';
            }

            $html_tag .= '>';

            echo $html_tag;

            add_action( 'wp', array( $this, 'push_into_global'));

            return self::$instance;
        }

        public function close($tagname = 'div', $id = '') {
            
            self::$tagname = $tagname;
            self::$id = $id;

           // render close tag

           $html_tag = '</div>';
            if ( self::$tagname != '' ) {
                $html_tag = '</' . self::$tagname . '>';
            }

            // out comment
            if ( self::$id != '' ) {
                $html_tag .= ' <!-- #' . self::$id . ' -->';
            }

            echo $html_tag;
        }
      
    }

}
