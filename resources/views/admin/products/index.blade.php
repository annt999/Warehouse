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
        @include('admin.products.form-search')
        @include('admin.products.form')
        <div id="tableProducts">
            @include('admin.products.table')
        </div>
        @include('admin.products.detail')
    </div>
@endsection

@section('script')
    <script>
        var AVAILABLE = {!! config('common.product_status.available') !!};
        var UNAVAILABLE = {!! config('common.product_status.unavailable') !!};
        var SUSPENDED = {!! config('common.product_status.suspended') !!};

        var categoryDividedByFather = {!! $categoryDividedByFather !!};
        var urlIndexProduct = '{!! route('product.index') !!}';
        var urlStoreProduct = '{!! route('product.store') !!}';
        var urlUpdateProduct = '{!! route('product.update') !!}';
        var urlExportProduct = '{!! route('product.export') !!}';
        var urlGetProductById= '{!! route('product.get', ['id' => ':id']) !!}';
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
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript">
        $('.money').simpleMoneyFormat();
    </script>
@endsection
