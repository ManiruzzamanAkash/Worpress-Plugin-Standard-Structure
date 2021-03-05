<?php

namespace WeDevs\Academy\Admin;

use WeDevs\Academy\Traits\Form_Error;

/**
 * AddressBook Handler Class
 */
class AddressBook
{

    /**
     * Implementing form error trait
     */
    use Form_Error;

    /**
     * Plugin Page
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id     = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $address = wd_ac_get_address( $id );
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

        $id         = isset( $_POST['id'] ) ? sanitize_text_field( $_POST['id'] ) : 0;
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

        $args = [
            'name'  => $name,
            'address'  => $address,
            'phone'  => $phone,
        ];

        if ( $id ) {
            $args [ 'id' ] = $id;
        }

        $insert_id = wd_ac_insert_address( $args );

        if( is_wp_error( $insert_id ) ) {
            wp_die( $insert_id->get_error_messages() );
        }

        if ( $id ) {
            $redirected_to = admin_url( 'admin.php?page=wedevs-academy-address-book&action=edit&updated=true&id='. $id );
        } else {
            $redirected_to = admin_url( 'admin.php?page=wedevs-academy-address-book&inserted=true' );
        }

        wp_redirect($redirected_to);
        exit;
    }

    /**
     * Delete Address
     *
     * @return void Redirects to address list page
     */
    public function delete_address()
    {
        
        if ( ! wp_verify_nonce($_REQUEST['_wpnonce'], 'wd-ac-delete-address') ) {
            wp_die('Invalid & trying to attack csrf !!');
        }

        if ( ! current_user_can('manage_options') ) {
            wp_die('Are you cheating ??');
        }

        $id = isset( $_REQUEST['id'] ) ? sanitize_text_field( $_REQUEST['id'] ) : 0;
        
        if ( wd_ac_delete_address ( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=wedevs-academy-address-book&address-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=wedevs-academy-address-book&address-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }
}
