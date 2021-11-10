let $supplierPage = $('.supplier-page');
let $tableSuppliers = $('#tableSuppliers');
let $modalForm = $supplierPage.find('#supplier-form');
let $supplierId = $modalForm.find('#supplier_id');
let $supplierName = $modalForm.find('#name');
let $supplierDescription = $modalForm.find('#description');
let $supplierPhone = $modalForm.find('#supplier_phone');

$(document).ready(function () {
    $supplierPage.on('click', '#createNew', SupplierClass.create);
    $supplierPage.on('click', '.btn-edit', SupplierClass.edit);
    $supplierPage.on('click', '.btn-save', SupplierClass.store);
    $supplierPage.on('click', '.btn-update', SupplierClass.update);
    $supplierPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        SupplierClass.getPage(page)
    })
});

let SupplierClass = {

    create: function() {
        SupplierClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditSupplier.replace(':id', id);
        let callApiToGetSupplier =  SupplierClass.getSupplierById(url, id);
        callApiToGetSupplier.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.supplier) {
                let supplier = response.supplier;
                SupplierClass.fillFormData(supplier);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = SupplierClass.getFormData();
        let callApiToStore = callApi(urlStoreSupplier, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableSuppliers.html(response.view)
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
        let dataInput = SupplierClass.getFormData();
        let callApiToStore = callApi(urlUpdateSupplier, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableSuppliers.html(response.view)
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

    fillFormData: function (supplier = {}) {
        $(".error-message").text('');
        $supplierName.val(supplier['name'] || '');
        $supplierDescription.val(supplier['description' || '']);
        $supplierPhone.val(supplier['phone'] || '');
        $supplierId.val(supplier['id'] || '');
        if (supplier['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
        }
    },
    getFormData: function () {
        return {
            id: $supplierId.val(),
            _token: _token,
            name: $supplierName.val(),
            phone: $supplierPhone.val(),
            description: $supplierDescription.val(),
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableSuppliers.html(response.view)
        })
    },
    getSupplierById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },
}


