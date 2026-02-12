<?php
if (!defined('ABSPATH')) exit;

add_shortcode( 'srpa_projects', 'srpa_projects_shortcode' );

if( ! function_exists( 'srpa_projects_shortcode' ) ) {
    function srpa_projects_shortcode( $atts ) {
        
        $atts = shortcode_atts( array(
            'template_type'     => 'list',
            'pagination_type'   => 'pagination',
            'posts_per_page'    => 6,
            'load_more_count'   => 6,
            'enable_filter'     => 0,
            'enable_search'     => 0,
        ), $atts, 'srpa_projects' );

        $template_type   = ! empty( $atts['template_type'] )   ? $atts['template_type']   : 'list';
        $pagination_type = ! empty( $atts['pagination_type'] ) ? $atts['pagination_type'] : 'pagination';
        $posts_per_page  = ! empty( $atts['posts_per_page'] )  ? (int) $atts['posts_per_page']  : 10;
        $load_more_count = ! empty( $atts['load_more_count'] ) ? (int) $atts['load_more_count'] : 10;
        $enable_filter   = ! empty( $atts['enable_filter'] )   ? (int) $atts['enable_filter']   : 0;
        $enable_search   = ! empty( $atts['enable_search'] )   ? (int) $atts['enable_search']   : 0;

        $ppp = ( $pagination_type === 'load_more' ) ? $load_more_count : $posts_per_page;
        
        $args = array(
            'post_type'      => 'sr_project',
            'post_status'    => 'publish',
            'posts_per_page' => $ppp,
            'paged'          => 1,
        );

        $query = new WP_Query( $args );
        $instance_id = 'srpa-' . wp_generate_uuid4();
        ob_start();
        ?>
        <div id="<?php echo $instance_id; ?>" class="srpa-projects-wrap srpa-<?php echo esc_attr( $template_type ); ?>"
            data-template="<?php echo esc_attr( $template_type ); ?>"
            data-pagination="<?php echo esc_attr( $pagination_type ); ?>"
            data-ppp="<?php echo esc_attr( $ppp ); ?>">
            <h1>Projects Listing</h1>
            <?php 
            if( $enable_search == 1 ) {
                ?>
                <div class="projet-search project-search-<?php echo $instance_id; ?>">
                    <label for="srpa-keyword-<?php echo $instance_id; ?>">Search Project</label>
                    <input type="text" class="srpa-keyword" id="srpa-keyword-<?php echo $instance_id; ?>">
                </div>
                <?php
            }
            if( $enable_filter == 1 ) {
                ?>
                <div class="projet-filter project-filter-<?php echo $instance_id; ?>">
                    <label for="srpa-filter-status-<?php echo $instance_id; ?>">Filter Status</label>
                    <select class="srpa-filter" id="srpa-filter-status-<?php echo $instance_id; ?>">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <?php
            }
            ?>
           
            <div class="srpa-projects-listing">
                <?php
                if( $query->have_posts() ) {
                    while ( $query->have_posts() ) : $query->the_post();
                        if ( $template_type === 'grid' ) {
                            include SRPA_PATH . 'includes/frontend/templates/grid.php';
                        } else {
                            include SRPA_PATH . 'includes/frontend/templates/list.php';
                        }
                    endwhile;

                    
                    
                } else {
                    echo '<p>No projects found.</p>';
                }
                wp_reset_postdata();
                ?>
            </div>
            <?php 
            if ( $pagination_type === 'load_more' ) {
                echo '<button class="srpa-load-btn load-more-btn" data-page="1">Load More</button>';
            } else {
                echo '<div class="srpa-pagination">';
                    echo paginate_links( array(
                        'total' => $query->max_num_pages,
                        'current' => 1,
                        'type' => 'list',
                    ) );
                echo '</div>';
            }
            ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
