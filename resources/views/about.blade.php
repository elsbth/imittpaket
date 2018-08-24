<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('About'))
@section('currentNavItem', route('about'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1>{{ __('About') }}</h1>

	<p class="space-children">
		<a href="{{ route('cookies') }}">{{ __('Cookies') }}</a>
		<a href="{{ route('changelog') }}">{{ __('Changelog') }}</a>
		<a href="{{ route('terms') }}">{{ __('Terms and Conditions') }}</a>
	</p>

	<p>Developed by elsbth after an idea by Wowbagger <i class="fas fa-heart" style="color: #c09"></i></p>
	<p><strong>2008</strong>
		<br />Idea pops up and the first version is up by Christmas. Only one user and one list.</p>
	<p><strong>2010</strong>
		<br />As the final project of the Web developer program, elsbth takes it up a notch.</p>
	<p><strong>2018</strong>
		<br />elsbth started from scratch with a new platform to build a better version of the site.</p>

@endsection


@section('sidebar.left')
@endsection