<?php 

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class CUSTOM_SETTINGS {
    public function __construct()
    {
        add_action('admin_init', array($this, 'add_custom_general_settings_section'));
    }

    public function add_custom_general_settings_section()
    {
        add_settings_section(
            'my_custom_section_id', // Unique ID for the section
            'My Custom Settings Section', // Section title
            null, // Callback function (optional)
            'general' // Page to add the section to
        );

        $this->add_shop_phone_field();
        $this->add_custom_textarea_field();
    }

    public function add_shop_phone_field()
    {
        add_settings_field(
            'shop_phone_number',
            'Shop Phone Number',
            array($this, 'render_shop_phone_field'),
            'general',
            'my_custom_section_id'
        );
        register_setting('general', 'shop_phone_number');
    }

    public function render_shop_phone_field()
    {
        $value = get_option('shop_phone_number', '');
        echo '<input type="tel" id="shop_phone_number" name="shop_phone_number" value="' . esc_attr($value) . '" placeholder="Enter shop phone number" />';
    }

    public function add_custom_textarea_field()
    {
        add_settings_field(
            'custom_textarea_label',
            'Textarea Label',
            array($this, 'render_textarea_label_field'),
            'general',
            'my_custom_section_id'
        );
        add_settings_field(
            'custom_textarea_content',
            'Textarea Content',
            array($this, 'render_textarea_content_field'),
            'general',
            'my_custom_section_id'
        );
        register_setting('general', 'custom_textarea_label');
        register_setting('general', 'custom_textarea_content');
    }

    public function render_textarea_label_field()
    {
        $value = get_option('custom_textarea_label', '');
        echo '<input type="text" id="custom_textarea_label" name="custom_textarea_label" value="' . esc_attr($value) . '" placeholder="Enter label for textarea" />';
    }

    public function render_textarea_content_field()
    {
        $value = get_option('custom_textarea_content', '');
        echo '<textarea id="custom_textarea_content" name="custom_textarea_content" rows="5" cols="50" placeholder="Enter content here...">' . esc_textarea($value) . '</textarea>';
    }

}