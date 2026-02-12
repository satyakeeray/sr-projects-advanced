<?php
if (!defined('ABSPATH')) exit;

add_action( 'wp_enqueue_scripts', 'srpa_frontend_assets' );

if( !function_exists( 'srpa_frontend_assets' ) ) {

    function srpa_frontend_assets() {

        wp_enqueue_script(
            'srpa-frontend',
            SRPA_URL . 'includes/frontend/js/srpa-frontend.js',
            array( 'jquery' ),
            filemtime( SRPA_PATH . 'includes/frontend/js/srpa-frontend.js' ),
            true
        );

        wp_enqueue_style(
            'srpa-frontend-css',
            SRPA_URL . 'includes/frontend/css/srpa-frontend.css',
            array(),
            filemtime( SRPA_PATH . 'includes/frontend/css/srpa-frontend.css' )
        );

        wp_localize_script( 'srpa-frontend', 'srpa_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'srpa_ajax_nonce' ),
        ));
    }

}
