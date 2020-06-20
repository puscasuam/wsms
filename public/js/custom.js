
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
    $('#partner').select2();
    $('#order_type').select2();
    $('#product').select2();


    let boxes = document.getElementById('box-image');
    if (boxes) {
        initImageUpload(boxes);
    }

    let productFormType = document.getElementById('product-form-type');
    if(productFormType){
        if($(productFormType).val() === "view"){
            $("#product-form :input").prop("disabled", true);
        }
    }

    let partnerFormType = document.getElementById('partner-form-type');
    if(partnerFormType){
        if($(partnerFormType).val() === "view"){
            $("#partner-form :input").prop("disabled", true);
        }
    }

    let date_input=$('input[name="date"]'); //our date input has the name "date"
    // var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    let options={
        format: 'dd-mm-yyyy',
        // container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);

    let date_from=$('input[name="date_from"]'); //our date input has the name "date"
    let options_date_from={
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
    };
    date_from.datepicker(options_date_from);

    let date_to=$('input[name="date_to"]'); //our date input has the name "date"
    let options_date_to={
        format: 'dd-mm-yyyy',
        // container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_to.datepicker(options_date_to);

    // Add new element
    $(".add").click(function(){

        // Finding total number of elements added
        let total_element = $(".element").length;

        // last <div> with element class id
        let lastid = $(".element:last").attr("id");
        let split_id = lastid.split("_");
        let nextindex = Number(split_id[1]) + 1;

        let max = 5;
        // Check total number elements
        if(total_element < max ){
            // Adding new div container after last occurance of element class
            $(".element:last").after("<div class='element' id='div_"+ nextindex +"'></div>");

            // Adding element to <div>
            $("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_"+ nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");

        }

    });

    // Remove element
    $('.container').on('click','.remove',function(){

        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#div_" + deleteindex).remove();

    });
});

function add_or_remove_product_row(button) {

    // Get the entire row
    let productRow = button.parents('.product-row:first');

    // Check if it's Add or Remove
    if (productRow.hasClass('product-add-row')) {

        // Clone and add the row
        let productRemoveRow = $('.product-dummy-row').clone();
        productRemoveRow.addClass('product-row');
        productRemoveRow.addClass('product-remove-row');
        productRemoveRow.removeClass('product-dummy-row');
        productRemoveRow.css("display", "");

        productRemoveRow.insertAfter($('.product-row:last'));
    } else {

        // Remove the row
        productRow.remove();

        // Recalculate the amount
        recalculate_amount();
    }
}

function recalculate_amount() {

    let allProductRows = $('.product-row');

    let amount = 0;
    let finalAmount = 0;

    allProductRows.each(function(key, productRow) {
        let productUnits = $(productRow).find('#product-units').val();
        let productPrice = $(productRow).find('#product-price').val();

        if (productUnits !== '' && productPrice !== '') {
            amount = amount + parseInt(productUnits) * parseInt(productPrice);
        }
    });

    $('#amount').val(amount);
    recalculate_final_amount();
}

function show_hide_final_amount(select) {

    let priceUpdateRow = $('.price-update-row');
    let finalAmountRow = $('.final-amount-row');

    if (select.val() === "2") {
        priceUpdateRow.removeClass('d-none');
        finalAmountRow.removeClass('d-none');
    } else {
        if (!priceUpdateRow.hasClass('d-none')) {
            priceUpdateRow.addClass('d-none');
        }
        if (!finalAmountRow.hasClass('d-none')) {
            finalAmountRow.addClass('d-none');
        }
    }
}

function recalculate_final_amount() {

    let priceUpdateRow = $('.price-update-row');
    let finalAmountRow = $('.final-amount-row');
    if (!priceUpdateRow.hasClass('d-none') && !finalAmountRow.hasClass('d-none')) {

        let amount = $('#amount').val();
        let updateType = $('#update_type').val();
        let update_percentage = $('#update_percentage').val();

        let finalAmount = amount;

        if (update_percentage !== '') {
            if(updateType == "discount"){
                finalAmount = finalAmount * (1 - (parseInt(update_percentage) / 100));
            }
            if(updateType == "discount"){
                finalAmount = finalAmount * (1 + (parseInt(update_percentage) / 100));
            }
        }

        $('#final_amount').val(finalAmount);
    }
}
