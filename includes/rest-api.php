<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class REST_API
{
    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_routes'));
    }
    public function register_routes()
    {
        register_rest_route('wp-react-connect/v1', '/hello', array(
            'methods' => 'GET',
            'callback' => array($this, 'hello_endpoint'),
        ));
    }

    public function hello_endpoint($request)
    {
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        $data = [
            "site_logo" => $image[0],
            "site_title" => get_bloginfo('name'),
            'frontend_url' => get_option('frontend_url'),
            "site_description" => get_bloginfo('description'),
            "backend_url" => get_bloginfo('url'),
            "site_admin_email" => get_bloginfo('admin_email'),
            "shop_phone" => get_option('shop_phone_number', ''),
            "label" => get_option('custom_textarea_label', ''),
            "site_language" => get_bloginfo('language'),
            "site_charset" => get_bloginfo('charset'),
            "site_version" => get_bloginfo('version'),
            "site_wp_version" => get_bloginfo('version'),
            "site_wp_url" => get_bloginfo('wpurl'),
            "site_wp_language" => get_bloginfo('language'),
            "site_wp_charset" => get_bloginfo('charset'),
        ];
        return new WP_REST_Response($data, 200);
    }
}