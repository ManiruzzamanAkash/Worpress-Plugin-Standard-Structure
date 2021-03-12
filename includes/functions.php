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

        wd_ac_address_purge_cache( $id );

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

        wd_ac_address_purge_cache( null );

        return $inserted;
    }
}

/**
 * Get Addresses List By Paginate and Sorting
 *
 * @param array $args
 * 
 * @return array
 */
function wd_ac_get_addresses( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'    => 20,
        'offset'    => 0,
        'orderby'   => 'id',
        'order'     => 'ASC',
    ];

    $args = wp_parse_args( $args, $defaults );

    $last_changed = wp_cache_get_last_changed( 'wedevs-address' );
    $key          = md5( serialize( array_diff_assoc( $args, $defaults ) ) );
    $cache_key    = "all:$key:$last_changed";

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}ac_addresses
        ORDER BY {$args['orderby']} {$args['order']}
        LIMIT %d, %d",
        $args['offset'], $args['number'] 
    );

    $items = wp_cache_get( $cache_key, 'wedevs-address' );

    if ( false === $items ) {
        $items = $wpdb->get_results( $sql );

        wp_cache_set( $cache_key, $items, 'wedevs-address' );
    }

    return $items;
}

/**
 * Count Total Addresses
 * 
 * @return int Total address number
 */
function wd_ac_get_addresses_count ( ) {
    global $wpdb;

    $count = wp_cache_get( 'address-count', 'wedevs-address' );

    if ( false === $count ) {
        $count = (int) $wpdb->get_var( 
            "SELECT COUNT(id) as total_addresses FROM {$wpdb->prefix}ac_addresses"
        );

        wp_cache_set( 'address-count', $count, 'wedevs-address' );
    }
    return $count;
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

    $address = wp_cache_get( 'address-'.$id, 'wedevs-address' );
    
    if ( false === $address ) {
        $address = $wpdb->get_row( 
            $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ac_addresses WHERE id = %d LIMIT 1", $id )
        );

        wp_cache_set( 'address-'.$id, $address, 'wedevs-address' );
    }

    return $address;
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

    wd_ac_address_purge_cache( $id );
}

/**
 * Purge the cache for books
 *
 * @param  int $book_id
 *
 * @return void
 */
function wd_ac_address_purge_cache( $book_id = null ) {
    $group = 'wedevs-address';

    if ( $book_id ) {
        wp_cache_delete( 'address-' . $book_id, $group );
    }

    wp_cache_delete( 'address-count', $group );
    wp_cache_set( 'last_changed', microtime(), $group );
}
