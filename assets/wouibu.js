// console.log('Hello WCIBU');

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('wcibu_upload').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        uploadImage(); // Call your custom upload function
    });
});

function uploadImage() {
    // console.log('Le Halua');


    var fileInput = document.getElementById('custom_image');
    var file = fileInput.files[0];
    
    var formData = new FormData();
    formData.append('custom_image', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-content/plugins/woo_checkout_imgur_by_user/upload.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText); // Parse the JSON response
            console.log(response.message);
        } else {
            console.error('Error uploading image.');
        }
    };

    xhr.send(formData);


}