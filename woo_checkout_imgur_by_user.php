<?php
/*
Plugin Name: Woo Checkout Imgur by User
Description: Allow users to upload images during checkout and store to own server or Imgur.
Version: 1.1.0
Author: AL MAMUN
*/

// Adding Image Upload Field to Checkout Page
function add_image_upload_field_to_checkout() {
    // woocommerce_form_field('custom_image', array(
    //     'type' => 'file',
    //     'class' => array('form-row-wide'),
    //     'label' => __('Image Upload'),
    //     'placeholder' => __('Choose an image'),
    //     'required' => true,
    // ), WC()->checkout->get_value('custom_image'));
?>

    <div id="wcibu_wrapper">
        <h3>Upload Image</h3>
        <label for="images" class="drop-container" id="dropcontainer">
            <input type="file" name="custom_image" id="wcibu_customImg" required>
        </label>
        <button id="wcibu_uploadBtn">Upload</button>
    </div>


 <!-- <div id="container">
	<div>
		<div class="upload" v-for="(upload, index) in uploads" :key="index">
			<div class="ext" :style="{'background-color': upload.color}">
				<p>{{upload.ext.toUpperCase()}}</p>
			</div>
			<div class="upload-details">
				<div class="name-container">
					<p class="filename">{{upload.name}}</p>
					<div>
						<p class="filesize">{{upload.size}}</p>
						<p @click="removeUpload(index)" class="cancel-btn" v-if="upload.progress !== '100%'">x</p>
					</div>
				</div>
				<div class="upload-bar" v-if="upload.progress !== '100%'">
					<div class="upload-progress" :style="{width: upload.progress}"></div>
				</div>
			</div>
		</div>
	</div>
	<div @click="openFilePicker" id="uploader">
		<p><span>Click</span> to choose a file to upload :)</p>
		<input type="file" ref="filepicker" @change="uploadFile" />
	</div>
</div> -->

<?php
}
add_action('woocommerce_checkout_before_customer_details', 'add_image_upload_field_to_checkout');







// CSS
function enqueue_custom_styles() {
    if (is_checkout() && !is_wc_endpoint_url()) {
        wp_enqueue_style('custom-plugin-styles', plugins_url('assets/wcibu.css', __FILE__));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// JS file
function enqueue_custom_script() {
    if (is_checkout() && !is_wc_endpoint_url()) {
        wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'assets/wcibu.js');

        // Send URL
        wp_localize_script('custom-script', 'staticData', array(
            'pluginDir' => plugin_dir_url(__FILE__),
        ));

    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

// // Save the uploaded image in the order meta
// function save_uploaded_image_to_order_meta($order_id) {
//     // $uploaded_image = $_FILES['custom_image'];

//     // if ($uploaded_image && $uploaded_image['size'] > 0) {
//     //     $upload_dir = wp_upload_dir();
//     //     $target_path = $upload_dir['path'] . '/' . basename($uploaded_image['name']);
//     //     move_uploaded_file($uploaded_image['tmp_name'], $target_path);

//     //     update_post_meta($order_id, 'custom_image', $upload_dir['url'] . '/' . basename($uploaded_image['name']));
//     // }
// }
// add_action('woocommerce_checkout_update_order_meta', 'save_uploaded_image_to_order_meta');



// function add_image_upload_field_to_checkout() {
//     echo '<div id="custom_image_upload_field"><h3>' . __('Upload Image') . '</h3>';
//     echo '<form action="' . plugin_dir_url(__FILE__) . 'upload.php" method="post" enctype="multipart/form-data">';
//     echo '<input type="file" name="custom_image" id="custom_image" class="form-row-wide" required>';
//     echo '<input type="submit" value="Upload Image">';
//     echo '</form>';
//     echo '</div>';
// }
// add_action('woocommerce_before_checkout_form', 'add_image_upload_field_to_checkout');