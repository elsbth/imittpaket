<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Cookies'))
@section('currentNavItem', route('about'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1><i class="fas fa-code"></i> {{ __('Cookies') }}</h1>

	<p style="font-style: italic">This site uses cookies.</p>

	<h2 class="h5">Laravel</h2>
	<ul>
		<li>laravel_session</li>
		<li>XSRF-TOKEN</li>
	</ul>

	<h2 class="h5">Google Analytics</h2>
	<ul>
		<li>_ga</li>
		<li>_gid</li>
		<li>_gat_gtag_UA_19382374_1</li>
	</ul>

	<h2 class="h5">Custom cookies</h2>
	<ul>
		<li>laravel_cookie_consent - Cookie to track if cookies have been accepted</li>
	</ul>

@endsection


@section('sidebar.left')
@endsection