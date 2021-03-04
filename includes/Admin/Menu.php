<?php

namespace WeDevs\Academy\Admin;

/**
 * Menu Handler Class
 */
class Menu
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Initialize admin menu
     * 
     * Add an menu in the sidebar
     *
     * @return void
     */
    public function admin_menu()
    {
        add_menu_page( __('weDevs Academy', 'wedevs-academy'), __( 'Academy', 'wedevs-academy' ), 'manage_options', 'wedevs-academy', [$this, 'plugin_page'], 'dashicons-admin-home');
    }

    /**
     * Plugin Page
     *
     * @return void
     */
    public function plugin_page()
    {
        echo "Hello";
    }
}
