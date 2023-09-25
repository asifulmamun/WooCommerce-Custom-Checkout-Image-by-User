<?php
header('Content-Type: application/json');

require_once('../../../../wp-load.php'); // Adjust the path as needed

// Get FILES from FORM
$getFiles = isset($_FILES['wcibu_customImg']) ? $_FILES['wcibu_customImg'] : null;



// Image Uploader
class ImageUploader {
    private $uploadedImage;
    private $allowed_types;
    private $max_size;
    

    public function __construct($files) {
        $this->uploadedImage = $files;
        $this->allowed_types = ['image/jpeg', 'image/JPEG', 'image/png', 'image/PNG', 'image/JPG', 'image/jpg']; // Allowd Type JPG/PNG
        $this->max_size = 1 * 1024 * 1024; // 1MB in bytes

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
                'message' => 'Invalid image type. Please upload a JPG or PNG file. ',
                'url' => ''
            ];
        }
        // Check the image size
        elseif ($this->uploadedImage['size'] > $this->max_size) {
            return [
                'message' => 'File size exceeds the maximum limit of 1MB.',
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



// Image Upload or not
$imageUploader = new ImageUploader($getFiles);
$response = $imageUploader->processImage();



// Return Result
echo json_encode($response);
