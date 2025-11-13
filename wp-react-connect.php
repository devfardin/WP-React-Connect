<?php
/**
 * Plugin Name: WP React Connect
 * Plugin URI: https://fardin-ahmed.netlify.app/
 * Description: A lightweight WordPress plugin to connect React frontends with WordPress and WooCommerce through REST API, providing secure endpoints and better integration support.
 * Version: 1.0.0
 * Author: Fardin Ahmed
 * Author URI: https://github.com/devfardin
 * License: GPL2
 */

if(!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if(!defined('WP_REACT_CONNECTOR_VERSION')) {
    define('WP_REACT_CONNECTOR_VERSION', '1.0.0');
}
if(!defined('WP_REACT_CONNECTOR_PLUGIN_PATH')) {
    define('WP_REACT_CONNECTOR_PLUGIN_PATH', plugin_dir_path(__FILE__));
}
if(!defined('WP_REACT_CONNECTOR_PLUGIN_URL')) {
    define('WP_REACT_CONNECTOR_PLUGIN_URL', plugin_dir_url(__FILE__));
}

class WP_REACT_CONNECTOR {
    public function __construct() {
        $this->loadDepandancy();
        $this->init();
    }

    // Loade all depandancy files
    public function loadDepandancy() {
        require_once WP_REACT_CONNECTOR_PLUGIN_PATH . 'includes/woocommerce-checkout.php';
    }
    
    public function init() {
        // Initialization code here
        new WOOCOMMERCE_CHECKOUT();
    }
}
new WP_REACT_CONNECTOR();