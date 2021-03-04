<?php

namespace WeDevs\Academy\Admin;

/**
 * AddressBook Handler Class
 */
class AddressBook
{

    /**
     * Errors
     * 
     * Errors will be stored here by key
     * 
     * @var array
     */
    public $errors = [];

    /**
     * Plugin Page
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address-view.php';
                break;

            default:
                $template = __DIR__ . '/views/address-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        } else {
            echo "Template not found";
        }
    }

    /**
     * Form Handler
     * 
     * Handle Forms data
     *
     * @return void
     */
    public function form_handler()
    {
        if ( !isset($_POST['submit_address']) ) {
            return;
        }

        if ( ! wp_verify_nonce($_POST['_wpnonce'], 'new-address') ) {
            wp_die('Invalid & trying to attack csrf !!');
        }

        if ( ! current_user_can('manage_options') ) {
            wp_die('Are you cheating ??');
        }

        $name       = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $address    = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
        $phone      = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
        
        if ( empty( $name ) ) {
            $this->errors['name'] = __( 'Please provide a name', 'wedevs-academy' );
        }

        if ( empty( $phone ) ) {
            $this->errors['phone'] = __( 'Please provide a phone number', 'wedevs-academy' );
        }

        if ( ! empty( $this->errors ) ) {
            return;
        }

        $insert_id = wd_ac_insert_address( [
            'name'  => $name,
            'address'  => $address,
            'phone'  => $phone,
        ] );

        if( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_messages() );
        }

        $redirected_to = admin_url( 'admin.php?page=wedevs-academy-address-book&inserted=true' );
        wp_redirect($redirected_to);
        exit;
    }
}
