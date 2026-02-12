<?php
/**
 * Plugin Name: SR Projects Advanced
 * Description: Advanced Projects Manager with filters, AJAX, REST API, Gutenberg block & template override.
 * Version: 1.0
 * Plugin URI: https://github.com/satyakeeray/sr-projects-advanced
 * Author: Satyakee Ray
 * Author URI: https://www.linkedin.com/in/satyakeeray/
 */

if (!defined('ABSPATH')) exit;

define('SRPA_PATH', plugin_dir_path(__FILE__));
define('SRPA_URL', plugin_dir_url(__FILE__));

require_once SRPA_PATH . 'includes/common/cpt.php';  // Registering custom post type
require_once SRPA_PATH . 'includes/common/metabox.php'; // Registering metaboxs on custom post type
require_once SRPA_PATH . 'includes/frontend/ajax.php';  // Registering ajax handler for frontend.
require_once SRPA_PATH . 'includes/api/rest-api.php';  // Registering rest api end point.

// Only loads on admin side
if ( is_admin() ) {
    require_once SRPA_PATH . 'includes/admin/admin-menu.php'; // Adding admin menu and it's corresponding pages
    require_once SRPA_PATH . 'includes/admin/admin-scripts-and-styles.php';  // Adding style and scripts for admin
}

// Only loads for frontend side
if ( ! is_admin() ) {
    define( 'NO_IMAGE' , SRPA_URL . 'includes/frontend/images/no-image.webp' ); // Set a no image
    require_once SRPA_PATH . 'includes/frontend/styles-and-scripts.php';  // Registering shortcode from displaying post on frontend.
    require_once SRPA_PATH . 'includes/frontend/shortcode.php';  // Registering shortcode from displaying post on frontend.
    require_once SRPA_PATH . 'includes/frontend/template-loader.php'; // Loading archive and sigle templates.
}

