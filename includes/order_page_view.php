<?php


// Add a new column to the "My Account" order details page
function add_custom_image_column_to_order_details($order) {

    $custom_image_url = get_post_meta($order->get_id(), 'custom_image', true);
    if ($custom_image_url) {
?>

<a target="_blank" href="<?php echo $custom_image_url; ?>"><img src="<?php echo $custom_image_url; ?>"></a><br>
<a target="_blank" href="<?php echo $custom_image_url; ?>">View File</a>

<?php
    }
}
add_action('woocommerce_order_details_before_order_table', 'add_custom_image_column_to_order_details');
