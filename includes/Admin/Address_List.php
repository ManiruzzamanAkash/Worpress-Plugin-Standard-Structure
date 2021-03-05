<?php

namespace WeDevs\Academy\Admin;

if ( ! class_exists( 'WP_List_Table') ) {
    require_once ABSPATH . 'wp-admin/includes/class-up-list-table.php';
}

class Address_List extends \WP_List_Table {
    
    function __construct() {
        parent::__construct( [
            'plural'   => 'contacts',
            'singular' => 'contact',
            'ajax'     => false,
        ] );
    }

    public function get_columns() {
        return [
            'cb' => '<input type="checkbox" />',
            'name' => __( 'Name', 'wedevs-academy' ),
            'address' => __( 'Address', 'wedevs-academy' ),
            'phone' => __( 'Phone No', 'wedevs-academy' ),
            'created_at' => __( 'Date', 'wedevs-academy' ),
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'name'       => [ 'name', true ],
            'created_at' => [ 'created_at', true ],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'wedevs-academy' ),
        );

        return $actions;
    }

    protected function column_default( $item, $column_name ) {
        
        switch ( $column_name ) {
            case 'value':
                # code...
                break;
            
            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
                break;
        }
    }

    /**
     * Render the "name" column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_name( $item ) {
        $actions = [];

        $actions['edit']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=wedevs-academy-address-book&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'wedevs-academy' ), __( 'Edit', 'wedevs-academy' ) );
        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=wd-ac-delete-address&id=' . $item->id ), 'wd-ac-delete-address' ), $item->id, __( 'Delete', 'wedevs-academy' ), __( 'Delete', 'wedevs-academy' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=wedevs-academy-address-book&action=view&id' . $item->id ), $item->name, $this->row_actions( $actions )
        );
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }

    public function prepare_items()
    {
        $columns    = $this->get_columns();
        $hidden     = [];
        $sortable   = $this->get_sortable_columns();
        
        $this->_column_headers = [ $columns, $hidden, $sortable ];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        $this->items = wd_ac_get_addresses( $args );

        $this->set_pagination_args( [
            'total_items' => wd_ac_get_addresses_count(),
            'per_page' => $per_page
        ] );

    }

}
