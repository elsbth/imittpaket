<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Welcome'))
@section('currentNavItem', '/')

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Welcome!') }}</h1>
@endsection

@section('sidebar.left')
    [ LEFT ]
@endsection
