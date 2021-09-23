@extends('layouts.main')

@section('title')
    WareHouse | Brands
@endsection
@section('header')
    <h1 class="m-0">Brands management</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('css/brand.css')}}">
@endsection

@section('content')
    <div class="brand-page">
        @include('admin.brands.form')
        <div id="tableBrands">
            @include('admin.brands.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexBrand = '{!! route('brand.index') !!}';
        var urlStoreBrand = '{!! route('brand.store') !!}';
        var urlUpdateBrand = '{!! route('brand.update') !!}';
        var urlEditBrand = '{!! route('brand.edit', ['id' => ':id']) !!}';
        var flagsUrl = '{!! URL::asset(Storage::url('images')) !!}' + '/';
        var urlImageDefault ='{!! URL::asset(Storage::url('images/2GEmUl.jpg')) !!}';
        var urlImageBase = `{!! config('common.urlImageBase') !!}`;
        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/brand.js') }}"></script>
@endsection
