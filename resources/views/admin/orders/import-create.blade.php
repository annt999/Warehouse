@extends('layouts.main')

@section('title')
    WareHouse | Order
@endsection
@section('header')
    <h1 class="m-0">Import product</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #import-product-page{
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

        .purchase_price, .sale_price, .total {
            width: 150px;
        }
        table td {
            vertical-align: middle !important;
        }
        #import_left {
            width: 65%;
            min-height: 80vh;
            background-color: #ffffff;
            padding: 10px;
            border-right: 5px #c5edec solid;
        }
        #import_right {
            width: 33%;
            min-height: 80vh;
            background-color: #ffffff;
            padding: 10px;
            border-right: 5px #c5edec solid;
        }

        .table-import-product {
            margin: 0;
        }
        .btn-complete-import{
            position: absolute;
            right: 70px;
            bottom: 90px;
        }
    </style>
@endsection

@section('content')
    <div id="import-product-page">
        <div id="import_left">
            <div class="input-group mb-3">
                <input id="search-import-product" type="text" class="form-control input-group" placeholder="Product name or code">
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
                    <th class="purchase_price">Purchase price</th>
                    <th class="sale_price">Sale price</th>
                    <th class="quantity">Quantity</th>
                    <th class="total">Total</th>
                    <th class="action"></th>

                </tr>
                </thead>
                <tbody id="import-product-content">

                </tbody>
            </table>
        </div>
        <div id="import_right" style="background-color: #ffffff">
            <table class="table table-import-product">
                <tr>
                    <th></th>
                    <td class="current_date" style="float: right; background-color: #c0e4eaad"></td>
                </tr>
                <tr>
                    <th>Supplier:</th>
                    <td>
                        <select id="supplier" class="form-control">
                            <option value='0'>- Select supplier -</option>
                        </select>
                        <p id="supplier_error" hidden style="color: red">Please choose a supplier</p>
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
                    <th>Need to pay supplier:</th>
                    <td class="money" id="money_be_paid">0</td>
                </tr>
            </table>
            <div class="btn-complete-import">
                <button id="complete_import_btn" type="button" class="btn btn-info">Complete</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var path = "{{ url('product/search') }}";
        var pathSearchCustomer = "{{ url('customer/search') }}";
        var pathListSuppliers = '{{ url('/supplier/list') }}';
        var pathImport = "{{url('/order/import-product')}}";
        var pathImportHistory = "{{url('/order/import')}}"
        console.log(pathImport)
        var items = [];
        var total = 0;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/input_number.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/import.js') }}"></script>

@endsection

