<?php

namespace WeDevs\Academy;

/**
 * Frontend Class
 */
class Frontend {

    function __construct() {
        // Register a Dummy Short code
        new Frontend\Shortcode();

        // Register Contact Form Short code
        new Frontend\ContactForm();
    }
}
