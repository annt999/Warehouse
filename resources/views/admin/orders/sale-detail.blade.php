@extends('layouts.main')

@section('title')
    WareHouse | Orders
@endsection
@section('header')
    <h1 class="m-0">Orders management</h1>
@endsection
@section('style')
    <style>
        .img-table-container {
            width: 9rem;
            height: 5rem;
        }
        .order_code_text{
            float: right;
            font-size: 15px;
            padding: 20px 0 5px;
            color: #247a8b;
        }
    </style>
@endsection

@section('content')
    <div class="sale-product-page">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="active nav-link" href="#order-detail" aria-controls="order-detail" role="tab" data-toggle="tab">Order detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#payment-detail" aria-controls="payment-detail" role="tab" data-toggle="tab">Payment detail</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="order-detail">
                <div id="table-sale-detail">
                    <h3 class="order_code_text">Order code : {{$order_code}}</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product code</th>
                            <th>Image</th>
                            <th>Sale price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sale_details as $sale_detail)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $sale_detail->product_code }}</td>
                                <td>
                                    <div class="img-table-container">
                                        <img src="{{asset(Storage::url('images/'.$sale_detail->image)) }}" alt="">
                                    </div>
                                </td>
                                <td class="money">{{$sale_detail->sale_price}}</td>
                                <td>{{$sale_detail->quantity}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="payment-detail">
                <div id="table-payment-detail">
                    <h3 class="order_code_text">Order code : {{$order_code}}</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Payment money</th>
                            <th>Created by</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payment_details as $payment_detail)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td class="money">{{ $payment_detail->payment_money }}</td>
                                <td >{{$payment_detail->created_by}}</td>
                                <td>{{$payment_detail->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.money').simpleMoneyFormat();
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page)
            {
                $.ajax({
                    url:"?page="+page,
                    success:function(data)
                    {
                        $('#table-sale-detail').html(data);
                    }
                });
            }
        })
    </script>
@endsection
