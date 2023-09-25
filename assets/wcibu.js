// console.log('Hello WCIBU');
// console.log(staticData.pluginDir);


class WCIBU {
    constructor() {
        this.pluginDir = staticData.pluginDir;
        this.wrapper = document.getElementById('wcibu_wrapper');
        this.customImg = document.getElementById('wcibu_customImg');
        this.uploadBtn = document.getElementById('wcibu_uploadBtn');

        this.uploadBtn.addEventListener('click', this.uploadImage.bind(this));
    }

    uploadImage(event) {
        event.preventDefault(); // Prevent default form submission
        const file = this.customImg.files[0];

        const formData = new FormData();
        formData.append('wcibu_customImg', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', `${this.pluginDir}/includes/process.php`, true);

        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText); // Parse the JSON response

                const wcibu_wrapped = document.getElementById('wcibu_wrapped');
                const wcibu_msg = document.getElementById('wcibu_msg');
                const wcibu_res_img = document.getElementById('wcibu_res_img');

                if(response.url == ""){
                    // console.log(response.message);
                    wcibu_msg.innerText = response.message;
                    wcibu_msg.classList.add('wcibu_msg_err');

                } else{

                    // console.log(response.url);
                    wcibu_msg.innerText = response.message;
                    wcibu_msg.classList.add('wcibu_msg_suc');
                    wcibu_res_img.innerHTML = '<a title="Click here to for view" target="_blank" href="'+ response.url +'"><img class="wcibu_res_img" src="'+ response.url +'"></a>';
                    wcibu_wrapped.style.display = 'none';
                    

                    
                     // Save URL to WooCommerce order
                     this.saveUrlToOrder(response.url);

                }

            } else {
                console.error('Error uploading image.');
            }
        };

        xhr.send(formData);
    }

    // Save URL
    saveUrlToOrder(url) {
        const wcibu_DATA_SAVE_TO_DB = document.getElementById('wcibu_DATA_SAVE_TO_DB');

        const imageUrlInput = document.createElement('input');
        imageUrlInput.type = 'hidden';
        imageUrlInput.name = 'uploaded_image_url';
        imageUrlInput.value = url;
        wcibu_DATA_SAVE_TO_DB.appendChild(imageUrlInput);
    }
}

// Initialize WCIBU class
document.addEventListener('DOMContentLoaded', function() {
    const wcibu = new WCIBU();
});
