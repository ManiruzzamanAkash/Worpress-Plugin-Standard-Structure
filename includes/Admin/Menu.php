<?php

namespace WeDevs\Academy\Admin;

/**
 * Menu Handler Class
 */
class Menu
{
    public $addressBook;

    function __construct(AddressBook $addressBook)
    {
        $this->addressBook = $addressBook;

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
        $parent_slug = 'wedevs-academy-address-book';
        $capability = 'manage_options';

        add_menu_page(__('weDevs Academy', 'wedevs-academy'), __('Academy', 'wedevs-academy'), $capability, $parent_slug, [$this->addressBook, 'plugin_page'], 'dashicons-admin-home');
        add_submenu_page($parent_slug, __('Address Book', 'wedevs-academy'), __('Address Book', 'wedevs-academy'), $capability, 'wedevs-academy-address-book', [$this->addressBook, 'plugin_page']);
        add_submenu_page($parent_slug, __('Settings', 'wedevs-academy'), __('Settings', 'wedevs-academy'), $capability, 'wedevs-academy-settings', [$this, 'address_book_settings_page']);
    }

    /**
     * Address book page
     *
     * @return void
     */
    public function address_book_page()
    {
        // $addressBook = new AddressBook();
        $this->addressBook->plugin_page();
    }

    /**
     * Settings Page
     *
     * @return void
     */
    public function address_book_settings_page()
    {
        echo "Welcom to Settings Page";
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
