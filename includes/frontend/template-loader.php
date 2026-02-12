<?php
if ( ! defined( 'ABSPATH' ) ) exit;


add_filter( 'template_include', 'srpa_load_project_templates' );

function srpa_load_project_templates( $template ) {

    if ( is_post_type_archive( 'sr_project' ) ) {

        $theme_template = locate_template( 'sr-project/archive-sr_project.php' );

        if ( $theme_template ) {
            return $theme_template;
        }

        return SRPA_PATH . 'includes/frontend/templates/archive-sr_project.php';
    }

    if ( is_singular( 'sr_project' ) ) {

        $theme_template = locate_template( 'sr-project/single-sr_project.php' );

        if ( $theme_template ) {
            return $theme_template;
        }

        return SRPA_PATH . 'includes/frontend/templates/single-sr_project.php';
    }

    return $template;
}
