<?php 

if(!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class  WOOCOMMERCE_CHECKOUT {
    public function __construct() {
        // Initialization code here
        // woocommerce billing fields
        add_filter('woocommerce_billing_fields', [$this, 'custom_billing_fields']);
    }
    public function custom_billing_fields($fields) {
        // Remove the 'billing_email' field
        unset($fields['billing_email']);
        unset($fields['billing_last_name']);
        unset($fields['billing_company']);
        unset($fields['billing_address_2']);
        unset($fields['billing_state']);
        unset($fields['billing_postcode']);
        unset($fields['billing_city']);
        unset($fields['billing_country']);

        return $fields;
    }


}