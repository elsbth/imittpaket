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

	<p>Re-building the site from scratch with Laravel started in 2018. Read all about the changes released to the site in this changelog.</p>

	<p><strong>2018-08-16</strong>
		<br />Added signup for those wanting early access.</p>

@endsection


@section('sidebar.left')
@endsection