<?php
header('Content-Type: application/json');

require_once('../../../../wp-load.php'); // Adjust the path as needed

class ImageUploader {
    private $uploadedImage;
    private $allowed_types;


    public function __construct() {
        $this->uploadedImage = isset($_FILES['wcibu_customImg']) ? $_FILES['wcibu_customImg'] : null;
        $this->allowed_types = ['image/jpeg', 'image/png']; // Allowd Type JPG/PNG

    }

    public function processImage() {     
        if (!$this->uploadedImage) {
            return [
                'message' => 'No image uploaded.',
                'url' => ''
            ];
        }
        // Check if it's a valid image type (JPG or PNG)
        elseif (!in_array($this->uploadedImage['type'], $this->allowed_types)) {
            return [
                'message' => 'Invalid image type. Please upload a JPG or PNG file.',
                'url' => ''
            ];
        }
        else{

            // If uploaded image while found file
            $uploadResult = $this->uploadImage();
            return $uploadResult;
        }

    }

    private function uploadImage() {

        // After Size Checking Upload to Local Directory
        if ($this->uploadedImage && $this->uploadedImage['size'] > 0) {
            $upload_dir = wp_upload_dir();

            $_renameFile = date('d-m-Y') . '_' . rand(1, 100) . "_" . str_replace(" ", "_", basename($this->uploadedImage['name']));

            $target_path = $upload_dir['path'] . '/' . $_renameFile;
            move_uploaded_file($this->uploadedImage['tmp_name'], $target_path);

            $position = strpos($target_path, '/wp-content');
            if($position !== false) {
                $image_path = substr($target_path, $position);
                $image_url = get_site_url() . $image_path;
            } else {
                $image_url = '';
            }

            return [
                'message' => 'Success uploading image',
                'url' => $image_url
            ];
        } else {
            return [
                'message' => 'Error uploading image.',
                'url' => ''
            ];
        }
    }
}

$imageUploader = new ImageUploader();
$response = $imageUploader->processImage();

echo json_encode($response);
