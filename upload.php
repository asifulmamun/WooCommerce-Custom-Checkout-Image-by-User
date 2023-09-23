<?php
header('Content-Type: application/json');

require_once('../../../wp-load.php'); // Adjust the path as needed

// Check the image uploaded or not
if(!isset($_FILES['custom_image'])):
    $response = [
        'message' => 'No image uploaded.'
    ];


else:
// If uploaded image
    $uploaded_image = $_FILES['custom_image'];
   
    $response = [
        'message' => $uploaded_image
    ];

    
    
    if ($uploaded_image && $uploaded_image['size'] > 0) {
        
        $upload_dir = wp_upload_dir();
        

        $_renameFile = date('d-m-Y') . '_' . rand(1,100) . "_" . str_replace(" ", "_", basename($uploaded_image['name']));

        $target_path = $upload_dir['path'] . '/' . $_renameFile;
        move_uploaded_file($uploaded_image['tmp_name'], $target_path);

        // Additional processing can be done here
        // For example, you can save the image URL in the order meta or perform other operations

        $response = [
            'message' => 'Success uploading image ' . $target_path
        ];
        
    } else {
        $response = [
            'message' => 'Error uploading image.'
        ];
        
    }

endif;









// if ($upload_success) {
//     $response = [
//         'success' => true,
//         'message' => 'Image uploaded successfully'
//     ];
// } else {
//     $response = [
//         'success' => false,
//         'message' => 'Error uploading image'
//     ];
// }


echo json_encode($response);