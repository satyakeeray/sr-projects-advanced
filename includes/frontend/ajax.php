<?php
if (!defined('ABSPATH')) exit;

add_action( 'wp_ajax_srpa_load_projects', 'srpa_load_projects_ajax' );
add_action( 'wp_ajax_nopriv_srpa_load_projects', 'srpa_load_projects_ajax' );

function srpa_load_projects_ajax() {
    
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'srpa_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
    }

    // Sanitize inputs
    $page            = isset( $_POST['page'] ) ? max( 1, intval( $_POST['page'] ) ) : 1;
    $template_type   = isset( $_POST['template_type'] ) ? sanitize_text_field( $_POST['template_type'] ) : 'list';
    $pagination_type = isset( $_POST['pagination_type'] ) ? sanitize_text_field( $_POST['pagination_type'] ) : 'pagination';
    $ppp             = isset( $_POST['ppp'] ) ? intval( $_POST['ppp'] ) : 6;
    $keyword         = sanitize_text_field( $_POST['keyword'] ?? '' );
    $filter          = isset( $_POST['filter'] ) ? sanitize_text_field( $_POST['filter'] ) : '';
    
    // Safety: allow only known templates
    $allowed_templates = array( 'list', 'grid' );
    if ( ! in_array( $template_type, $allowed_templates, true ) ) {
        $template_type = 'list';
    }

    // Query projects
    $args = array(
        'post_type'      => 'sr_project',
        'post_status'    => 'publish',
        'posts_per_page' => $ppp,
        'paged'          => $page,
    );
    if ( ! empty( $keyword ) ) {
        $args['s'] = sanitize_text_field( $keyword );
    }
    $meta_query = [];
    if ( ! empty( $filter ) ) {
        $meta_query[] = array(
            'key'     => 'srpa_project_status',
            'value'   => $filter,
            'compare' => '=',
        );
    }
    if ( ! empty( $meta_query ) ) {
        $args['meta_query'] = $meta_query;
    }
    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $template_file = SRPA_PATH . 'includes/frontend/templates/' . $template_type . '.php';
            if ( file_exists( $template_file ) ) {
                include $template_file;
            } else {
                echo '<p>Template not found.</p>';
            }
        }
    } else {
        echo '<p>No projects found  </p>';
    }

    wp_reset_postdata();

    $html = ob_get_clean();

    // Render pagination HTML
    ob_start();
    echo paginate_links( array(
        'total'   => $query->max_num_pages,
        'current' => $page,
        'type'    => 'list',
    ) );
    $pagination_html = ob_get_clean();

    wp_send_json_success( array(
        'html'       => $html,
        'pagination_html' => $pagination_html,
        'max_pages'  => $query->max_num_pages,
        'found'      => $query->found_posts,
        'page'       => ( $query->max_num_pages == 0 ) ? 0 : $page,
    ) );
}