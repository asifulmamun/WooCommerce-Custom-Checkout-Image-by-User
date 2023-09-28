<?php
/*
Plugin Name: Woo Checkout Imgur by User
Description: Allow users to upload images during checkout and store to own server or Imgur.
Version: 1.1.0
Author: AL MAMUN
*/


// // Upload Image
// require_once(plugin_dir_path(__FILE__) . 'includes/upload_image.php');

// // Uploaded Files SAVE to DB
// require_once(plugin_dir_path(__FILE__) . 'includes/uploaded_files_save.php');

// // View Files in Order Page - Users
// require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view.php');

// // View File in Order Page from Dashboard
// require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view_dashboard.php');



add_action('admin_init', 'check_woocommerce_activation');

function check_woocommerce_activation() {
    if (class_exists('WooCommerce')) {
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            // WooCommerce is active, proceed with your plugin logic
            require_once(plugin_dir_path(__FILE__) . 'includes/upload_image.php');
            require_once(plugin_dir_path(__FILE__) . 'includes/uploaded_files_save.php');
            require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view.php');
            require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view_dashboard.php');
            // require_once(plugin_dir_path(__FILE__) . 'inc/tgm.php');
        } else {
            // WooCommerce is installed but not active, show a message to activate it
            add_action('admin_notices', 'my_plugin_woocomm_not_activated_message');
        }
    } else {
        // WooCommerce is not installed, show a message with an installation button
        add_action('admin_notices', 'my_plugin_woocomm_not_installed_message');
    }
}

function my_plugin_woocomm_not_installed_message() {
    // Check if WooCommerce is not already installed
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        echo '<div class="notice notice-error is-dismissible"><p>';
        echo 'WooCommerce is not installed. <a href="' . admin_url('plugin-install.php?s=woocommerce&tab=search&type=term') . '">Click here to install WooCommerce</a>.';
        echo '</p></div>';
    }
}

function my_plugin_woocomm_not_activated_message() {
    echo '<div class="notice notice-error is-dismissible"><p>';
    echo 'WooCommerce is installed but not activated. <a href="' . admin_url('plugins.php') . '">Click here to activate WooCommerce</a>.';
    echo '</p></div>';
}




