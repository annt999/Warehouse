@extends('layouts.main')

@section('title')
    WareHouse | customers
@endsection
@section('header')
    <h1 class="m-0">customers management</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('libs/datepicker/bootstrap-datepicker.min.css')}}">
@endsection

@section('content')
    <div class="customer-page">
        @include('admin.customers.form')
        <div id="tableCustomers">
            @include('admin.customers.table')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('libs/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        var urlIndexCustomer = '{!! route('customer.index') !!}';
        var urlStoreCustomer = '{!! route('customer.store') !!}';
        var urlUpdateCustomer = '{!! route('customer.update') !!}';
        var urlEditCustomer = '{!! route('customer.edit', ['id' => ':id']) !!}';

        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/customer.js') }}"></script>
@endsection
