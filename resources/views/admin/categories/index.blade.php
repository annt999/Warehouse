@extends('layouts.main')

@section('title')
    WareHouse | Category
@endsection
@section('header')
    <h1 class="m-0">Categories management</h1>
@endsection
@section('style')
@endsection

@section('content')
    <div class="category-page">
        <div id="category-form-wrap">
            @include('admin.categories.form')
        </div>
        <div id="tableCategories">
            @include('admin.categories.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexCategory = '{!! route('category.index') !!}';
        var urlStoreCategory = '{!! route('category.store') !!}';
        var urlUpdateCategory = '{!! route('category.update') !!}';
        var urlEditCategory = '{!! route('category.edit', ['id' => ':id']) !!}';

        var levelChild = '{!! config('common.category_level.child') !!}'
        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
