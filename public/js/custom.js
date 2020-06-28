
// Function for upload of an image
function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function getFile(e) {
        let file = e.currentTarget.files[0];
        checkType(file);
    }

    function previewImage(file) {
        let thumb = box.querySelector('.js--image-preview'),
            reader = new FileReader();

        reader.onload = function () {
            thumb.style.backgroundImage = 'url(' + reader.result + ')';
            document.getElementById("image-body").value = reader.result;
        };
        reader.readAsDataURL(file);
        thumb.className += ' js--no-default';
    }

    function checkType(file) {
        let imageType = /image.*/;
        if (!file.type.match(imageType)) {
            throw 'The file is not an image';
        } else if (!file) {
            throw 'No image uploaded';
        } else {
            previewImage(file);
        }
    }
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
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
    if (productFormType) {
        if ($(productFormType).val() === "view") {
            $("#product-form :input").prop("disabled", true);
        }
    }

    let partnerFormType = document.getElementById('partner-form-type');
    if (partnerFormType) {
        if ($(partnerFormType).val() === "view") {
            $("#partner-form :input").prop("disabled", true);
        }
    }

    let date_input = $('input[name="date"]'); //our date input has the name "date"
    // var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    let options = {
        format: 'dd-mm-yyyy',
        // container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);

    let date_from = $('input[name="date_from"]'); //our date input has the name "date"
    let options_date_from = {
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
    };
    date_from.datepicker(options_date_from);

    let date_to = $('input[name="date_to"]'); //our date input has the name "date"
    let options_date_to = {
        format: 'dd-mm-yyyy',
        // container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_to.datepicker(options_date_to);

    // Add new element
    $(".add").click(function () {

        // Finding total number of elements added
        let total_element = $(".element").length;

        // last <div> with element class id
        let lastid = $(".element:last").attr("id");
        let split_id = lastid.split("_");
        let nextindex = Number(split_id[1]) + 1;

        let max = 5;
        // Check total number elements
        if (total_element < max) {
            // Adding new div container after last occurance of element class
            $(".element:last").after("<div class='element' id='div_" + nextindex + "'></div>");

            // Adding element to <div>
            $("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_" + nextindex + "'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");
        }
    });

    // Remove element
    $('.container').on('click', '.remove', function () {

        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#div_" + deleteindex).remove();

    });

    // Show Error Transaction Modal
    let errorTransaction = $('#error-transaction');
    if (errorTransaction && errorTransaction.val() !== '') {
        $('#errorTransactionModal').modal('show');
    }

    // Get occupancy rate
    let occupancyRateText = $('#occupancy-rate-text');
    let occupancyRateValue = $('#occupancy-rate-value');
    if (occupancyRateText.length && occupancyRateValue.length) {
        get_occupancy_rate(occupancyRateText, occupancyRateValue);
    }

    //Get employees number
    let employeesNoText = $('#employees-no-text');
    if(employeesNoText.length){
        get_employees_no(employeesNoText);
    }

    // Get income number
    let incomeNumber = $('#income-number-text');
    if(incomeNumber.length){
        get_income_no(incomeNumber);
    }

    // Get outcome number
    let outcomeNumber = $('#outcome-number-text');
    if(outcomeNumber.length){
        get_outcome_no(outcomeNumber);
    }

    // Get Location Occupancy
    if ( $('#location-1-text').length &&  $('#location-1-value').length) {
        get_location_occupancy();
    }

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

        // Create the select for the new row
        let currentRow = $('.product-row:last');
        let currentSelect = currentRow.find('.product');
        let currentSelectedOption = currentSelect.find('option:selected').val();
        currentSelect.prop('disabled', true);
        currentRow.find('.selected-products:first').val(currentSelectedOption);

        // Disable the previous selected options for the select
        let selectedOptions = $('.product-row .product :selected');
        $.each(selectedOptions, function (index, selectedOption) {
            let value = $(selectedOption).val();
            if (value !== "") {
                productRemoveRow.find('option[value="' + value + '"]').prop('disabled', true);
            }
        });

        // Insert the cloned row after the last row
        productRemoveRow.insertAfter(currentRow);

        // Disable the Add row button
        $('.product-add-row .btn-success').prop('disabled', true);

        // Needed for creating search-select
        // $('.product').select2();
    } else {

        // Remove the row
        productRow.remove();

        // Recalculate the amount
        recalculate_amount();
    }
}

