@extends('layouts.main')

@section('title')
    WareHouse | Locations
@endsection
@section('header')
    <h1 class="m-0">Locations management</h1>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('css/location.css')}}">
@endsection

@section('content')
    <div class="location-page">
        @include('admin.locations.form')
        <div id="tableLocations">
            @include('admin.locations.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexLocation = '{!! route('location.index') !!}';
        var urlStoreLocation = '{!! route('location.store') !!}';
        var urlUpdateLocation = '{!! route('location.update') !!}';
        var urlEditLocation = '{!! route('location.edit', ['id' => ':id']) !!}';

        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/location.js') }}"></script>
@endsection
