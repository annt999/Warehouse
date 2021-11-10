@extends('layouts.main')

@section('title')
    WareHouse | Orders
@endsection
@section('header')
    <h1 class="m-0">Orders management</h1>
@endsection
@section('style')
    <style>
        .warning-text {
            color: #007bffbf !important;
            font-size: 13px
        }
        .error-text {
            color: red !important;
            font-size: 13px        }
    </style>
@endsection

@section('content')
    <div class="sale-product-page">
        @include('admin.orders.pay-model')
        <div id="table-sale-history">
            <a href="{{route('order.sale.create')}}" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
                <i class="fas fa-plus"></i>
                <span style="color: white">Add new</span>
            </a>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Order code</th>
                    <th>Number of items</th>
                    <th>Total</th>
                    <th>Created by</th>
                    <th>Customer</th>
                    <th>Debt money</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sale_invoices as $sale_invoice)
                    <tr>
                        <td>{{ ($sale_invoices ->currentpage()-1) * $sale_invoices ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $sale_invoice->code }}</td>
                        <td>{{$sale_invoice->number_of_items}}</td>
                        <td class="money">{{$sale_invoice->total}}</td>
                        <td>{{$sale_invoice->created_by}}</td>
                        <td>{{$sale_invoice->customer_name}}</td>
                        <td class="money">{{$sale_invoice->debt_money}}</td>
                        <td>{{$sale_invoice->created_at}}</td>
                        <td>
                            <a type="button" href="{{route('order.sale.detail', ['id' => $sale_invoice->order_id])}}" class="btn btn-info"><i class="fas fa-info"></i></a>
                            @if($sale_invoice->debt_money > 0)
                                <button type="button" class="btn btn-success btn-payment" data-id="{{$sale_invoice->order_id}}" ><i class="fas fa-money-check-alt"></i></button>
                            @else
                                <button type="button" class="btn btn-success btn-payment" data-id="{{$sale_invoice->order_id}}" disabled ><i class="fas fa-money-check-alt"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $sale_invoices->links() !!}


        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>
    <script type="text/javascript">
        var urlGetOrderById = '{!! route('order.edit', ['id' => ':id']) !!}';
        var urlStorePayment = '{!! route('order.sale.payment') !!}';
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
                        $('#table-sale-history').html(data);
                    }
                });
            }
        })
    </script>
@endsection
