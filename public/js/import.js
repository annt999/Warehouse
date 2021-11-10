$(document).ready(function () {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
    $('.current_date').text(today);
    $('#supplier').select2({
        placeholder: "Select a supplier",
        allowClear: true,
        ajax: {
            url: pathListSuppliers,
            dataType: 'json',
            type: "GET",
            data: function (params) {
                return {
                    query: params.query
                };
            },
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        },
        })

    $('#search-import-product').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: path,
                data: {
                    query: request.term
                },
                dataType: "json",
                success: function (data) {
                    var products = [];
                    data.forEach((element) => {
                        if (typeof items[element.product_code] === "undefined") {
                            products.push(element);
                        }
                    })
                    response(products);
                }
            });
        },
        select: function (event, ui) {
            items[ui.item.product_code] = ui.item;
            var productItem = `<tr>
                <td class="id-product"></td>
                <td class="code-product">${ui.item.product_code}</td>
                <td>${ui.item.name}</td>
                <td>
                    <input type="text" class="purchase_price_input form-control money price" value="0">
                </td>
                <td>
                    <input type="text" class="sale_price_input form-control money price" value="0">
                </td>
                <td>
                    <div style="display: flex">
                        <button type="button" class="btn btn-dark btn-number" data-type="minus">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" name="quantity" class="quantity-input form-control" value="1" max="999">
                        <button type="button" class="btn btn-info btn-number" data-type="plus">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </td>
                <td class="total_of_product money">0</td>
                <td>
                    <button class="btn btn-danger delete-product"><i class="fas fa-times"></i></button>
                </td>
            </tr>`;
            $('#import-product-content').append(productItem)
            setIndex();
            calculateInvoice()
        },
        response: function(event, ui) {
            if (!ui.content.length) {
                var noResult = {
                    label: 'No results found'
                };
                ui.content.push(noResult);
            }
        }
    }).autocomplete("instance")._renderItem = function (ul, element) {
        if (element.label) {
            return $("<li>").append(`<div style="height: 50px; font-size: 13px">${element.label}</div>`).appendTo(ul)
        }
        var item = $(`<div style="display: flex; flex-direction: row; justify-content: space-around; height: 100px">
                             <img style="width: 90px; height: 90px" src="${flagsUrl}${element.image}">
                              <div style="width: 300px">
                                 <strong style="font-size: 14px">${element.name}</strong>
                                 <p style="font-size: 13px">${(element.sale_price).toLocaleString()}</p>
                                 <p style="font-size: 13px">${element.product_code}</p>
                             </div>
                         </div>`)
        return $("<li>").append(item).appendTo(ul);
    };

    $(document).on('click', '.delete-product', function () {
        if (confirm('Are you sure?')) {
            var productItemRemove = $(this).parent().parent().find('.code-product').text();

            delete items[productItemRemove];
            $(this).parent().parent().remove();
            setIndex();
            calculateInvoice();

        }
    })
    $(document).on('change', '.quantity-input', function () {
        let quantity = $(this).val();
        if ($(this).val() < 1) {
            $(this).val(1);
        }
        let purchase_price = $(this).parent().parent().parent().find('.purchase_price_input').val();
        let total = quantity*parseFloat((purchase_price.replace(/,/g, '')));
        $(this).parent().parent().parent().find('.total_of_product').text(total);
        $('.money').simpleMoneyFormat();
        calculateInvoice();
    })

    $(document).on('change', '#supplier', function () {
        supplierId = $(this).val();
    })
    $(document).on('input propertychange', '.sale_price_input', function () {
        $('.money').simpleMoneyFormat();
    })

    $(document).on('input propertychange', '.purchase_price_input', function () {
        let purchase_price= $(this).val();
        let quantity = $(this).parent().parent().find('.quantity-input').val();
        let total = quantity*parseFloat((purchase_price.replace(/,/g, '')));
        $(this).parent().parent().find('.total_of_product').text(total);
        $('.money').simpleMoneyFormat();
        calculateInvoice()
    })
    $(document).on('keypress keyup blur', '.price', function (event) {
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    })

    $(document).on('click', '#complete_import_btn', function () {
         Swal.fire({
                title: "Import product",
                icon: 'warning',
                text: "Are you sure to complete the import?",
                showCancelButton: true,
                confirmButtonColor: '#55ddc9',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
            }).then((result) => {
             if (result.isConfirmed) {
                 let $productsImport = $('.code-product');
                 let products = [];
                 let total = 0;
                 let supplier_id = $('#supplier').val();
                 if (supplier_id == 0){
                     $('#supplier_error').removeAttr('hidden');
                     return;
                 }
                 products = [];
                 $productsImport.map((index, element) => {
                     parseFloat($(element).text().replace(/,/g, ''))
                     let purchase_price = parseFloat(($(element).parent().find('.purchase_price_input').val()).replace(/,/g, ''));
                     let quantity = $(element).parent().find('.quantity-input').val();
                     let product = {
                         product_code: $(element).text(),
                         purchase_price: purchase_price,
                         sale_price: $(element).parent().find('.sale_price_input').val(),
                         quantity: quantity,
                     };
                     products.push(product);
                     total = total + purchase_price*quantity;
                 })

                 let dataImport = {
                     _token: _token,
                     products: JSON.stringify(products),
                     supplier_id: supplier_id,
                     total: total,
                 }
                 let importProducts = callApi(pathImport, 'post', dataImport);
                 importProducts.done(function(response){
                     if (response.error) {
                         return swalError(response.error);
                     }
                     return swalSuccess('Products import successfully!').then(() => {
                         window.location.href = pathImportHistory;
                     });
                 }).fail(function (reject) {
                     return swalError('An error has occurred');
                 })
             }
         });
    })
});

function calculateInvoice() {
    var totalInvoice = 0;
    var $totalItems = $('.total_of_product');
    $totalItems.map((index, element) => {
        totalInvoice = totalInvoice + parseFloat($(element).text().replace(/,/g, ''));
    })
    $('#money_be_paid').text(totalInvoice);
    $('#total_money_products').text(totalInvoice);
    $('.money').simpleMoneyFormat();
}

function setIndex() {
    var i = 0;
    $('.id-product').each(function () {
        i++;
        $(this).text(i);
    });
}

