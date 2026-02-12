<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* Register metaboxes for the post type 'sr_project' */

add_action( 'add_meta_boxes', 'srpa_add_project_meta_box' );

if( !function_exists( 'srpa_add_project_meta_box' ) ) {
    function srpa_add_project_meta_box() {
        add_meta_box(
            'srpa_project_meta',
            'SR Project Details',
            'srpa_render_project_meta',
            'sr_project',
            'normal',
            'high'
        );
    }
}


/* Render metaboxes for poject details page on amdin section */
function srpa_render_project_meta( $post ) {

    wp_nonce_field( 'srpa_project_meta_nonce_action', 'srpa_project_meta_nonce' );

    $client_name   = get_post_meta( $post->ID, 'srpa_client_name', true );
    $status        = get_post_meta( $post->ID, 'srpa_project_status', true );
    $budget        = get_post_meta( $post->ID, 'srpa_budget', true );
    ?>

    <p>
        <label><strong>Client Name</strong></label><br>
        <input type="text" name="srpa_client_name" value="<?php echo esc_attr( $client_name ); ?>" style="width:100%;">
    </p>

    <p>
        <label><strong>Status</strong></label><br>
        <select name="srpa_project_status" style="width:100%;">
            <option value="">Select Status</option>
            <option value="active" <?php selected( $status, 'active' ); ?>>Active</option>
            <option value="completed" <?php selected( $status, 'completed' ); ?>>Completed</option>
        </select>
    </p>

    <p>
        <label><strong>Budget</strong></label><br>
        <input type="number" name="srpa_budget" value="<?php echo esc_attr( $budget ); ?>" min="0" step="1">
    </p>

    <?php
}

/* Save Meta Box Data */
add_action( 'save_post_sr_project', 'srpa_save_project_meta' );
function srpa_save_project_meta( $post_id ) {

    // Checking the nounce exists or not
    if ( ! isset( $_POST['srpa_project_meta_nonce'] ) ) return;
    
    // Verifiying nounce while saving the request
    if ( ! wp_verify_nonce( $_POST['srpa_project_meta_nonce'], 'srpa_project_meta_nonce_action' ) ) return;

    // Preventing autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // User cappablities checking
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Save meta box fields data
    
    if ( isset( $_POST['srpa_client_name'] ) ) {
        update_post_meta( $post_id, 'srpa_client_name', sanitize_text_field( $_POST['srpa_client_name'] ) );
    }

    if ( isset( $_POST['srpa_project_status'] ) ) {
        update_post_meta( $post_id, 'srpa_project_status', sanitize_text_field( $_POST['srpa_project_status'] ) );
    }

    if ( isset( $_POST['srpa_budget'] ) ) {
        update_post_meta( $post_id, 'srpa_budget', intval( $_POST['srpa_budget'] ) );
    }
}
