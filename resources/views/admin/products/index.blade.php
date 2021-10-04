@extends('layouts.main')

@section('title')
    WareHouse | Products
@endsection
@section('header')
    <h1 class="m-0">Products management</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
@endsection

@section('content')
    <div class="product-page">
        @include('admin.products.form')
        <div id="tableProducts">
            @include('admin.products.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexProduct = '{!! route('product.index') !!}';
        var urlStoreProduct = '{!! route('product.store') !!}';
        var urlUpdateProduct = '{!! route('product.update') !!}';
        var urlEditProduct= '{!! route('product.edit', ['id' => ':id']) !!}';
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var urlImageDefault ='{!! URL::asset(Storage::url('images/2GEmUl.jpg')) !!}';
        var urlImageBase = `{!! config('common.urlImageBase') !!}`;
        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
