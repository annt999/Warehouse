let $productPage = $('.product-page');
let $tableProducts = $('#tableProducts');
let $modalForm = $productPage.find('#product-form');
let $productId = $modalForm.find('#product_id');
let $productName = $modalForm.find('#name');
let $productDescription = $modalForm.find('#description');
let $imageInput = $modalForm.find('#image');
let $imageContainer = $modalForm.find('.image-container');
let $productLocation = $modalForm.find('.location_id');
let $productBrand = $modalForm.find('.brand_id')
let $productCategory = $modalForm.find('.category_id');

$(document).ready(function () {
    $imageInput.on('change', ProductClass.showImage);
    $productPage.on('click', '#createNew', ProductClass.create);
    $productPage.on('click', '.btn-edit', ProductClass.edit);
    $productPage.on('click', '.btn-save', ProductClass.store);
    $productPage.on('click', '.btn-update', ProductClass.update);
    $productPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        ProductClass.getPage(page)
    })
});

let ProductClass = {

    create: function() {
        ProductClass.fillFormData();
        $modalForm.modal('show');
    },

    // edit: function () {
    //     let id = $(this).closest('tr').attr('data-id');
    //     let url = urlEditproduct.replace(':id', id);
    //     let callApiToGetProduct =  ProductClass.getProductById(url, id);
    //     callApiToGetproduct.done(function (response) {
    //         if (response.error) {
    //             return swalError(response.error)
    //         }
    //         if (response.product) {
    //             let product = response.product;
    //             ProductClass.fillFormData(product);
    //             $modalForm.modal('show');
    //         }
    //     })
    // },
    // store: function (e) {
    //     e.preventDefault();
    //     $(".error-message").text('')
    //     let dataInput = ProductClass.getFormData();
    //     let callApiToStore = callApiWithFile(urlStoreProduct, 'post', dataInput);
    //     callApiToStore.done(function(response){
    //         if (response.error) {
    //             return swalError(response.error)
    //         }
    //         return swalSuccess(response.success).then(() => {
    //             $tableProducts.html(response.view)
    //             $modalForm.modal('hide');
    //         })
    //     }).fail(function (reject) {
    //         if (reject.status === 422) {
    //             var errors = $.parseJSON(reject.responseText).errors;
    //             $.each(errors, function (key, val) {
    //                 $("#" + key + "_error").text(val[0]).removeClass('d-none');
    //             });
    //         }
    //     })
    // },
    // update: function (e) {
    //     e.preventDefault();
    //     $(".error-message").text('')
    //     let dataInput = ProductClass.getFormData();
    //     let callApiToStore = callApi(urlUpdateProduct, 'patch', dataInput);
    //     callApiToStore.done(function(response){
    //         if (response.error)
    //         {
    //             return swalError(response.error)
    //         }
    //         if (response.success) {
    //             return swalSuccess(response.success).then(() => {
    //                 $tableProducts.html(response.view)
    //                 $modalForm.modal('hide');
    //             })
    //         }
    //     }).fail(function (reject) {
    //         $(".error-message").text('');
    //         if (reject.status === 422) {
    //             var errors = $.parseJSON(reject.responseText).errors;
    //             $.each(errors, function (key, val) {
    //                 $("#" + key + "_error").text(val[0]).removeClass('d-none');
    //             });
    //         }
    //     })
    //
    // },

    fillFormData: function (product = {}) {
        $(".error-message").text('');
        $imageInput.val('');
        $productCode.val(product['product_code'] || '');
        $productName.val(product['name'] || '');
        $productDescription.val(product['description' || '']);
        $productId.val(product['id'] || '');
        if (product['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
            $imageContainer.html(`<img src="${flagsUrl}${product['image']}" alt="">`)
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
            $imageContainer.html(`<img src="${urlImageDefault}" alt="">`)
        }
    },
    getFormData: function () {
        return {
            id: $productId.val(),
            _token: _token,
            name: $productName.val(),
            description: $productDescription.val(),
            image: $imageContainer.find('img').attr('src') || '',
            location: $locationProduct
        }
    },
    // getPage: function (page) {
    //     $.ajax({
    //         type: "GET",
    //         url: '?page='+ page
    //     }).done(function (response) {
    //         history.pushState(null, null, '?page=' + page);
    //         $tableProducts.html(response.view)
    //     })
    // },
    // getProductById: function (url, id) {
    //     return  $.ajax({
    //         type: "GET",
    //         url: url,
    //     })
    // },
    showImage: function () {
        ImageHelper.showImage($imageInput, $imageContainer);
    },
}