function recalculate_amount(input) {

    let orderType = $('#order_type').val();

    // do not allow more then max stock
    if (orderType === "2") { // out
        if (input.hasClass('product_units') && (parseInt(input.val()) > parseInt(input.data('initial')))) {
            input.val(input.data('initial'));
        }
    }

    // do not allow less then zero
    if (parseInt(input.val()) < 0) {
        input.val(0);
    }

    let allProductRows = $('.product-row');

    let amount = 0;

    allProductRows.each(function (key, productRow) {
        let productUnits = $(productRow).find('.product_units').val();
        let productPrice = $(productRow).find('.product_price').val();

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
            if (updateType == "discount") {
                finalAmount = finalAmount * (1 - (parseInt(update_percentage) / 100));
            }
            if (updateType == "surcharge") {
                finalAmount = finalAmount * (1 + (parseInt(update_percentage) / 100));
            }
        }

        $('#final_amount').val(finalAmount);
    }
}

function get_units_and_price(select) {

    let orderType = $('#order_type').val();

    if (orderType === "2") {
        let product_id = select.val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/product-details-json',
            method: 'POST',
            data: {
                product_id: product_id
            },
            // dataType: "json",
            success: function (product) {

                product = JSON.parse(product);
                if (product && (product.price > 0) && (product.stock >= 0)) {

                    // Get the entire row
                    let productRow = select.parents('.product-row:first');

                    // Set the units and price
                    let units = productRow.find('.product_units');
                    units.val(product.stock);
                    units.data('initial', product.stock);
                    units.trigger("change");

                    let price = productRow.find('.product_price');
                    price.val(product.price);
                    price.trigger("change");
                    price.prop("readonly", true);

                    // recreate the select
                    // recreate_select(select);
                }
            },
            failure: function (errMsg) {
                alert(errMsg);
            }
        });
    }

    if (select.val() !== '') {
        $('.product-add-row .btn-success').prop('disabled', false);
    }
}

function recreate_select(select) {

    // let selectedOptions = $('.product-row .product :selected');
    // let dummySelect = $('.product-dummy-row .product');
    //
    // $.each(selectedOptions, function (index, selectedOption) {
    //     let value = $(selectedOption).val();
    //     // dummySelect.find('option[value="' + value + '"]').prop('disabled', true);
    //
    //     $('.product-row .product')
    // });

    // let selectedOptions = $('.product-row .product :selected');
    // let cloneDummySelect = $('.product-dummy-row .product').clone();
    //
    // $.each(selectedOptions, function (index, selectedOption) {
    //     let value = $(selectedOption).val();
    //     cloneDummySelect.find('option[value="' + value + '"]').prop('disabled', true);
    //     cloneDummySelect.find('option[value="' + value + '"]').prop('disabled', true);
    // });

    // select.html(cloneDummySelect.html());
}

function change_products_selects() {

    let allSelects = $('.product-row .product');
    allSelects.change(function () {
        let selectedOptions = $('.product-row .product :selected');
        $.each(selectedOptions, function (index, selectedOption) {
            let value = $(selectedOption).val();
            allSelects.find('option[value="' + value + '"]').prop('disabled', true);
        });
    })
}

function disable_previous_selected_options(select) {

    let selectedOptions = $('.product-row .product :selected');
    $.each(selectedOptions, function (index, selectedOption) {
        let value = $(selectedOption).val();
        if (value !== "") {
            select.find('option[value="' + value + '"]').prop('disabled', true);
        }
    });
}

