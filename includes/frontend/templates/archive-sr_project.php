<?php 

get_header(); 

$options            = get_option( 'srpa_settings', array() );
$template_type      = $options['template_type'] ?? 'list';
$pagination_type    = $options['pagination_type'] ?? 'pagination';
$posts_per_page     = $options['posts_per_page'] ?? 6;
$load_more_count    = $options['load_more_count'] ?? 6;
$enable_filter      = $options['enable_filter'] ?? 0;
$enable_search      = $options['enable_search'] ?? 0;
?>

<div id="srpa-projects-wrap">
    <?php 
        echo do_shortcode( sprintf(
            '[srpa_projects template_type="%s" pagination_type="%s" posts_per_page="%d" load_more_count="%d" enable_filter="%d" enable_search="%d"]',
            esc_attr( $template_type ),
            esc_attr( $pagination_type ),
            intval( $posts_per_page ),
            intval( $load_more_count ),
            intval( $enable_filter ),
            intval( $enable_search )
        ) );
    ?>
</div>

<?php get_footer(); ?>
