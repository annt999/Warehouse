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
            font-size: 13px
        }
        .search{
            width: 100%;
            height: 150px;
            background-color: white;
            padding: 20px 10px;
        }
        .btn-search-transaction{
            float: right;
        }
    </style>
@endsection

@section('content')
    <div class="sale-product-page">
        <div class="search">
            <form action="{{route('customer.transaction')}}" method="get">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="Customer name or phone" value="{{  request()->input('customer', old('customer')) }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-search-transaction">Search</button>
            </form>
        </div>
        <div id="table-sale-history">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Customer</th>
                    <th>Total transaction</th>
                    <th>Total debt</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ ($transactions ->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $transaction->customer_name }}</td>
                        <td class="money">{{ $transaction->total_transaction}}</td>
                        <td class="money">{{$transaction->total_debt}}</td>
                        <td>
                            <a type="button" href="{{route('customer.transaction.detail', ['id' => $transaction->customer_id])}}" class="btn btn-info"><i class="fas fa-info"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $transactions->links() !!}


        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
@endsection