function change_sort_direction(button, inputId) {

    let directionIcon = $(button.children('i:first')[0]);

    let direction = '';
    if (directionIcon.hasClass('fa-sort')) {
        direction = 'asc';
        directionIcon.removeClass('fa-sort');
        directionIcon.addClass('fa-angle-double-up');
    } else if (directionIcon.hasClass('fa-angle-double-up')) {
        direction = 'desc';
        directionIcon.removeClass('fa-angle-double-up');
        directionIcon.addClass('fa-angle-double-down');
    } else {
        direction = '';
        directionIcon.removeClass('fa-angle-double-down');
        directionIcon.addClass('fa-sort');
    }

    $(inputId).val(direction);

    if (direction === '') {
        $('button i.fa-sort').each(function(key, sortButton){
            console.log($(sortButton));
            $(sortButton).parent('button:first').prop('disabled', false);
        })
    } else {

        $('button i.fa-sort').each(function(key, sortButton){
            console.log($(sortButton));
            $(sortButton).parent('button:first').prop('disabled', true);
        })
    }
}

function get_occupancy_rate(occupancyRateText, occupancyRateValue) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/occupancy-rate-json',
        method: 'POST',
        data: {},
        success: function (occupancyRate) {
            occupancyRate = JSON.parse(occupancyRate);
            occupancyRateText.text(occupancyRate + '%');
            occupancyRateValue.css("width", occupancyRate+ '%');
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function get_employees_no(employeesNoText) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/employees-no-json',
        method: 'POST',
        data: {},
        success: function (employeesNo) {
            employeesNo = JSON.parse(employeesNo);
            employeesNoText.text(employeesNo);
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function get_income_no(incomeNoText) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/income-no-json',
        method: 'POST',
        data: {},
        success: function (incomeNo) {
            incomeNo = JSON.parse(incomeNo);
            incomeNoText.text('$' + incomeNo);
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function get_outcome_no(outcomeNoText) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/outcome-no-json',
        method: 'POST',
        data: {},
        success: function (outcomeNo) {
            outcomeNo = JSON.parse(outcomeNo);
            outcomeNoText.text('$' + outcomeNo);
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function get_location_occupancy() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/location-occupancy-json',
        method: 'POST',
        data: {},
        success: function (locations) {

            locations = JSON.parse(locations);
            $.each(locations, function (index, location) {
                $('#location-' + index + '-text').text(location.text);
                $('#location-' + index + '-value').css("width", location.value + '%');
            });

        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function check_unique_product_name(product) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/check-unique-product-name',
        method: 'POST',
        data: {
            product_name: product.val()
        },
        success: function (productNameExists) {

            productNameExists = JSON.parse(productNameExists);
            if (productNameExists) {
                product.val('');
                if (!product.hasClass('is-invalid')) {
                    product.addClass('is-invalid');
                    product.parent('.col-sm-8:first').append("<span class='invalid-feedback' role='alert'><strong>This name already exists</strong></span>");
                }
            } else {
                if (product.hasClass('is-invalid')) {
                    product.removeClass('is-invalid');
                    product.parent('.col-sm-8:first').child('.invalid-feedback:first').remove();
                }

            }
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function check_unique_user_email(user) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/check-unique-user-email',
        method: 'POST',
        data: {
            user_email: user.val()
        },
        success: function (userEmailExists) {

            userEmailExists = JSON.parse(userEmailExists);
            if (userEmailExists) {
                user.val('');
                if (!user.hasClass('is-invalid')) {
                    user.addClass('is-invalid');
                    user.parent('.col-sm-8:first').append("<span class='invalid-feedback' role='alert'><strong>This email already exists</strong></span>");
                }
            } else {
                if (user.hasClass('is-invalid')) {
                    user.removeClass('is-invalid');
                    user.parent('.col-sm-8:first').child('.invalid-feedback:first').remove();
                }

            }
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}

function check_unique_partner_cif(partner) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/check-unique-partner-cif',
        method: 'POST',
        data: {
            partner_cif: partner.val()
        },
        success: function (partnerCifExist) {

            partnerCifExist = JSON.parse(partnerCifExist);
            if (partnerCifExist) {
                partner.val('');
                if (!partner.hasClass('is-invalid')) {
                    partner.addClass('is-invalid');
                    partner.parent('.col-sm-8:first').append("<span class='invalid-feedback' role='alert'><strong>This CIF already exists</strong></span>");
                }
            } else {
                if (partner.hasClass('is-invalid')) {
                    partner.removeClass('is-invalid');
                    partner.parent('.col-sm-8:first').child('.invalid-feedback:first').remove();
                }

            }
        },
        failure: function (errMsg) {
            alert(errMsg);
        }
    });
}
