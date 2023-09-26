<?php


// Save the uploaded image in the order meta
function save_uploaded_image_to_order_meta($order_id) {
    if (isset($_POST['uploaded_image_url'])) {
        $uploaded_image_url = sanitize_text_field($_POST['uploaded_image_url']);
        update_post_meta($order_id, 'custom_image', $uploaded_image_url);
    }
}
add_action('woocommerce_checkout_update_order_meta', 'save_uploaded_image_to_order_meta');
