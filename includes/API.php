<?php

namespace WeDevs\Academy;

/**
 * API Class
 */
class API { 
    
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_api' ] );
    }

    public function register_api () {
        $addressBook = new API\AddressBook();
        
        $addressBook->register_routes();
    }
}