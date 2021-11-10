@extends('layouts.main')

@section('title')
    WareHouse | suppliers
@endsection
@section('header')
    <h1 class="m-0">suppliers management</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('css/supplier.css')}}">
@endsection

@section('content')
    <div class="supplier-page">
        @include('admin.suppliers.form')
        <div id="tableSuppliers">
            @include('admin.suppliers.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexSupplier = '{!! route('supplier.index') !!}';
        var urlStoreSupplier = '{!! route('supplier.store') !!}';
        var urlUpdateSupplier = '{!! route('supplier.update') !!}';
        var urlEditSupplier = '{!! route('supplier.edit', ['id' => ':id']) !!}';
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var urlImageDefault ='{!! URL::asset(Storage::url('images/2GEmUl.jpg')) !!}';
        var urlImageBase = `{!! config('common.urlImageBase') !!}`;
        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/supplier.js') }}"></script>
@endsection
