@extends('layouts.main')

@section('title')
    WareHouse | Orders
@endsection
@section('header')
    <h1 class="m-0">Import history</h1>
@endsection
@section('style')
@endsection

@section('content')
    <div class="import-product-page">
        <div id="table-import-history">
            <a href="{{route('order.import.create')}}" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
                <i class="fas fa-plus"></i>
                <span style="color: white">Add new</span>
            </a>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Invoice code</th>
                    <th>Number of items</th>
                    <th>Total</th>
                    <th>Created by</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($import_invoices as $import_invoice)
                    <tr>
                        <td>{{ ($import_invoices ->currentpage()-1) * $import_invoices ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $import_invoice->code }}</td>
                        <td>{{$import_invoice->number_of_items}}</td>
                        <td class="money">{{$import_invoice->total}}</td>
                        <td>{{$import_invoice->created_by}}</td>
                        <td>{{$import_invoice->created_at}}</td>
                        <td>
                            <a type="button" href="{{route('order.import.detail', ['id' => $import_invoice->code])}}" class="btn btn-info"><i class="fas fa-info"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $import_invoices->links() !!}


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
                        $('#table-import-history').html(data);
                    }
                });
            }
        })
    </script>
@endsection
