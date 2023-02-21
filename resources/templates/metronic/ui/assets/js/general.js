"use strict";

let C = console.log.bind(console);
let emptyGuid = "00000000-0000-0000-0000-000000000000";
let token = $('meta[name="csrf-token"]').attr('content');

// Add the token to all ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token
    }
});


// Show Error Sweet Alert
let initErrorAlert = (data) => {
    let errors = "";
    if (data === undefined || data === null) {
        errors = "An unknown errors has occurred. Please try again.";
    }
    else{
        if (data.errors !== undefined) {
            $.each(data.errors, function (key, value) {
                errors += value + "<br/>";
            });
        }
        else {
            errors += data.message;
        }
    }
    Swal.fire({
        title: 'Error',
        html: errors,
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}

// Show Error Alert with custom message
let initErrorAlertMessage = (message) => {
    Swal.fire({
        title: 'Error',
        html: message,
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}

// Show Success Sweet Alert
let initSuccessAlert = (data) => {
    Swal.fire({
        title: 'Success',
        html: data.message,
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}

// Show toastr notification
let initShowToastrNotification = (type, message, progressBar = true, timer = 5000) => {
    switch (type) {
        case "success":
            toastr.success(message, {
                progressBar: progressBar,
                closeButton: true,
                timeOut: timer
            });
            break;
        case "info":
            toastr.info(message, {
                progressBar: progressBar,
                closeButton: true,
                timeOut: timer
            });
            break;
        case "warning":
            toastr.warning(message, {
                progressBar: progressBar,
                closeButton: true,
                timeOut: timer
            });
            break;
        case "error":
            toastr.error(message, {
                progressBar: progressBar,
                closeButton: true,
                timeOut: timer
            });
            break;
    }
}

// Show loading indicator
let initShowLoadingIndicator = (element, text) => {
    if (element === undefined || element === null) {
        element = $("body");
    }
    // show loading
    element.block({
        message: text,
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        },
        overlayCSS: { backgroundColor: '' }
    });
}

// Hide loading indicator
let initHideLoadingIndicator = (element) => {
    if (element === undefined || element === null) {
        element = $("body");
    }
    // hide loading
    element.unblock();
}

// Disable/Enable Submit Button
let initDisableEnableSubmitButtonOld = (btn) => {
    if (btn.attr('disabled') === 'disabled' && btn.attr('data-kt-indicator') === 'on') {
        // set time interval for 1 second
        let interval = setInterval(() => {
            // remove the disabled attribute
            btn.attr('disabled', false);
            // remove the data-kt-indicator attribute
            btn.attr('data-kt-indicator', 'off');
            // remove the interval
            clearInterval(interval);
        }, 1000);
    } else {
        btn.attr('disabled', true);
        btn.attr('data-kt-indicator', 'on');
    }
}

// Disable/Enable Submit Button version 2
let initDisableEnableSubmitButton = (btn, disable = true) => {
    if (btn === undefined || btn === null) {
        btn = $('#btn-submit');
    }
    if (disable) {
        btn.attr('disabled', true);
        btn.attr('data-kt-indicator', 'on');
    }
    else {
        btn.attr('disabled', false);
        btn.attr('data-kt-indicator', 'off');
    }
}

// Show confirmation Sweet Alert with thenable
let initConfirmationAlert = (message = "Are you sure?", thenable) => {
    Swal.fire({
        title: message,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then((result) => {
        if (result.value) {
            thenable();
        }
    });
}

// Show confirmation Sweet Alert with thenable version 2
let initShowConfirmationDeleteAlert = (header, url, method, data, datable, then, formData = false, successAlert = true, toastr = false) => {
    if (then === undefined || then === null) {
        then = () => {};
    }
    if (header === undefined) {
        header = 'Item';
    }
    Swal.fire({
        title: 'Delete !',
        text: 'Are you sure want to delete this ' + header + ' ?',
        icon: 'warning',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            initAjaxRequest(url, method, data, datable, then, formData, successAlert, true, toastr);
        }
    });
}

// Show confirmation Sweet Alert with thenable version 2
let initShowConfirmationAlert = (message, url, method, data, datable, then, formData = false, successAlert = true, errorNoty = false, toastr = false, btn = null) => {
    if (then === undefined || then === null) {
        then = () => {};
    }
    if (message === undefined) {
        message = "Are you sure?";
    }
    Swal.fire({
        title: 'Warning !',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            initAjaxRequest(url, method, data, datable, then, formData, successAlert, errorNoty, toastr, btn);
        }
    });
}

// Global Ajax Request
let initAjaxRequest = (url, method, data, datable, then, formData = false, successNoty = true, errorNoty = true, toastr = false, btn = null) => {
    if (then === undefined) {
        then = () => {};
    }
    $.ajax({
        url: url,
        method: method,
        data: data,
        enctype: formData ? 'multipart/form-data' : '',
        processData: !formData,
        contentType: formData ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (response) {
            if (response.success) {
                if (successNoty) {
                    if (toastr === true) {
                        initShowToastrNotification("success", response.message);
                    }
                    else {
                        initSuccessAlert(response);
                    }
                }
                if(datable !== undefined && datable !== null){
                    datable.ajax.reload();
                }
            }
            else {
                if (errorNoty){
                    if (toastr === true) {
                        initShowToastrNotification("error", response.message);
                    }
                    else {
                        initErrorAlert(response);
                    }
                }
                else {
                    initErrorAlert(response);
                }
            }
        },
        error: function (response) {
            if (errorNoty) {
                let data = response.responseJSON;
                if (toastr === true) {
                    let errors = "";
                    if (data === undefined || data === null) {
                        errors = "An unknown errors has occurred. Please try again.";
                        initShowToastrNotification("error", errors);
                    }
                    else{
                        if (data.errors !== undefined) {
                            $.each(data.errors, function (key, value) {
                                initShowToastrNotification("error", value, true, 10000);
                            });
                        }
                        else {
                            initShowToastrNotification("error", data.message);
                        }
                    }
                }
                else {
                    initErrorAlert(data);
                }
            }
            else {
                // Remove all error messages
                $(".fv-plugins-message-container").remove();
                // Remove the is-invalid class
                $(".is-invalid").removeClass("is-invalid");
                // Show error message under each input
                let data = response.responseJSON;
                if (data !== undefined && data !== null) {
                    if (data.errors !== undefined) {
                        $.each(data.errors, function (key, value) {
                            let input = $('#' + key);
                            input.addClass('is-invalid')
                            // Check if each input has more than one error
                            if (Array.isArray(value)) {
                                // Show error message under each input
                                $.each(value, function (index, message) {
                                    // Create new element for error message
                                    let error = $('<div class="fv-plugins-message-container"><div class="fv-help-block">' + message + '</div></div>');
                                    // Check if input is select2
                                    if (input.hasClass('select2-hidden-accessible')) {
                                        // Insert error message after select2 container
                                        input.parent().append(error);
                                    }
                                    else {
                                        // Add error message to input
                                        input.after(error);
                                    }
                                });
                            }
                            else {
                                // Create new element for error message
                                let error = $('<div class="fv-plugins-message-container"><div class="fv-help-block">' + value + '</div></div>');
                                // Check if input is select2
                                if (input.hasClass('select2-hidden-accessible')) {
                                    // Add error message to select2 container
                                    input.next().after(error);
                                }
                                else {
                                    // Add error message to input
                                    input.after(error);
                                }
                            }
                        });
                    }
                    else {
                        initErrorAlert(data);
                    }
                }
            }
        },
        complete: function () {
            if (btn !== null) {
                initDisableEnableSubmitButton(btn, false);
            }
            // then;
        }
    }).then(then);

}

// Re-initialize the Menu after component re-rendering
let reInitializeMenu = () => {
    KTMenu.createInstances = function(selector = '[data-kt-menu="true"]') {
        // Initialize menus
        let elements = document.querySelectorAll(selector);
        if ( elements && elements.length > 0 ) {
            for (let i = 0, len = elements.length; i < len; i++) {
                new KTMenu(elements[i]);
            }
        }
    };
    KTMenu.init();
}

// Collapse/Expand filter card
let initFilterCard = function () {
    let btn = $("[data-btn-collapse-expand=\"filter\"]");
    let elements = $("[data-collapse-expand=\"filter\"]");
    btn.on("click", function () {
        // Check if the element are hidden visibility
        if (elements.hasClass("d-none")) {
            elements.removeClass("d-none");
            btn.addClass("active");
        } else {
            elements.addClass("d-none");
            btn.removeClass("active");
        }
    });
}

// Export Data to Excel
let initExportExcel = (url, data, btn = $('[data-btn-export]')) => {
    // Set on click listener and send post request
    btn.on('click', e => {
        initDisableEnableSubmitButton(btn);
        e.preventDefault();
        console.log(data);
        // Relocate to the end point
        window.location.href = url + '?' + $.param(data);
        initDisableEnableSubmitButton(btn);
    });
}

// Check if the element is empty
let initIsEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

// function to check if it has permission from the permission array
let hasPermission = (permission) => {
    let hasPermission = false;
    if (permission !== undefined && permission !== null) {
        if (Permissions.length > 0) {
            Permissions.forEach(element => {
                if (element === permission) {
                    hasPermission = true;
                    // Break the loop
                    return false;
                }
            });
        }
    }
    return hasPermission;
}

// Function to close the modal and reset the form
let initCloseModal = (btn, modal, form, options = null) => {
    if (btn === undefined || btn === null) {
        btn = modal.find('[data-close-modal-btn]');
    }
    btn.on('click', function () {
        modal.modal('hide');
        if (form !== undefined && form !== null) {
            form.trigger('reset');
            // Clear all values from the form
            form.find('input').each(function () {
                $(this).val('');
            });
            // if form has select2 elements
            form.find('[data-control="select2"]').each(function () {
                $(this).val(null).trigger('change');
            });
            // Reset the validation
            initClearValidation(form);
            // Additional options
            if (options != null) {
                options();
            }
        }
    });
}

// Convert number to currency format
let toMoney = (value) => {
    return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// Clear form
let initClearForm = (form) => {
    form.trigger('reset');
    // if form has select2 elements
    form.find('[data-control="select2"]').each(function () {
        $(this).val(-1000).trigger('change');
    });
    // Reset the validation
    initClearValidation(form);
}

// Clear Validation
let initClearValidation = (form) => {
    form.find('.invalid-feedback').each(function () {
        $(this).remove();
    });
}

// Get all elements value inside a div element with the name attribute
let initGetAllElementsValue = (element) => {
    let allValues = {};
    // Get all elements with no hidden attribute or class d-none
    let inputs = element.find('input')
    let selects = element.find('select');
    let textarea = element.find('textarea');
    inputs.each(function () {
        allValues[$(this).attr('name')] = $(this).val();
    });
    selects.each(function () {
        allValues[$(this).attr('name')] = $(this).val();
    });
    textarea.each(function () {
        allValues[$(this).attr('name')] = $(this).val();
    });
    return allValues;
}

// Convert Object to form data
let initObjectToFormData = (object) => {
    let formData = new FormData();
    for (let key in object) {
        formData.append(key, object[key]);
    }
    return formData;
}

// Init Global Validation Method
let initGlobalValidation = (form) => {
    // Remove all the errors messages
    initClearValidation(form);
    // Get all html elements inside the form
    let formElements = form.find('input, select, textarea');
    // Convert form from jQuery to native form
    form = form[0];
    // Initialize validation
    let validator = FormValidation.formValidation(form,
        {
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                }),
            }
        },
    );
    // Loop through all elements
    formElements.each(function(index, element) {
        // Check if the element is visible
        if ($(element).is(':visible')) {
            if ($(element).attr('type') !== 'checkbox') {
                // Check if the element is required
                if ($(element).attr('required') !== undefined && initIsEmpty($(element).val())) {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add required validator
                    validator.addField(elementName, {
                        validators: {
                            notEmpty: {
                                message: closestLabel.text() + ' is required'
                            }
                        }
                    });
                }
                // Check if type email
                if ($(element).attr('type') === 'email') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add email validator
                    validator.addField(elementName, {
                        validators: {
                            emailAddress: {
                                message: closestLabel.text() + ' is not valid email'
                            }
                        }
                    });
                }
                // Check if type number
                if ($(element).attr('type') === 'number') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add number validator
                    validator.addField(elementName, {
                        validators: {
                            numeric: {
                                message: closestLabel.text() + ' is not a number'
                            }
                        }
                    });
                }
                // Check if type date
                if ($(element).attr('type') === 'date') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add date validator
                    validator.addField(elementName, {
                        validators: {
                            date: {
                                message: closestLabel.text() + ' is not a date'
                            }
                        }
                    });
                }
                // Check if type time
                if ($(element).attr('type') === 'time') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add time validator
                    validator.addField(elementName, {
                        validators: {
                            time: {
                                message: closestLabel.text() + ' is not a time'
                            }
                        }
                    });
                }
                // Check if type date time
                if ($(element).attr('type') === 'datetime') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add date time validator
                    validator.addField(elementName, {
                        validators: {
                            date: {
                                message: closestLabel.text() + ' is not a date'
                            }
                        }
                    });
                }
                // Check if type url
                if ($(element).attr('type') === 'url') {
                    let elementName = $(element).attr('name');
                    let closestLabel = $(element).parent().find('label');
                    // Add url validator
                    validator.addField(elementName, {
                        validators: {
                            url: {
                                message: closestLabel.text() + ' is not a url'
                            }
                        }
                    });
                }
                // Check if type file
                if ($(element).attr('type') === 'file') {
                    // Get the accepted file types
                    let acceptedFileTypes = $(element).attr('accept');
                    if (!initIsEmpty(acceptedFileTypes)) {
                        let extensions = acceptedFileTypes.split(',');
                        let elementName = $(element).attr('name');
                        let closestLabel = $(element).parent().find('label');
                        // Add file validator
                        validator.addField(elementName, {
                            validators: {
                                file: {
                                    extension: extensions,
                                    message: closestLabel.text() + ' is not a valid file type (accepted file types: ' + acceptedFileTypes + ')'
                                }
                            }
                        });
                    }
                }
            }
        }
        else{
            // Get the name of the element
            let name = $(element).attr('name');
            // Get the validator fields
            let validatorFields = validator.getFields();
            // Check in the field is defined and exists in the validator fields
            if (name in validatorFields) {
                // Remove the field from the validator
                validator.removeField(name);
            }
        }
    });
    return validator;
}

