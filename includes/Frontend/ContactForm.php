<?php

namespace WeDevs\Academy\Frontend;

/**
 * Class ContactForm
 * 
 * Create ContactForm Short code for frontend
 */
class ContactForm
{
    function __construct() {
        add_shortcode( 'wedevs-academy-contact-form', [ $this, 'render_shortcode' ] );
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
        wp_enqueue_script( 'academy-contact-script' );
        wp_enqueue_style( 'academy-contact-style' );

        ob_start();
        include __DIR__ . '/views/contact-form.php';

        return ob_get_clean();
    }
}
