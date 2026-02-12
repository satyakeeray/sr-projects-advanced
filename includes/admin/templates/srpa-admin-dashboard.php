<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Get saved settings
$options            = get_option( 'srpa_settings', array() );
$template_type      = $options['template_type'] ?? 'list';
$pagination_type    = $options['pagination_type'] ?? 'pagination';
$posts_per_page     = $options['posts_per_page'] ?? 6;
$load_more_count    = $options['load_more_count'] ?? 6;
$enable_filter      = ! empty( $options['enable_filter'] ) ? 1 : 0;
$enable_search      = ! empty( $options['enable_search'] ) ? 1 : 0;

/*
|------------------------------------
| Generate Shortcode Dynamically
|------------------------------------
*/

$shortcode = '[srpa_projects';

$shortcode .= ' template_type="' . esc_attr( $template_type ) . '"';
$shortcode .= ' pagination_type="' . esc_attr( $pagination_type ) . '"';
$shortcode .= ' posts_per_page="' . esc_attr( $posts_per_page ) . '"';
$shortcode .= ' load_more_count="' . esc_attr( $load_more_count ) . '"';
$shortcode .= ' enable_filter="' . esc_attr( $enable_filter ) . '"';
$shortcode .= ' enable_search="' . esc_attr( $enable_search ) . '"';

$shortcode .= ']';
?>

<div class="wrap srpa-dashboard">

    <div class="srpa-hero">
        <h1>SR Projects Advanced</h1>
        <p class="version">Version 1.0.0</p>
    </div>

    <div class="srpa-container">

        <h2>Shortcode Usage</h2>
        <p>
            Use the following shortcode to display Projects on any page or post.
        </p>

        <div class="srpa-shortcode-box" style="background:#fff;padding:15px;border:1px solid #ddd;margin:15px 0;">
            <code style="font-size:16px;"><?php echo esc_html( $shortcode ); ?></code>
        </div>

        <p>
            This shortcode is automatically generated based on your current settings.
            If you update settings, this shortcode will update accordingly.
        </p>

        <hr>

        <h2>How It Works</h2>

        <ul style="list-style:disc;margin-left:20px;">
            <li><strong>template_type</strong> — Controls layout ( grid | list ).</li>
            <li><strong>pagination_type</strong> — Normal pagination or AJAX Load More. ( pagination | load_more )</li>
            <li><strong>posts_per_page</strong> — Number of projects per page (Pagination mode). ( Any integer greater than 0 )</li>
            <li><strong>load_more_count</strong> — Items loaded per click (Load More mode). ( Any integer greater than 0 )</li>
            <li><strong>enable_filter</strong> — Enables project status filter dropdown. ( 0 | 1 )</li>
            <li><strong>enable_search</strong> — Enables project search field. ( 0 | 1 )</li>
        </ul>

        <hr>

        <h2>Manual Customization Example</h2>

        <p>You can override settings manually like this:</p>
        <div class="code">
             <code>
                [srpa_projects]
            </code>
        </div>
        <div class="code">
            <code>
                [srpa_projects template_type="list" pagination_type="pagination" posts_per_page="9"]
            </code>
        </div>
        <div class="code">
            <code>
                [srpa_projects template_type="list" pagination_type="pagination" posts_per_page="9" enable_filter="1" enable_search="1"]
            </code>
        </div>
        <div class="code">
            <code>
                [srpa_projects template_type="grid" pagination_type="load_more" posts_per_page="9" enable_filter="1" enable_search="1"]
            </code>
        </div>
    </div>
    
    <?php
    $post_type_obj   = get_post_type_object( 'sr_project' );
    $archive_link    = get_post_type_archive_link( 'sr_project' );
    $slug            = $post_type_obj->rewrite['slug'] ?? 'sr-project';
    $single_example  = home_url( '/' . $slug . '/sample-project/' );
    $theme_name = get_stylesheet();
    ?>

    <div class="srpa-container">

        <h2>Frontend Archive & Template Override</h2>

        <h3>Archive Page URL</h3>

        <p>
            The Projects custom post type archive is available at:
        </p>

        <div class="srpa-shortcode-box">
            <code><?php echo esc_url( $archive_link ); ?></code>
        </div>

        <p>
            Archive slug is dynamically registered as:
            <strong><?php echo esc_html( $slug ); ?></strong>
            (Defined in: <code>includes/common/cpt.php</code>)
        </p>

        <hr>

        <h3>Single Project URL Structure</h3>

        <div class="srpa-shortcode-box">
            <code><?php echo esc_url( $single_example ); ?></code>
        </div>

        <hr>

        <h3>How Template Override Works</h3>

        <p>
            The plugin loads templates using <code>template_include</code> filter
            inside:
        </p>

        <code>includes/frontend/template-loader.php</code>

        <h4>To Override Archive Template:</h4>

        <p>Create this file in your theme:</p>

        <div class="srpa-shortcode-box">
            <code>wp-content/themes/<?php echo $theme_name; ?>/sr-project/archive-sr_project.php</code>
        </div>

        <h4>To Override Single Template:</h4>

        <div class="srpa-shortcode-box">
            <code>wp-content/themes/<?php echo $theme_name; ?>/sr-project/single-sr_project.php</code>
        </div>

        <p>
            The plugin first checks inside the <strong>sr-project</strong> folder in your theme.
            If not found, it loads default templates from:
        </p>

        <div class="srpa-shortcode-box">
            <code><?php echo esc_html( SRPA_PATH . 'includes/frontend/templates/' ); ?></code>
        </div>

    </div>

    <?php
    $rest_url = rest_url( 'srpa/v1/projects' );
    ?>

    <div class="srpa-container">

        <h2>REST API Endpoints</h2>

        <p>
            The plugin registers a custom REST API endpoint under namespace:
            <strong>srpa/v1</strong>
        </p>

        <h3>Get All Projects</h3>

        <div class="srpa-shortcode-box">
            <code><?php echo esc_url( $rest_url ); ?></code>
        </div>

        <p>
            Method: <strong>GET</strong>
        </p>

        <hr>

        <h3>Returned Fields</h3>

        <ul style="list-style:disc;margin-left:20px;">
            <li>id</li>
            <li>title</li>
            <li>status (meta: srpa_project_status)</li>
            <li>budget (meta: srpa_budget)</li>
            <li>client_name (meta: srpa_client_name)</li>
        </ul>

        <hr>

        <h3>Example JavaScript Usage</h3>

        <pre style="background:#f6f7f7;padding:10px;border-radius:4px;">
        fetch('<?php echo esc_url( $rest_url ); ?>')
        .then(res => res.json())
        .then(data => console.log(data));
        </pre>

        <p>
            Defined in:
            <code>includes/api/rest-api.php</code>
        </p>

    </div>

</div>

