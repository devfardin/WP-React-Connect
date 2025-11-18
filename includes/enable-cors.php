<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class ENABLE_CORS
{
    public function __construct()
    {
        add_action('init', array($this, 'add_cors_headers'));
    }

    public function add_cors_headers()
    {
        // Only for REST API calls
        if (strpos($_SERVER['REQUEST_URI'], '/wp-json/') === false) {
            return;
        }
        $frontend_url = get_option('frontend_url');

        // Handle preflight OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Origin: $frontend_url ");
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Authorization, Content-Type');
            status_header(200);
            exit();
        }

        // Regular API responses
        header("Access-Control-Allow-Origin: $frontend_url");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');

    }
}