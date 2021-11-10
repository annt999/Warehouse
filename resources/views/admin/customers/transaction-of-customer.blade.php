@extends('layouts.main')

@section('title')
    WareHouse | Orders
@endsection
@section('header')
    <h1 class="m-0">Customer management</h1>
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
        <div id="table-sale-history">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Order code</th>
                    <th>Number of items</th>
                    <th>Total</th>
                    <th>Created by</th>
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
                        <td>{{$sale_invoice->debt_money}}</td>
                        <td>{{$sale_invoice->created_at}}</td>
                        <td>
                            <a type="button" href="{{route('order.sale.detail', ['id' => $sale_invoice->order_id])}}" class="btn btn-info"><i class="fas fa-info"></i></a>
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
                        $('#table-sale-history').html(data);
                    }
                });
            }
        })
    </script>
@endsection
