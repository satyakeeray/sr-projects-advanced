<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'srpa_register_admin_pages' );

if( !function_exists( 'srpa_register_admin_pages' ) ) {

    function srpa_register_admin_pages() {

        // Parent menu
        add_menu_page(
            'SR Projects',
            'SR Projects',
            'manage_options',
            'srpa-dashboard',
            'srpa_dashboard_page',
            'dashicons-portfolio',
            25
        );

        // Dashboard subpage (same as parent)
        add_submenu_page(
            'srpa-dashboard',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'srpa-dashboard',
            'srpa_dashboard_page'
        );

        // Settings subpage
        add_submenu_page(
            'srpa-dashboard',
            'Settings',
            'Settings',
            'manage_options',
            'srpa-settings',
            'srpa_settings_page'
        );
    }
    
}

function srpa_dashboard_page() {
   include_once  plugin_dir_path(__FILE__) . 'templates/srpa-admin-dashboard.php';
}

function srpa_settings_page() {
    include_once  plugin_dir_path(__FILE__) . 'templates/srpa-admin-settings.php';
}


// For admin settings

add_action( 'admin_init', 'srpa_register_settings' );

if( !function_exists( 'srpa_register_settings' ) ) {
    function srpa_register_settings() {
        register_setting( 'srpa_settings_group', 'srpa_settings' );
    }
}