<?php

/**
 * Insert New Address
 *
 * @param array $args
 * @return void
 */
function wd_ac_insert_address( $args = [] ) { 
    global $wpdb;

    if ( empty( $args['name']) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name', 'wedevs_academy' ));
    }

    $defaults = [
        'name'              => '',
        'address'           => '',
        'phone'             => '',
        'created_at'        => current_time( 'mysql' ),
        'created_by'        => get_current_user_id(),
    ];

    $data = wp_parse_args( $args, $defaults );

    if ( isset( $data[ 'id' ] ) ) {

        $id = $data [ 'id' ];
        unset( $data[ 'id' ] );

        $updated = $wpdb->update(
            "{$wpdb->prefix}ac_addresses",
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d'
            ],
            [ '%d' ]
        );

        if ( ! $updated ) {
            return new \WP_Error( 'failed-to-update' , __( 'Failed to update data', 'wedevs_academy' ) );
        }

        return $updated;
    }else {

        $inserted = $wpdb->insert(
            "{$wpdb->prefix}ac_addresses",
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d'
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert' , __( 'Failed to insert data', 'wedevs_academy' ) );
        }

        return $inserted;
    }
}

/**
 * Get Addresses List By Paginate and Sorting
 *
 * @param array $args
 * @return void
 */
function wd_ac_get_addresses( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'    => 20,
        'offset'    => 0,
        'orderby'   => 'id',
        'order'     => 'ASC',
    ];

    $args = wp_parse_args( $args,  $defaults );

    $items = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}ac_addresses
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number'] 
        ) );
    return $items;
}

/**
 * Count Total Addresses
 * 
 * @return int Total address number
 */
function wd_ac_get_addresses_count ( ) {
    global $wpdb;

    return (int) $wpdb->get_var( 
        "SELECT COUNT(id) as total_addresses FROM {$wpdb->prefix}ac_addresses"
    );
}

/**
 * Get Single Address Information
 * 
 * @param int $id
 * 
 * @return Object Single Address Object
 */
function wd_ac_get_address ( $id ) {
    global $wpdb;

    return $wpdb->get_row( 
        $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ac_addresses WHERE id = %d LIMIT 1", $id )
    );
}

/**
 * Delete Address
 *
 * @param int $id
 * 
 * @return Object deleted result
 */
function wd_ac_delete_address ( $id ) {
    global $wpdb;

    return (int) $wpdb->delete(
        $wpdb->prefix .'ac_addresses',
         [ 'id' => $id ],
         [ '%d' ]
    );
}
