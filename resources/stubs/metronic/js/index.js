"use strict";

let {{names}}Table = $('#{{name}}_modal');
let {{names}}Datatable;

let {{names}}Modal = $('#{{name}}_modal');
let {{names}}Form = {{names}}Modal.find('form');

let save{{Name}}Attributes = {
    url: route('{{names}}.store'),
    _method: 'POST'
}

// {{Name}} datatable
let init{{Name}}Datatable = () =>
{
    let url  = route('{{names}}.index');
    let columns = [];
    {{names}}Datatable = initDataTable("GET", {{names}}Table, {{names}}Datatable, url, null, columns, null, null);
    if ({{names}}Datatable) {
        {{names}}Datatable.on('draw', function () {
            initRemove{{Name}}();
            initShowEdit{{Name}}Modal();
        });
    }
}

// Add {{name}}
let initAdd{{Name}} = () => {
    let add{{Name}}Btn = {{names}}Form.find('button[type="submit"]');
    add{{Name}}Btn.on('click', function (e) {
        e.preventDefault();
        initDisableEnableSubmitButton(add{{Name}}Btn, true);
        let formData = new FormData({{names}}Form[0]);
        let then = (response) => {
            initDisableEnableSubmitButton({{names}}Form, false);
            if (response.success) {
                // Reset the form
                {{names}}Form[0].reset();
                // Reset the savePublisherUrl
                save{{Name}}Attributes.url = route('{{names}}.store');
                save{{Name}}Attributes._method = 'POST';
                // Hide the modal
                {{names}}Modal.modal('hide');
            }
        }
        initAjaxRequest(save{{Name}}Attributes.url, "POST", formData, {{names}}Datatable, then, true, true, false, true, add{{Name}}Btn);
    });
}

// Show Edit {{Name}} Modal
let initShowEdit{{Name}}Modal = () => {
    let editBtn = {{names}}Table.find('.edit-btn');
    editBtn.on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = route('{{names}}.edit', id);
        let then = (response) => {
            if (response.success) {
                // Fill the form with the data

                // Change the savePublisherUrl to update url
                save{{Name}}Attributes.url = route('{{names}}.update', response.data.id);
                save{{Name}}Attributes._method = 'PUT';
                {{names}}Modal.modal('show');
            }
        }
        initAjaxRequest(url, 'GET', null, null, then, true, false);
    });
}

// Remove {{name}}
let initRemove{{Name}} = () => {
    let deleteBtn = {{names}}Table.find('.delete-btn');
    deleteBtn.on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = route('{{names}}.destroy', id);
        initShowConfirmationAlert("", url, 'DELETE', null, {{names}}Datatable, null, false, true, true, true);
    });
}

// When we open the modal for creating a new {{name}} we need to reset the form
let initResetAdd{{Name}}Form = () => {
    {{names}}Form[0].reset();
    // Change the url's to store url
    save{{Name}}Attributes.url = route('{{names}}.store');
    save{{Name}}Attributes._method = 'POST';
}


$(document).ready(function () {
    // Init {{names}} datatable
    init{{Name}}Datatable();
    // handle search
    handleSearchDatatable({{names}}Datatable);
    // Add {{name}}
    initAdd{{Name}}();
    // Reset Add {{name}} Form
    initCloseModal(null, {{names}}Modal, {{names}}Form);
});
