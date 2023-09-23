// console.log('Hello WCIBU');

// Action Buttton
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('wcibu_uploadBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        uploadImage(); // Call your custom upload function
    });
});


// Upload Image
function uploadImage() {
    // console.log('Le Halua');
    var fileInput = document.getElementById('wcibu_customImg');
    var file = fileInput.files[0];
    
    var formData = new FormData();
    formData.append('wcibu_customImg', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-content/plugins/woo_checkout_imgur_by_user/upload.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText); // Parse the JSON response
            
            console.log(response.url);

            // changing DOM
            afterUploaded(response.url);

        } else {
            console.error('Error uploading image.');
        }
    };
    xhr.send(formData);
}


// Change DOM in Field of Upload
const wcibu_wrapper = document.getElementById('wcibu_wrapper');
function afterUploaded(url){



}