// Add zero to the left of the number
let initAddZerosToNumber = (number, length = 5) => {
    let str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

// Method to check if variable is Guid
let initIsGuid = (guid) => {
    return /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(guid);
}

// Reload select 2
let initReloadSelect2 = (element) => {
    // Get the select2 element
    let selectElements = element.find('select.js-select2');
    // Check if the select element is a select2 element
    if (selectElements.length > 0 && selectElements.hasClass("select2-hidden-accessible")) {
        // Destroy the select2
        selectElements.select2('destroy');
    }
}

// Initialize select 2
let initDynamicSelect2 = () => {
    $('[data-control="select2"]').select2({
        tags: true,
    });
}

// Dynamic select 2 by data attribute
let initDynamicSelect2ByDataAttribute = () => {
    // Get all select 2 elements with data attribute (data-select2-dynamic)
    let select2Elements = $('select[data-select2-dynamic]');
    // Check if exists select 2 elements
    if (select2Elements.length > 0) {
        // Loop through the select 2 elements and initialize them with tags option
        select2Elements.each(function () {
            $(this).select2({
                tags: true,
            });
        });
    }
}

// Convert to money format
let initToMoneyFormat = (number) => {
    return number.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

// Initialize date picker with various options
let initDatePicker = () => {
    // Loop through all input elements
    let inputElements = $('input');
    $.each(inputElements, function (index, element) {
        // Check if the element is a datepicker
        if ($(element).hasClass('date-picker')) {
            // Initialize the datepicker
            $(element).flatpickr({
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
        // Check if the element is a datetimepicker
        if ($(element).hasClass('date-time-picker')) {
            // Initialize the datetimepicker
            $(element).flatpickr({
                enableTime: true,
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
        // Check if the element is a time-picker
        if ($(element).hasClass('time-picker')) {
            // Initialize the timepicker
            $(element).flatpickr({
                enableTime: true,
                noCalendar: true,
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
        // Check if the element is a month-picker
        if ($(element).hasClass('month-picker')) {
            // Initialize the monthpicker
            $(element).flatpickr({
                mode: "multiple",
                dateFormat: "m",
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
        // Check if the element is a year-picker
        if ($(element).hasClass('year-picker')) {
            // Initialize the yearpicker
            $(element).flatpickr({
                mode: "multiple",
                dateFormat: "Y",
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
        // Check if the element is a range datepicker
        if ($(element).hasClass('range-date-picker')) {
            // Initialize the range datepicker
            $(element).flatpickr({
                mode: "range",
                "locale": {
                    "firstDayOfWeek": 1
                },
                "setDate": new Date(),
            });
        }
    });

    // Get all button's with the attribute data-clear-date-picker
    let clearDatePickerButtons = $('button[data-clear-date-picker]');
    // Check if the button exists
    if (clearDatePickerButtons.length > 0) {
        // Loop through all the buttons and add click event
        $.each(clearDatePickerButtons, function (index, button) {
            // Get the closest input element with the class date-picker or date-time-picker or time-picker or month-picker or year-picker or range-date-picker
            let inputElement = $(button).closest('div').find('input.date-picker, input.date-time-picker, input.time-picker, input.month-picker, input.year-picker, input.range-date-picker');
            // Check if the input element exists
            if (inputElement.length > 0) {
                // Add click event to the button
                $(button).on('click', function () {
                    // Clear the input element
                    inputElement.val('');
                });
            }
        });
    }
}

// Init dateRangePicker
let initDateRangePicker = (input) => {
    let start = moment().subtract(29, "days");
    let end = moment();
    function cb(start, end) {
        input.html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    }
    input.daterangepicker({
        // startDate: start,
        // endDate: end,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
        }
    }, cb);

    input.on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    cb(start, end);

    // Get the closest button with the attribute data-clear-date-range-picker
    let clearDateRangePickerButton = input.closest('div').find('button[data-clear-date-range-picker]');
    // Check if the button exists
    if (clearDateRangePickerButton.length > 0) {
        // Add click event to the button
        clearDateRangePickerButton.on('click', function () {
            // Clear the input element
            input.val('');
            // Clear the date range picker
            input.data('daterangepicker').setStartDate(moment().subtract(29, "days"));
        });
    }
}

// Initialize money format
let initMoneyFormat = (number) => {
    // Check if the number is not null
    if (number != null) {
        let numberString = number.toString();
        numberString = numberString.replace(/,/g, '');
        numberString = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return numberString;
    }
    return number;
}

// Reverse money format
let reverseMoneyFormat = (number) => {
    let numberString = number.toString();
    numberString = numberString.replace(/,/g, '');
    // Convert to number
    return Number(numberString);
}

// Initialize the chart with the given data
let initAddDataToChart = (chart, labels, data, color) => {
    chart.data.labels = labels;
    chart.data.datasets = [{
        data: data,
        backgroundColor: color,
    }];
    chart.update();
}

// Remove data from the chart
let initRemoveDataFromChart = (chart) => {
    chart.data.labels = [];
    chart.data.datasets = [];
    chart.update();
}

// Remove the element with class "fv-plugins-message-container" when any modal is closed
$('.modal').on('hidden.bs.modal', function () {
    $('.fv-plugins-message-container').remove();
    $(".is-invalid").removeClass("is-invalid");
});

$(document).ready(() => {
    initDatePicker();
});
