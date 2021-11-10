let $brandPage = $('.brand-page');
let $tableBrands = $('#tableBrands');
let $modalForm = $brandPage.find('#brand-form');
let $brandId = $modalForm.find('#brand_id');
let $brandName = $modalForm.find('#name');
let $brandDescription = $modalForm.find('#description');
let $imageInput = $modalForm.find('#image');
let $imageContainer = $modalForm.find('.image-container');

$(document).ready(function () {
    $imageInput.on('change', BrandClass.showImage);
    $brandPage.on('click', '#createNew', BrandClass.create);
    $brandPage.on('click', '.btn-edit', BrandClass.edit);
    $brandPage.on('click', '.btn-save', BrandClass.store);
    $brandPage.on('click', '.btn-update', BrandClass.update);
    $brandPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        BrandClass.getPage(page)
    })
});

let BrandClass = {

    create: function() {
        BrandClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditBrand.replace(':id', id);
        let callApiToGetBrand =  BrandClass.getBrandById(url, id);
        callApiToGetBrand.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.brand) {
                let brand = response.brand;
                BrandClass.fillFormData(brand);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = BrandClass.getFormData();
        let callApiToStore = callApiWithFile(urlStoreBrand, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableBrands.html(response.view)
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
        let dataInput = BrandClass.getFormData();
        let callApiToStore = callApi(urlUpdateBrand, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableBrands.html(response.view)
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

    fillFormData: function (brand = {}) {
        $(".error-message").text('');
        $imageInput.val('');
        $brandName.val(brand['name'] || '');
        $brandDescription.val(brand['description' || '']);
        $brandId.val(brand['id'] || '');
        if (brand['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
            $imageContainer.html(`<img src="${flagsUrl}${brand['image']}" alt="">`)
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
            $imageContainer.html(`<img src="${urlImageDefault}" alt="">`)
        }
    },
    getFormData: function () {
        return {
            id: $brandId.val(),
            _token: _token,
            name: $brandName.val(),
            description: $brandDescription.val(),
            image: $imageContainer.find('img').attr('src') || '',
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableBrands.html(response.view)
        })
    },
    getBrandById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },
    showImage: function () {
        ImageHelper.showImage($imageInput, $imageContainer);
    },
}


