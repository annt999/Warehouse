@extends('layouts.main')

@section('title')
    WareHouse | Reports
@endsection
@section('header')
    <h1 class="m-0">Sales report by products</h1>
@endsection
@section('style')
@endsection

@section('content')
    <div class="report-product-page" style="background-color: white; padding: 10px">
        <div class="report--product__search">
            <form action="{{route('report.product')}}" method="get">
                @csrf
                <div class="row" style="align-items: center; padding: 10px">
                    <div class="form-group col-2">
                        <label>Day</label>
                        <select class="form-control" name="day">
                            <option></option>
                            @for($i = 1; $i <= date("t"); $i++)
                                @if($i == request()->day)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @elseif($i == date("d") && empty(request()->all()))
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Month</label>
                        <select class="form-control" name="month">
                            <option></option>
                            @for($i = 1; $i <= 12; $i++)
                                @if($i == request()->month)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @elseif($i == date("m") && empty(request()->all()))
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Year</label>
                        <select class="form-control" name="year">
                            @for($i = date("Y"); $i >= (date("Y") - 5) ; $i--)
                                @if($i == request()->year)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @elseif($i == date("Y") && empty(request()->all()))
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-group btn-info">Search</button>
                    </div>
                </div>

            </form>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Product code</th>
                <th>Name</th>
                <th>Quantity sold</th>
                <th>Revenue</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity_sold }}</td>
                    <td class="money">{{ $product->total_revenue }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script>
        $('.money').simpleMoneyFormat();
    </script>
@endsection
