<?php

// Add custom image meta to admin order details
function add_custom_image_meta_to_admin_order_details($order) {
    $custom_image_url = get_post_meta($order->get_id(), 'custom_image', true);
    if ($custom_image_url) {
        echo '<div class="order_data_column" style="width:100%;">';
        echo '<h4>' . __('Custom Image', 'woocommerce') . '</h4>';
        echo '<p><a target="_blank" href="' . $custom_image_url . '"><img style="max-width:400px;" src="' . $custom_image_url . '"></a></p>';
        echo '<p><a class="button button-primary" target="_blank" href="' . $custom_image_url . '">' . __('View File', 'woocommerce') . '</a></p>';
        echo '</div>';
    }
}
add_action('woocommerce_admin_order_data_after_billing_address', 'add_custom_image_meta_to_admin_order_details', 10, 1);
