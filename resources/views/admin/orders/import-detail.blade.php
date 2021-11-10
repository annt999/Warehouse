@extends('layouts.main')

@section('title')
    WareHouse | Orders
@endsection
@section('header')
    <h1 class="m-0">Import management</h1>
@endsection
@section('style')
@endsection

@section('content')
    <div class="import-product-page">
        <div id="table-import-detail">
            <h3>Import code : {{$import_history_code}}</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Product code</th>
                    <th>Purchase price</th>
                    <th>Sale price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($import_details as $import_detail)
                    <tr>
                        <td>{{ ($import_details ->currentpage()-1) * $import_details ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $import_detail->product_code }}</td>
                        <td class="money">{{$import_detail->purchase_price}}</td>
                        <td class="money">{{$import_detail->sale_price}}</td>
                        <td>{{$import_detail->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $import_details->links() !!}
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
                        $('#table-import-detail').html(data);
                    }
                });
            }
        })
    </script>
@endsection
