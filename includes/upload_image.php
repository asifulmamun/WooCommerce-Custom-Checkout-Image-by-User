<?php

// CSS
function enqueue_custom_styles() {
    if (is_checkout() && !is_wc_endpoint_url()) {
        wp_enqueue_style('custom-plugin-styles', plugins_url('../assets/wcibu.css', __FILE__));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// JS file
function enqueue_custom_script() {
    if (is_checkout() && !is_wc_endpoint_url()) {

        wp_enqueue_script('wcibu-script', plugin_dir_url(__FILE__) . '../assets/wcibu.js');

        // Send URL
        wp_localize_script('wcibu-script', 'staticData', array(
            'pluginDir' => plugin_dir_url(__FILE__),
        ));

    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');


// Adding Image Upload Field to Checkout Page
function add_image_upload_field_to_checkout() {
?>

    <div id="wcibu_wrapper">
        <div id="wcibu_wrapped">
            <h3>Upload Image</h3>
            <input type="file" name="custom_image" id="wcibu_customImg" required>
            <button id="wcibu_uploadBtn" class="button">Upload</button>
        </div>

        <!-- Result -->
        <div id="wcibu_msg"></div>
        <div id="wcibu_res_img"></div>
        <div id="wcibu_DATA_SAVE_TO_DB"></div>

    </div>


<?php
}
add_action('woocommerce_checkout_before_customer_details', 'add_image_upload_field_to_checkout');

