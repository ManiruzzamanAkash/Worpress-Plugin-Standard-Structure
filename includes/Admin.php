<?php

namespace WeDevs\Academy;

use WeDevs\Academy\Admin\AddressBook;

/**
 * Admin Class
 */
class Admin
{

    function __construct()
    {
        $addressBook = new AddressBook();

        $this->dispatch_action($addressBook);
        
        new Admin\Menu($addressBook);
    }

    public function dispatch_action($addressBook)
    {
        add_action( 'admin_init', [ $addressBook, 'form_handler' ] );
        add_action( 'admin_post_wd-ac-delete-address', [ $addressBook, 'delete_address' ] );
    }
}
