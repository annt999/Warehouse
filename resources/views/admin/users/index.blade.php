@extends('layouts.main')

@section('title')
    WareHouse | Users
@endsection
@section('header')
    <h1 class="m-0">Users management</h1>
@endsection

@section('content')
    <div class="user-page">
        @include('admin.users.detail')
        @include('admin.users.form')
        <div id="tableUsers">
            @include('admin.users.table')
        </div>
    </div>
@endsection

@section('script')
    <script>
        var urlIndexUser = '{!! route('user.index') !!}'
        var urlStoreUser = '{!! route('user.store') !!}';
        var urlUpdateUser = '{!! route('user.update') !!}';
        var urlEditUser = '{!! route('user.edit', ['id' => ':id']) !!}';
        var urlDetailUser = '{!! route('user.show', ['id' => ':id']) !!}';
        var active = {!! config('common.active') !!};
        var not_active = {!! config('common.not_active') !!};

        var lblSave = '{!! __('view.save') !!}';
        var lblUpdate = '{!! __('view.update') !!}';
        var lblCreate = '{!! __('view.create_new') !!}';
        var lblEdit = '{!! __('view.edit') !!}';
        var recordsPerPage = {!! config('common.records_per_page') !!}
    </script>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
