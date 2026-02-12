<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_enqueue_scripts', 'srpa_enqueue_admin_assets' );

if( !function_exists( 'srpa_enqueue_admin_assets' ) ) {

    function srpa_enqueue_admin_assets( $hook ) {

        if ( strpos( $hook, 'srpa' ) === false ) return;

        wp_enqueue_style(
            'srpa-admin-css',
            SRPA_URL . 'includes/admin/css/srpa-admin.css',
            array(),
            filemtime( SRPA_PATH . 'includes/admin/css/srpa-admin.css' )
        );

        wp_enqueue_script(
            'srpa-admin-js',
            SRPA_URL . 'includes/admin/js/srpa-admin.js',
            array( 'jquery' ),
            filemtime( SRPA_PATH . 'includes/admin/js/srpa-admin.js' ),
            true
        );
    }
}

