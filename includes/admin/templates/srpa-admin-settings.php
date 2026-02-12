<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Get saved values
$options            = get_option( 'srpa_settings', array() );
$template_type      = $options['template_type'] ?? 'list';
$pagination_type    = $options['pagination_type'] ?? 'pagination';
$posts_per_page     = $options['posts_per_page'] ?? 6;
$load_more_count    = $options['load_more_count'] ?? 6;
$enable_filter      = $options['enable_filter'] ?? 0;
$enable_search      = $options['enable_search'] ?? 0;
?>

<div class="wrap">
    <h1>SR Projects - Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'srpa_settings_group' ); ?>
        <table class="form-table">
            <tr>
                <th colspan="2">
                    <h2>Frontend Settings</h2>
                </th>
            </tr>

            <tr>
                <th>Choose Template</th>
                <td>
                    <label>
                        <input type="radio" name="srpa_settings[template_type]" value="grid" <?php checked( $template_type, 'grid' ); ?>>
                        Grid
                    </label>
                    &nbsp;&nbsp;
                    <label>
                        <input type="radio" name="srpa_settings[template_type]" value="list" <?php checked( $template_type, 'list' ); ?>>
                        List
                    </label>
                </td>
            </tr>

            <tr>
                <th>Pagination Type</th>
                <td>
                    <label>
                        <input type="radio" name="srpa_settings[pagination_type]" value="pagination" <?php checked( $pagination_type, 'pagination' ); ?>>
                        Pagination
                    </label>
                    &nbsp;&nbsp;
                    <label>
                        <input type="radio" name="srpa_settings[pagination_type]" value="load_more" <?php checked( $pagination_type, 'load_more' ); ?>>
                        Load More
                    </label>
                </td>
            </tr>

            <!-- <tr>
                <th>Pagination Mode</th>
                <td>
                    <label>
                        <input type="radio" name="srpa_settings[pagination_mode]" value="ajax" <?php checked( $pagination_mode, 'ajax' ); ?>>
                        Ajax
                    </label>
                    &nbsp;&nbsp;
                    <label>
                        <input type="radio" name="srpa_settings[pagination_mode]" value="refresh" <?php checked( $pagination_mode, 'refresh' ); ?>>
                        Page Refresh
                    </label>
                    <p class="description">Only applies if Pagination is selected.</p>
                </td>
            </tr> -->

            <tr>
                <th>Posts Per Page</th>
                <td>
                    <input type="number" name="srpa_settings[posts_per_page]" value="<?php echo esc_attr( $posts_per_page ); ?>" min="1">
                    <p class="description">Used when Pagination is selected.</p>
                </td>
            </tr>

            <tr>
                <th>Load Items Per Click</th>
                <td>
                    <input type="number" name="srpa_settings[load_more_count]" value="<?php echo esc_attr( $load_more_count ); ?>" min="1">
                    <p class="description">Used when Load More is selected (Ajax by default).</p>
                </td>
            </tr>

            <tr>
                <th>Enable Filter</th>
                <td>
                    <label>
                        <input type="checkbox" name="srpa_settings[enable_filter]" value="1" <?php checked( $enable_filter, 1 ); ?>>
                        Enable project filters
                    </label>
                </td>
            </tr>

            <tr>
                <th>Enable Search</th>
                <td>
                    <label>
                        <input type="checkbox" name="srpa_settings[enable_search]" value="1" <?php checked( $enable_search, 1 ); ?>>
                        Enable search
                    </label>
                </td>
            </tr>

        </table>

        <?php submit_button(); ?>

    </form>
</div>
