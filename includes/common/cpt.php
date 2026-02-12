<?php
if (!defined('ABSPATH')) exit;

if ( ! function_exists( 'sr_projects_register_post_type' ) ) {

    function sr_projects_register_post_type() {

        $labels = array(
            'name'               => 'Projects',
            'singular_name'      => 'Project',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Project',
            'edit_item'          => 'Edit Project',
            'new_item'           => 'New Project',
            'view_item'          => 'View Project',
            'search_items'       => 'Search Projects',
            'not_found'          => 'No projects found',
            'not_found_in_trash' => 'No projects found in Trash',
            'menu_name'          => 'Projects',
        );

        $args = array(
            'labels'        => $labels,
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => array( 'slug' => 'sr-project' ),
            'show_in_rest'  => true, 
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon'     => 'dashicons-portfolio',
        );

        register_post_type( 'sr_project', $args );
    }
}

add_action( 'init', 'sr_projects_register_post_type' );

