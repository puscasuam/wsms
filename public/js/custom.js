
/** function to upload an image */
function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function getFile(e){
        let file = e.currentTarget.files[0];
        checkType(file);
    }

    function previewImage(file){
        let thumb = box.querySelector('.js--image-preview'),
            reader = new FileReader();

        reader.onload = function() {
            thumb.style.backgroundImage = 'url(' + reader.result + ')';
            document.getElementById("image-body").value = reader.result;
        };
        reader.readAsDataURL(file);
        thumb.className += ' js--no-default';
    }

    function checkType(file){
        let imageType = /image.*/;
        if (!file.type.match(imageType)) {
            throw 'The file is not an image';
        } else if (!file){
            throw 'No image uploaded';
        } else {
            previewImage(file);
        }
    }

}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#gemstone').select2();
    $('#material').select2();
    $('#brand').select2();
    $('#category').select2();
    $('#sublocation').select2();
    $('#location').select2();

    let boxes = document.getElementById('box-image');
    if (boxes) {
        initImageUpload(boxes);
    }
});
