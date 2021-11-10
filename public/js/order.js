$(document).ready(function () {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
    $('.current_date').text(today);

    $('#search-sale-product').autocomplete({
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
            if (ui.item.quantity_inventory === 0) {
                return false;
            }
            items[ui.item.product_code] = ui.item;
            var productItem = `<tr>
                <input hidden value="${ui.item.id}" class="product_id">
                <td class="id-product"></td>
                <td class="code-product">${ui.item.product_code}</td>
                <td>${ui.item.name}</td>
                <td>
                    <input type="text" class="sale_price_input form-control money price" value="${ui.item.sale_price}" disabled>
                </td>
                <td>
                    <div style="display: flex">
                        <button type="button" class="btn btn-dark btn-number" data-type="minus">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" name="quantity" class="quantity-input form-control" value="1" max="${ui.item.quantity_inventory}">
                        <button type="button" class="btn btn-info btn-number" data-type="plus">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </td>
                <td class="total_of_product money">${ui.item.sale_price}</td>
                <td>
                    <button class="btn btn-danger delete-product"><i class="fas fa-times"></i></button>
                </td>
            </tr>`;
            $('#sale-product-content').append(productItem)
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
        let quantityElement = ``;
        if (element.quantity_inventory !== 0){
            quantityElement = `<p style="font-size: 13px; padding: 0; margin: 0">Inventory number: ${element.quantity_inventory}</p>`
        } else {
            quantityElement = `<p style="font-size: 13px; padding: 0; margin: 0; color: red">Hết hàng</p>`
        }

        var item = $(`<div style="display: flex; flex-direction: row; justify-content: space-around; height: 100px">
                             <img style="width: 90px; height: 90px" src="${flagsUrl}${element.image}">
                              <div style="width: 300px">
                                 <strong style="font-size: 14px; padding: 0; margin: 0">${element.name}</strong>
                                 <p style="font-size: 13px; padding: 0; margin: 0">Sale price: ${(element.sale_price).toLocaleString()}</p>`
            + quantityElement +
                                 `<p style="font-size: 13px; padding: 0; margin: 0">${element.product_code}</p>
                             </div>
                         </div>`)
        if (element.quantity_inventory === 0){
            return $("<li class=\"ui-state-disabled\">").append(item).appendTo(ul);
        } else {
            return $("<li>").append(item).appendTo(ul);
        }
    };

    $('#search-customer').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: pathSearchCustomer,
                data: {
                    query: request.term
                },
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $('#customer-name').text(ui.item.name);
            $('#customer-phone').text(ui.item.phone_number);
            $('#customer_id').val(ui.item.id);
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
        var item = $(`<div style="border-bottom: 1px gray solid"><p class="search-customer-result-text" style="font-size: 13px; padding: 0; margin: 0">${element.name}</p><p class="search-customer-result-text" style="font-size: 13px; padding: 0; margin: 0"">${element.phone_number}</p></div>`)
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
    $(document).on('keydown','.quantity-input', function (e) {
        let keyCodePrevent = [187, 189, 107, 109]
        if (keyCodePrevent.includes(e.which)) {
            e.preventDefault();
        }
    })
    $(document).on('change', '.quantity-input', function () {
        let quantity = $(this).val();
        if ($(this).val() < 1) {
            $(this).val(1);
        }
        let sale_price = $(this).parent().parent().parent().find('.sale_price_input').val();
        let total = quantity*parseFloat(sale_price.replace(/,/g, ''));
        $(this).parent().parent().parent().find('.total_of_product').text(total);
        $('.money').simpleMoneyFormat();
        calculateInvoice();
    })

    $(document).on('input propertychange', '#customer_pay', function () {
        var customerPay = parseFloat($(this).val().replace(/,/g, ''));
        if (isNaN(customerPay)) {
            customerPay = 0;
        }
        var excessCash = customerPay - parseFloat($('#need-pay').text().replace(/,/g, ''));
        if (excessCash >= 0) {
            $('#excess-cash').text(excessCash)
            $('#customer-debt').text(0);
        } else {
            $('#excess-cash').text(0);
            $('#customer-debt').text(-excessCash)
        }
        $('.money').simpleMoneyFormat();
    })


    $(document).on('keypress keyup blur', '.price', function (event) {
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    })
    $(document).on('click', '#complete_sale_btn', function () {
        Swal.fire({
            title: "Sale product",
            icon: 'warning',
            text: "Are you sure to complete?",
            showCancelButton: true,
            confirmButtonColor: '#55ddc9',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
        }).then((result) => {
            if (result.isConfirmed) {
                let $productsSale = $('.code-product');
                let products = [];
                let total = 0;
                let customer_pay = parseFloat($('#customer_pay').val().replace(/,/g, ''))
                let customer_id = $('#customer_id').val();
                if (!customer_id){
                    $('#customer_error').removeAttr('hidden');
                    return;
                } else {
                    $('#customer_error').attr('hidden');
                }
                products = [];
                $productsSale.map((index, element) => {
                    parseFloat($(element).text().replace(/,/g, ''))
                    let quantity = $(element).parent().find('.quantity-input').val();
                    let sale_price = parseFloat(($(element).parent().find('.sale_price_input').val()).replace(/,/g, ''));
                    let product = {
                        id: $(element).parent().find('.product_id').val(),
                        product_code: $(element).text(),
                        sale_price: sale_price,
                        quantity: quantity,
                    };
                    products.push(product);
                    total = total + sale_price*quantity;
                })
                let dataSale = {
                    _token: _token,
                    products: JSON.stringify(products),
                    customer_id: customer_id,
                    total: total,
                    customer_pay: customer_pay
                }
                let saleProducts = callApi(pathSale, 'post', dataSale);
                saleProducts.done(function(response){
                    if (response.error) {
                        return swalError(response.error);
                    }
                    return swalSuccess('Successfully!').then(() => {
                        window.location.href = pathSaleHistory;
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
    $('#need-pay').text(totalInvoice);
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

