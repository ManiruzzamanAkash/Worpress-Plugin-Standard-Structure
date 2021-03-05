<?php

namespace WeDevs\Academy;

/**
 * Ajax handler class
 */
class Ajax {

    function __construct() {
        add_action( 'wp_ajax_wd_ac_academy_contact', [ $this, 'submit_contact' ] );
    }

    /**
     * Submit Contact Form Via Ajax
     *
     * @return void
     */
    public function submit_contact()
    {
        if ( ! wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'wd-ac-contact-form' ) ) {
            wp_send_json_error( [
                'message' => 'Nonce verification failed !'
            ]);
        }

        wp_send_json_error( [
            'message' => 'Something went wrong !'
        ] );
        exit;
    }
}