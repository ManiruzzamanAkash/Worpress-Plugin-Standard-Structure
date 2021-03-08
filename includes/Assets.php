<?php

namespace WeDevs\Academy;

/**
 * Assets Class for handling assets
 */
class Assets
{
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets'] );
    }

    /**
     * Get Scripts
     *
     * @return array scripts array
     */
    public function get_scripts() {
        return [
            'academy-script' => [
                'src'           => WD_ACADEMY_ASSETS . '/js/frontend.js',
                'version'       => filemtime(WD_ACADEMY_PATH . '/assets/js/frontend.js' ),
                'is_footer'     => true
            ],
            'academy-contact-script' => [
                'src'           => WD_ACADEMY_ASSETS . '/js/contact.js',
                'version'       => filemtime(WD_ACADEMY_PATH . '/assets/js/contact.js' ),
                'is_footer'     => true
            ],
            'academy-admin-script' => [
                'src'           => WD_ACADEMY_ASSETS . '/js/admin.js',
                'version'       => filemtime(WD_ACADEMY_PATH . '/assets/js/contact.js' ),
                'is_footer'     => true,
                'deps'          => [ 'jquery', 'wp-util' ]
            ]
        ];
    }

    /**
     * Get Styles
     *
     * @return array Styles as array
     */
    public function get_styles() {
        return [
            'academy-style' => [
                'src' => WD_ACADEMY_ASSETS . '/css/frontend.css',
                'version' => filemtime(WD_ACADEMY_PATH . '/assets/css/frontend.css' ),
                'is_footer' => false
            ],
            'academy-admin-style' => [
                'src' => WD_ACADEMY_ASSETS . '/css/admin.css',
                'version' => filemtime(WD_ACADEMY_PATH . '/assets/css/admin.css' ),
                'is_footer' => false
            ],
            'academy-contact-style' => [
                'src' => WD_ACADEMY_ASSETS . '/css/contact.css',
                'version' => filemtime(WD_ACADEMY_PATH . '/assets/css/contact.css' ),
                'is_footer' => false
            ]
        ];
    }

    /**
     * Register Assets
     * 
     * Register all of the assets
     *
     * @return void
     */
    public function register_assets () {
        $scripts = $this->get_scripts();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script[ 'deps' ]) ? $script[ 'deps' ] : false;

            wp_register_script( $handle, $script[ 'src' ], $deps, $script[ 'version' ], $script[ 'is_footer' ] );
        }
       
        $styles = $this->get_styles();

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style[ 'deps' ]) ? $style[ 'deps' ] : false;

            wp_register_style( $handle, $style[ 'src' ], $deps, $style[ 'version' ], $style[ 'is_footer' ] );
        }

        wp_localize_script( 'academy-contact-script', 'weDevsAcademy', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error' => __( 'Something went wrong !!', 'wedevs-academy' )
        ] );

        wp_localize_script( 'academy-admin-script', 'weDevsAcademy', [
            'nonce'     => wp_create_nonce( 'wd_ac-admin-nonce' ),
            'confirm'   => __( 'Are you sure to delete ?', 'wedevs-academy' ),
            'error'     => __( 'Something went wrong !!', 'wedevs-academy' )
        ] );
    }
}
