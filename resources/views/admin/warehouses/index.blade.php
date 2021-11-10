@extends('layouts.main')

@section('title')
    WareHouse | warehouses
@endsection
@section('header')
    <h1 class="m-0">Warehouses management</h1>
@endsection
@section('style')
    @toastr_css
@endsection
@section('content')
    <div class="warehouse-page">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>No.</th>
                <th>Warehouse</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouses as $warehouse)
                <tr data-id="{{$warehouse->id}}">
                    <td>{{ ($warehouses ->currentpage()-1) * $warehouses ->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{$activeOptions[$warehouse->is_active]}}</td>
                    <td>
                        @if($warehouse->is_active == config('common.active'))
                            <a href="{{route('warehouse.change-status', ['id' => $warehouse->id])}}" onclick="return confirm('Are you sure you want to disable this warehouse?');" type="button" class="btn btn-danger">Disable</a>
                        @else
                            <a href="{{route('warehouse.change-status', ['id' => $warehouse->id])}}" onclick="return confirm('Are you sure you want to active this warehouse?');" type="button" class="btn btn-info">Active</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $warehouses->links() !!}


    </div>
@endsection

@section('script')
    @toastr_js
    @toastr_render
    <script>
    </script>
@endsection
