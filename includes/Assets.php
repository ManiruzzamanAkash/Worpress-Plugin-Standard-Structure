<?php

namespace WeDevs\Academy;

/**
 * Assets Class for handling assets
 */
class Assets
{
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets'] );
    }

    public function get_scripts() {
        return [
            'academy-script' => [
                'src' => WD_ACADEMY_ASSETS . '/js/frontend.js',
                'version' => filemtime(WD_ACADEMY_PATH . '/assets/js/frontend.js' ),
                'is_footer' => true
            ]
        ];
    }

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
            ]
        ];
    }

    public function enqueue_assets () {
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
    }
}
