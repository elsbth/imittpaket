<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Changelog'))
@section('currentNavItem', route('changelog'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1><i class="fas fa-code"></i> {{ __('Changelog') }}</h1>

	<p style="font-style: italic">Re-building the site from scratch with Laravel to make it easier to maintain the code. Read all about the changes released to the site in this changelog.</p>

	<h2>0.1.0 <span class="h6">2018-08-XX</span></h2>
	<p>
		MVP (minimum viable product) release. Features include creating lists, creating items and adding them to lists. All lists are public.</p>

@endsection


@section('sidebar.left')
@endsection