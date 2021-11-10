$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
});
let $customerPage = $('.customer-page');
let $tableCustomers = $('#tableCustomers');
let $modalForm = $customerPage.find('#customer-form');
let $customerId = $modalForm.find('#customer_id');
let $customerName = $modalForm.find('#name');
let $customerPhone = $modalForm.find('#phone');
let $customerEmail = $modalForm.find('#email');
let $customerAddress = $modalForm.find('#address');
let $customerGender = $modalForm.find('#gender');
let $customerBirthday = $modalForm.find('#birthday');

$(document).ready(function () {
    $customerPage.on('click', '#createNew', CustomerClass.create);
    $customerPage.on('click', '.btn-edit', CustomerClass.edit);
    $customerPage.on('click', '.btn-save', CustomerClass.store);
    $customerPage.on('click', '.btn-update', CustomerClass.update);
    $customerPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        CustomerClass.getPage(page)
    })
});

let CustomerClass = {

    create: function() {
        CustomerClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditCustomer.replace(':id', id);
        let callApiToGetCustomer =  CustomerClass.getCustomerById(url, id);
        callApiToGetCustomer.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.customer) {
                let customer = response.customer;
                CustomerClass.fillFormData(customer);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = CustomerClass.getFormData();
        let callApiToStore = callApi(urlStoreCustomer, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableCustomers.html(response.view)
                $modalForm.modal('hide');
            })
        }).fail(function (reject) {
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                $.each(errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]).removeClass('d-none');
                });
            }
        })
    },
    update: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = CustomerClass.getFormData();
        let callApiToStore = callApi(urlUpdateCustomer, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableCustomers.html(response.view)
                    $modalForm.modal('hide');
                })
            }
        }).fail(function (reject) {
            $(".error-message").text('');
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                $.each(errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]).removeClass('d-none');
                });
            }
        })

    },

    fillFormData: function (customer = {}) {
        $(".error-message").text('');
        $customerName.val(customer['name'] || '');
        $customerPhone.val(customer['phone_number' || '']);
        $customerEmail.val(customer['email' || '']);
        $customerGender.val(customer['gender' || '']);
        $customerAddress.val(customer['address' || '']);
        $customerBirthday.val(customer['birthday' || '']);
        $customerId.val(customer['id'] || '');
        if (customer['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
        }
    },
    getFormData: function () {
        return {
            _token: _token,
            id: $customerId.val(),
            name: $customerName.val(),
            phone_number: $customerPhone.val(),
            email: $customerEmail.val(),
            gender: $customerGender.val(),
            birthday: $customerBirthday.val(),
            address: $customerAddress.val(),
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableCustomers.html(response.view)
        })
    },
    getCustomerById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },
}


