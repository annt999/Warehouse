
let $productPage = $('.product-page');
let $tableProducts = $('#tableProducts');
let $modalForm = $productPage.find('#product-form');
let $modalDetail = $productPage.find('#product-detail');
let $modalSearch = $productPage.find('#product-search-form');
let $productExport = $productPage.find('#exportProduct');
let $imageInput = $modalForm.find('#image');
let $imageContainer = $modalForm.find('.image-container');
let $productId = $modalForm.find('#product_id');
let $productName = $modalForm.find('#name');
let $productDescription = $modalForm.find('#description');
let $productLocation = $modalForm.find('#location_id');
let $productBrand = $modalForm.find('#brand_id')
let $productCategory = $modalForm.find('#category_id');
let $productSalePrice = $modalForm.find('#sale_price');
let $productStatus = $modalForm.find('#status');
let $productCategoryFather = $modalForm.find(('#category_father'));


$(document).ready(function () {
    $imageInput.on('change', ProductClass.showImage);
    $productPage.on('click', '#createNew', ProductClass.create);
    $productPage.on('click', '.btn-edit', ProductClass.edit);
    $productPage.on('click', '.btn-detail', ProductClass.show);
    $productPage.on('click', '#search', function (e) {
        // $modalSearch.find('form').trigger('reset');
        $modalSearch.addClass('show').modal('show');
    })
    $productPage.on('change', '#tableProducts', function () {
        $('.money').simpleMoneyFormat();
    })

    $productPage.on('click', '.btn-save', ProductClass.store);
    $productPage.on('click', '.btn-update', ProductClass.update);
    $productPage.on('click', '.btn-search', ProductClass.search);
    $productPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        ProductClass.getPage(page)
    });
    $productPage.on('click', '#exportProduct', function (e) {
        href = $(location).attr("search");
        urlExport = href;
        positionPage = href.search('page');
        if (positionPage >= 0) {
            urlExport = urlExport.slice(0, positionPage - 1);
        }
        urlExport = urlExportProduct + urlExport;
        $(this).attr('href', urlExport);
    })
    $('#category_father').on('change', function(){
        var father_selected =  $('select[id="category_father"]').val();
        $('#category_id').empty();
        var child_options = categoryDividedByFather[father_selected];
        $('#category_id').append(`<option value=""></option>`);
        for (i = 0; i < child_options.length; i++) {
            $('#category_id').append(`<option value="${child_options[i].id}">${child_options[i].name}</option>`);
        }
    });
    $('#category_father_id').on('change', function(){
        var father_selected =  $('select[id="category_father_id"]').val();
        $('#category_child_id').empty();
        var child_options = categoryDividedByFather[father_selected];
        $('#category_child_id').append(`<option value=""></option>`);
        for (i = 0; i < child_options.length; i++) {
            $('#category_child_id').append(`<option value="${child_options[i].id}">${child_options[i].name}</option>`);
        }
    });
});

let ProductClass = {
    search: function (e) {
        e.preventDefault();
        dataSearch = ProductClass.getFormSearch();
        url = urlIndexProduct ;
        for (const [key, value] of Object.entries(dataSearch)) {
            if (value || value === 0) {
                if (url.includes('?')) {
                    url += '&' + key + '=' + value;
                } else {
                    url += '?' + key + '=' + value;
                }

            }
        }

        history.pushState({}, "", url);
        callApiToSearch = callApi(url, 'get', {});
        callApiToSearch.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            $tableProducts.html(response.view)
            $modalSearch.modal('hide');
            $('.money').simpleMoneyFormat();
            return ;
        })
    },
    getFormSearch: function () {
        return {
            name : $modalSearch.find('#name').val(),
            porduct_code: $modalSearch.find('#product_code').val(),
            category_father_id: $modalSearch.find('#category_father_id').val(),
            category_child_id: $modalSearch.find('#category_child_id').val(),
            brand_id: $modalSearch.find('#brand_id').val(),
            quantity_inventory_max: $modalSearch.find('#quantity_inventory_max').val(),
            quantity_inventory_min: $modalSearch.find('#quantity_inventory_min').val(),
            status: $modalSearch.find('#status').val()
        }
    },

    create: function() {
        ProductClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlGetProductById.replace(':id', id);
        let callApiToGetProduct = callApi(url, 'get', []);
        callApiToGetProduct.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.product) {
                let product = response.product;
                ProductClass.fillFormData(product);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('');
        let dataInput = ProductClass.getFormData();
        let callApiToStore = callApiWithFile(urlStoreProduct, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableProducts.html(response.view)
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
        $('.money').simpleMoneyFormat();
    },
    show: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlGetProductById.replace(':id', id);
        let callApiToGetProduct = callApi(url, 'get', []);
        callApiToGetProduct.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.product) {
                let product = response.product;
                $modalDetail.find('.image').attr('src', `${baseImageUrl}/${product['image']}`);
                $modalDetail.find('.name').text(product['name']);
                $modalDetail.find('.product_code').text(product['product_code']);
                $modalDetail.find('.sale_price').text(product['sale_price']);
                $modalDetail.find('.description').text(product['description']);
                $modalDetail.find('.brand').text(product['brand_name']);
                $modalDetail.find('.location').text(product['location_name']);
                $modalDetail.find('.category').text(product['category_name']);
                $modalDetail.find(product['status'] === AVAILABLE ? '.available' : (product['status'] === UNAVAILABLE ? 'unavailable' : 'suspended')).prop('checked', true);
                $modalDetail.addClass('show').modal('show');
            }
        })
    },

    update: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = ProductClass.getFormData();
        let callApiToStore = callApiWithFile(urlUpdateProduct, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableProducts.html(response.view)
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
        $('.money').simpleMoneyFormat();
    },

    fillFormData: function (product = {}) {
        $(".error-message").text('');
        $imageInput.val('');
        $productName.val(product['name'] || '');
        $productDescription.val(product['description' || '']);
        $productId.val(product['id'] || '');
        $productStatus.val(product['status'] || AVAILABLE);
        $productBrand.val(product['brand_id'] || '');
        $productCategoryFather.val(product['parent_id'] || '');
        $productCategory.val(product['category_id' || '']);
        $productLocation.val(product['location_id'] || '');
        $productSalePrice.val(product['sale_price'] || '');

        if (product['id']) {
            var father_selected =  $('select[id="category_father"]').val();
            $('#category_id').empty();
            var child_options = categoryDividedByFather[father_selected];
            $('#category_id').append(`<option value=""></option>`);
            for (i = 0; i < child_options.length; i++) {
                $('#category_id').append(`<option value="${child_options[i].id}">${child_options[i].name}</option>`);
            }
            $productCategory.val(product['category_id']);

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
            location_id: $productLocation.val(),
            brand_id: $productBrand.val(),
            category_id: $productCategory.val(),
            sale_price: $productSalePrice.val().replace(/,/g, ''),
            status: $productStatus.val(),

        }
    },
    getPage: function (page) {
        href = $(location).attr("href");
        url = href;
        positionPage = href.search('page');
        if (positionPage >= 0) {
            url = url.slice(0, positionPage - 1);
        }
        if (url.includes('?')) {

            url += '&page=' + page;
        } else {
            url += '?page=' + page;
        }
        $.ajax({
            type: "GET",
            url: url
        }).done(function (response) {
            history.pushState(null, null, url);
            $tableProducts.html(response.view)
        })
    },
    showImage: function () {
        ImageHelper.showImage($imageInput, $imageContainer);
    },

}


