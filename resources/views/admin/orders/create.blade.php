@extends('layouts.main')

@section('title')
    WareHouse | Order
@endsection
@section('header')
    <h1 class="m-0">Create order</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <style>
        .product-item{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            align-content: center;
            height: 60px;
        }
        .quantity-item{
            width: 60px;
            margin: 0;
        }
        .id-item{
            width: 30px;
            margin: 0;
        }
        .delete-item{
            color: red;
            width: 30px;
            margin: 0;
        }
        .code-item, .name-item{
            width: 150px;
            margin: 0;
        }
        .price-item, .total-item{
            width: 115px;
            margin: 0;
        }
        .title-invoice-item{
            width: 40%;margin-bottom:30px
        }
        .content-invoice-item{
            width: 40%;margin-bottom:30px; border-bottom: 1px gray solid
        }
        .invoice-item{
            height: auto; width: 100%; padding: 15px; display: flex; flex-wrap: wrap
        }
        .title-customer{
            font-weight: bold;
        }
        .customer-search-item{
            height: 60px;
        }
        .customer-search-item p{
            margin: 0;
            padding: 0;
        }
        .search-customer-result-text{
            margin-bottom: 0 !important;
            font-size: 13px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" style="">
            <div class="order-left" id="order-left" style="width: 57%; min-height: 80vh; background-color: #a0d0e2; margin-right: 30px">
                <div class="input-search" style="display: flex; flex-direction: row;justify-content: space-between; padding: 20px;">
                    <span>Search</span>
                    <input type="text" id="product" class="input-group form-control" style="width: 75%">

                </div>
                <div class="result-search">
                </div>
            </div>
            <div class="order-right" style="width: 37%; min-height: 80vh; background-color: #a0d0e2">
                <div class="title-invoice" style="width: 100%; padding: 30px; display: flex;">
                    <div style="width: 50%">
                        <h3 style="color: black">Invoice</h3>
                        <p id="date"></p>
                    </div>
                    <div style="width: 50%">
                        <div>
                            <div>
                                <span class="title-customer">Customer: </span>
                                <span id="customer-name"></span>
                            </div>
                            <div>
                                <span class="title-customer">Phone:</span>
                                <span id="customer-phone"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Phone or name" id="search-customer">
                    </div>
                </div>

                <div class="invoice-item">
                    <div class="title-invoice-item">
                        <span>Tổng tiền hàng</span>
                    </div>
                    <div class="content-invoice-item">
                        <span id="total-invoice" class="money"></span>
                    </div>
                    <div class="title-invoice-item">
                        <span>Giảm giá</span>
                    </div>
                    <div class="content-invoice-item">
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="title-invoice-item">
                        <span>Thu khác</span>
                    </div>
                    <div class="content-invoice-item">
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="title-invoice-item">
                        <span>Khách cần trả</span>
                    </div>
                    <div class="content-invoice-item">
                        <span id="need-pay" class="money"></span>
                    </div>
                    <div class="title-invoice-item">
                        <span>Khách trả</span>
                    </div>
                    <div class="content-invoice-item">
                        <input type="text" class="form-control money" id="customer-pay">
                    </div>
                    <div class="title-invoice-item">
                        <span>Tiền thừa</span>
                    </div>
                    <div class="content-invoice-item">
                        <span id="excess-cash" class="money">0</span>
                    </div>
                    <div class="title-invoice-item">
                        <span>Tiền khách nợ</span>
                    </div>
                    <div class="content-invoice-item">
                        <span id="customer-debt" class="money">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/order.js') }}"></script>
    <script type="text/javascript">
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var path = "{{ url('product/search') }}";
        var pathSearchCustomer = "{{ url('customer/search') }}";
        var items = [];
        var total = 0;
    </script>
@endsection

