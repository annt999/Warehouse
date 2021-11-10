@extends('layouts.main')

@section('title')
    WareHouse | Order
@endsection
@section('header')
    <h1 class="m-0">Sale</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #sale-product-page{
            display: flex;
            justify-content: space-between;
        }
        th, td, i {
            font-size: 14px;
        }

        .index, .action {
            width: 30px;
        }

        .code {
            width: 150px;
        }

        .image-product{
            width: 100px;
        }

        .quantity {
            width: 200px;
        }

        .sale_price, .total {
            width: 150px;
        }
        table td {
            vertical-align: middle !important;
        }
        #sale_left {
            width: 65%;
            min-height: 80vh;
            background-color: #ffffff;
            padding: 10px;
            border-right: 5px #c5edec solid;
        }
        #sale_right {
            width: 33%;
            min-height: 80vh;
            background-color: #ffffff;
            padding: 10px;
            border-right: 5px #c5edec solid;
        }

        .table-sale-product {
            margin: 0;
        }
        .btn-complete-sale{
            float: right;
            margin-top: 100px;
            margin-right: 20px;
        }
        td.money{
            padding-left: 25px;
        }
    </style>
@endsection

@section('content')
    <div id="sale-product-page">
        <div id="sale_left">
            <div class="input-group mb-3">
                <input id="search-sale-product" type="text" class="form-control input-group" placeholder="Product name or code">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" disabled>Search</button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th class="index">#</th>
                    <th class="code">Product Code</th>
                    <th class="name">Product Name</th>
                    <th class="sale_price">Sale price</th>
                    <th class="quantity">Quantity</th>
                    <th class="total">Total</th>
                    <th class="action"></th>

                </tr>
                </thead>
                <tbody id="sale-product-content">

                </tbody>
            </table>
        </div>
        <div id="sale_right" style="background-color: #ffffff">
            <table class="table table-sale-product">
                <tr>
                    <th></th>
                    <td class="current_date" style="float: right; background-color: #c0e4eaad"></td>
                </tr>
                <tr>
                    <th>Customer:</th>
                    <td>
                        <div>
                            <div>
                                <span class="title-customer">Customer: </span>
                                <span id="customer-name"></span>
                            </div>
                            <div>
                                <span class="title-customer">Phone:</span>
                                <span id="customer-phone"></span>
                            </div>
                            <input hidden id="customer_id">
                        </div>
                        <input type="text" class="form-control" placeholder="Phone or name" id="search-customer">
                        <p id="customer_error" hidden style="color: red">Please choose a customer</p>
                    </td>
                </tr>
                <tr>
                    <th>Total amount:</th>
                    <td class="money" id="total_money_products">0</td>
                </tr>
                <tr>
                    <th>Discount:</th>
                    <td>
                        <input disabled class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>Other costs:</th>
                    <td>
                        <input disabled class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>Customer need to pay</th>
                    <td class="money" id="need-pay">0</td>
                </tr>
                <tr>
                    <th>Customer pay</th>
                    <td>
                        <input class="form-control money price" id="customer_pay" value="0">
                        <p id="customer_pay_error" hidden style="color: red">Please </p>
                    </td>
                </tr>
                <tr>
                    <th>Excess cash</th>
                    <td class="money" id="excess-cash">0</td>
                </tr>
                <tr>
                    <th>Customer debt</th>
                    <td class="money" id="customer-debt">0</td>
                </tr>
            </table>
            <div class="btn-complete-sale">
                <button id="complete_sale_btn" type="button" class="btn btn-info">Complete</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var path = "{{ url('product/search') }}";
        var pathSearchCustomer = "{{ url('customer/search') }}";
        var pathSale = "{{url('/order/sale-product')}}";
        var pathSaleHistory = "{{url('/order/sale')}}"
        var items = [];
        var total = 0;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/input_number.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/order.js') }}"></script>

@endsection

