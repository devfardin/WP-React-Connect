<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class CUSTOM_SETTINGS
{    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_react_settings_page'));
        add_action('admin_init', array($this, 'register_react_settings'));
        add_action('update_option_site_title', array($this, 'update_wp_site_title'), 10, 2);
        add_action('update_option_site_tagline', array($this, 'update_wp_site_tagline'), 10, 2);
    }

    public function add_react_settings_page()
    {
        add_menu_page('React Settings', 'React Settings', 'manage_options', 'react-settings', [$this, 'render_react_settings_page'], 'dashicons-admin-generic', 50);
    }

    public function register_react_settings()
    {
        register_setting('react_settings_group', 'site_title');
        register_setting('react_settings_group', 'site_tagline');
        register_setting('react_settings_group', 'frontend_url');
        register_setting('react_settings_group', 'shop_phone_number');
        register_setting('react_settings_group', 'phone_title');
        register_setting('react_settings_group', 'whatsapp_number');
        register_setting('react_settings_group', 'facebook_username');
        register_setting('react_settings_group', 'checkout_instruction_title');
        register_setting('react_settings_group', 'checkout_instruction_description');
        register_setting('react_settings_group', 'footer_copyright_text');
        register_setting('react_settings_group', 'react_logo_url');
    }

    public function update_wp_site_title($old_value, $new_value)
    {
        update_option('blogname', $new_value);
    }

    public function update_wp_site_tagline($old_value, $new_value)
    {
        update_option('blogdescription', $new_value);
    }

    public function render_react_settings_page()
    { ?>
        <div class="react-settings-wrap">
            <div class="react-header">
                <h1>
                    <svg class="react-icon" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="12" r="2" />
                        <path d="M12 1c-1.5 8.5-8.5 8.5-8.5 11s7 2.5 8.5 11c1.5-8.5 8.5-8.5 8.5-11S13.5 9.5 12 1z" />
                        <ellipse cx="12" cy="12" rx="11" ry="4" fill="none" stroke="currentColor" stroke-width="1" />
                        <ellipse cx="12" cy="12" rx="11" ry="4" fill="none" stroke="currentColor" stroke-width="1"
                            transform="rotate(60 12 12)" />
                        <ellipse cx="12" cy="12" rx="11" ry="4" fill="none" stroke="currentColor" stroke-width="1"
                            transform="rotate(120 12 12)" />
                    </svg>
                    React Frontend Settings
                </h1>
                <p style="margin: 10px 0 0 0; opacity: 0.9;">Configure your React application integration with WooCommerce</p>
            </div>

            <div class="react-content">
                <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']): ?>
                    <div class="notice notice-success is-dismissible">
                        <p><strong>Settings saved successfully!</strong></p>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="options.php">
                    <?php settings_fields('react_settings_group'); ?>

                    <div class="settings-grid">
                        <div class="settings-card">
                            <h3><span class="dashicons dashicons-admin-site-alt3"></span>Site Information</h3>
                            <div class="form-field">
                                <label for="site_title">Site Title</label>
                                <input type="text" id="site_title" name="site_title"
                                    value="<?php echo esc_attr(get_option('site_title', get_bloginfo('name'))); ?>"
                                    placeholder="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                                <div class="description">Same as WordPress site title</div>
                            </div>
                            <div class="form-field">
                                <label for="site_tagline">Site Tagline</label>
                                <input type="text" id="site_tagline" name="site_tagline"
                                    value="<?php echo esc_attr(get_option('site_tagline', get_bloginfo('description'))); ?>"
                                    placeholder="<?php echo esc_attr(get_bloginfo('description')); ?>" />
                                <div class="description">Same as WordPress tagline</div>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h3><span class="dashicons dashicons-admin-links"></span>Frontend Configuration</h3>
                            <div class="form-field">
                                <label for="wordpress_address">WordPress Address</label>
                                <input type="url" id="wordpress_address" name="wordpress_address"
                                    value="<?php echo esc_url(home_url()); ?>" readonly style="background-color: #f1f1f1;" />
                                <div class="description">WordPress site URL (read-only)</div>
                            </div>
                            <div class="form-field">
                                <label for="frontend_url">Frontend URL</label>
                                <input type="url" id="frontend_url" name="frontend_url"
                                    value="<?php echo esc_attr(get_option('frontend_url', '')); ?>"
                                    placeholder="https://your-react-app.com" />
                                <div class="description">Your React application URL for CORS configuration</div>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h3><span class="dashicons dashicons-phone"></span>Contact Information</h3>
                            <div class="form-field">
                                <label for="shop_phone_number">Phone Number</label>
                                <input type="tel" id="shop_phone_number" name="shop_phone_number"
                                    value="<?php echo esc_attr(get_option('shop_phone_number', '')); ?>"
                                    placeholder="+880 1234-567890" />
                                <div class="description">Contact number displayed on your React frontend</div>
                            </div>
                            <div class="form-field">
                                <label for="phone_title">Phone Title</label>
                                <input type="text" id="phone_title" name="phone_title"
                                    value="<?php echo esc_attr(get_option('phone_title', 'অর্ডার করতে কল করুন')); ?>"
                                    placeholder="অর্ডার করতে কল করুন" />
                                <div class="description">Title text for phone number section</div>
                            </div>
                            <div class="form-field">
                                <label for="whatsapp_number">WhatsApp Number</label>
                                <input type="tel" id="whatsapp_number" name="whatsapp_number"
                                    value="<?php echo esc_attr(get_option('whatsapp_number', '')); ?>"
                                    placeholder="+880 1234-567890" />
                                <div class="description">WhatsApp contact number</div>
                            </div>
                            <div class="form-field">
                                <label for="facebook_username">Facebook Username</label>
                                <input type="text" id="facebook_username" name="facebook_username"
                                    value="<?php echo esc_attr(get_option('facebook_username', '')); ?>"
                                    placeholder="your.facebook.username" />
                                <div class="description">Facebook page or profile username</div>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h3><span class="dashicons dashicons-cart"></span>Checkout Instructions</h3>
                            <div class="form-field">
                                <label for="checkout_instruction_title">Instruction Title</label>
                                <input type="text" id="checkout_instruction_title" name="checkout_instruction_title"
                                    value="<?php echo esc_attr(get_option('checkout_instruction_title', '')); ?>"
                                    placeholder="How to Order" />
                                <div class="description">Title for checkout page instructions</div>
                            </div>
                            <div class="form-field">
                                <label for="checkout_instruction_description">Instruction Description</label>
                                <textarea id="checkout_instruction_description" name="checkout_instruction_description" rows="4"
                                    placeholder="Enter checkout instructions here..."><?php echo esc_textarea(get_option('checkout_instruction_description', '')); ?></textarea>
                                <div class="description">Detailed instructions for customers on checkout page</div>
                            </div>
                        </div>

                           <div class="settings-card">
                            <h3><span class="dashicons dashicons-format-image"></span>Brand Logo</h3>
                            <div class="logo-upload-area">
                                <input type="hidden" id="react_logo_url" name="react_logo_url"
                                    value="<?php echo esc_attr(get_option('react_logo_url', '')); ?>" />
                                <button type="button" id="upload_logo_button" class="btn-primary">
                                    <span class="dashicons dashicons-upload" style="margin-right: 5px;"></span>
                                    Upload Logo
                                </button>
                                <button type="button" id="remove_logo_button" class="btn-secondary"
                                    style="<?php echo get_option('react_logo_url') ? '' : 'display:none;'; ?>">
                                    Remove
                                </button>
                                <div class="description" style="margin-top: 10px;">Upload your brand logo for the React frontend
                                </div>
                            </div>
                            <div id="logo_preview" class="logo-preview">
                                <?php if (get_option('react_logo_url')): ?>
                                    <img src="<?php echo esc_url(get_option('react_logo_url')); ?>" alt="Logo Preview" />
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h3><span class="dashicons dashicons-editor-alignleft"></span>Footer Settings</h3>
                            <div class="form-field">
                                <label for="footer_copyright_text">Copyright Text</label>
                                <input type="text" id="footer_copyright_text" name="footer_copyright_text"
                                    value="<?php echo esc_attr(get_option('footer_copyright_text', '')); ?>"
                                    placeholder="© 2024 Your Company Name. All rights reserved." />
                                <div class="description">Copyright text displayed in footer</div>
                            </div>
                            <div class="form-field">
                                <label for="developer_name">Developer Name</label>
                                <input type="text" id="developer_name" name="developer_name"
                                    value="Fardin Ahmed" readonly style="background-color: #f1f1f1;" />
                                <div class="description">Developer information (read-only)</div>
                            </div>
                            <div class="form-field">
                                <label for="developer_url">Developer URL</label>
                                <input type="url" id="developer_url" name="developer_url"
                                    value="https://github.com/devfardin" readonly style="background-color: #f1f1f1;" />
                                <div class="description">Developer profile URL (read-only)</div>
                            </div>
                        </div>
                    </div>

                    <div class="save-section">
                        <button type="submit" class="btn-primary" style="padding: 12px 30px; font-size: 16px;">
                            <span class="dashicons dashicons-yes" style="margin-right: 5px;"></span>
                            Save Settings
                        </button>
                        <div class="description" style="margin-top: 10px;">Changes will be applied to your React frontend
                            immediately</div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}