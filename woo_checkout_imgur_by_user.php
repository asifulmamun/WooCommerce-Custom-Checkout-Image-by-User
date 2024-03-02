<?php
/*
Plugin Name: Custom Checkout Image by User
Description: Allow users to upload images during checkout and store to own server.
Version: 1.1.0
Author: AL MAMUN
Plugin URI: https://github.com/asifulmamun/ccibu
Author URI: https://asifulmamun.info.bd
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: custom-checkout-image-by-user
Domain Path: /
*/


// TGM - Plugin for required / depencies
require_once(plugin_dir_path(__FILE__) . 'includes/class-tgm-plugin-activation.php');
function wcibu_register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'required' => true,
        ),
    );

    $config = array(
        'id' => 'wcibu-tgmpa',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message' => '',
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'wcibu'),
            'menu_title' => __('Install Plugins', 'wcibu'),
            'installing' => __('Installing Plugin: %s', 'wcibu'),
            // Customize other strings as needed
        ),
    );

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'wcibu_register_required_plugins');



// Main
function check_woocommerce_activation() {
    if(is_plugin_active('woocommerce/woocommerce.php')) {

        // Upload Image
        require_once(plugin_dir_path(__FILE__) . 'includes/upload_image.php');

        // Uploaded Files SAVE to DB
        require_once(plugin_dir_path(__FILE__) . 'includes/uploaded_files_save.php');

        // View Files in Order Page - Users
        require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view.php');

        // View File in Order Page from Dashboard
        require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view_dashboard.php');

    }

} // check_woocommerce_activation()
add_action('admin_init', 'check_woocommerce_activation');
