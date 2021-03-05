<?php

namespace WeDevs\Academy\Frontend;

/**
 * Class Shortcode
 * 
 * Create Shortcodes for frontend
 */
class Shortcode
{
    function __construct() {
        add_shortcode( 'wedevs-academy', [ $this, 'render_shortcode' ] );
    }

    /**
     * Shortcode handler class
     *
     * @param array $atts
     * @param string $content
     * 
     * @return string
     */
    public function render_shortcode( $atts, $content = '')
    {

        wp_enqueue_script( 'academy-script' );
        wp_enqueue_style( 'academy-style' );

        return "<div class='academy-shortcode'>Hello Short code</div>";
    }
}
