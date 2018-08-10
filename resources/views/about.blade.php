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

	<p>Developed by elsbth after an idea by Wowbagger.</p>
	<ul>
		<li>2008 - Idea pops up and the first version is up by Christmas, only one user and list</li>
		<li>2010 - As the last project of the Webdeveloper education, elsbth takes it up a notch</li>
		<li>2018 - elsbth started from scratch to build a better site that is easier to maintain and extend</li>
	</ul>

@endsection


@section('sidebar.left')
@endsection