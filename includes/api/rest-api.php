<?php
if (!defined('ABSPATH')) exit;

add_action('rest_api_init', function () {

    register_rest_route('srpa/v1', '/projects', [
        'methods' => 'GET',
        'callback' => function () {
            
            $q = new WP_Query([
                'post_type' => 'sr_project',
                'posts_per_page' => 10,
            ]);

            $data = [];

            while ($q->have_posts()) {
                $q->the_post();
                $client_name = get_post_meta( get_the_ID(), 'srpa_client_name', true );
                $status      = get_post_meta( get_the_ID(), 'srpa_project_status', true );
                $budget      = get_post_meta( get_the_ID(), 'srpa_budget', true );
                $data[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'status' => $status,
                    'budget' => $budget,
                    'client_name' => $client_name,
                ];
            }

            return $data;
        }
    ]);

});
