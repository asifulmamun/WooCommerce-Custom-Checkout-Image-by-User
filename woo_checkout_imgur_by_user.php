<?php
/*
Plugin Name: Woo Checkout Imgur by User
Description: Allow users to upload images during checkout and store to own server or Imgur.
Version: 1.1.0
Author: AL MAMUN
*/


// Upload Image
require_once(plugin_dir_path(__FILE__) . 'includes/upload_image.php');

// Uploaded Files SAVE to DB
require_once(plugin_dir_path(__FILE__) . 'includes/uploaded_files_save.php');

// View Files in Order Page - Users
require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view.php');

// View File in Order Page from Dashboard
require_once(plugin_dir_path(__FILE__) . 'includes/order_page_view_dashboard.php');

