<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin'))
@section('currentNavItem', '/admin')

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Administration') }}</h1>
@endsection

@section('sidebar.left')
    <ul>
    	<li>[ LINK 1 ]</li>
    	<li>[ LINK 2 ]</li>
    	<li>[ LINK 3 ]</li>
    </ul>
@endsection
