<?php

namespace WeDevs\Academy;

use WeDevs\Academy\Admin\AddressBook;

/**
 * Ajax handler class
 */
class Ajax {

    public $addressBook;

    function __construct() {
        add_action( 'wp_ajax_wd_ac_academy_contact', [ $this, 'submit_contact' ] );
        add_action( 'wp_ajax_nopriv_wd_ac_academy_contact', [ $this, 'submit_contact' ] );
        add_action( 'wp_ajax_wd-ac-delete-address', [ $this, 'delete_address' ] );

        $this->addressBook = new AddressBook();
    }

    /**
     * Submit Contact Form Via Ajax
     *
     * @return void
     */
    public function submit_contact() {
        if ( ! wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'wd-ac-contact-form' ) ) {
            wp_send_json_error( [
                'message' => 'Nonce verification failed !'
            ]);
        }
        
        wp_send_json_success( [
            'message' => 'OK !'
        ] );
        exit;

        wp_send_json_error( [
            'message' => 'Something went wrong !'
        ] );
    }

    public function delete_address() {
        $response = $this->addressBook->delete_address();
        return $response;
        wp_send_json_success();
    }
}