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
	<p><strong>2008</strong>
		<br />Idea pops up and the first version is up by Christmas. Only one user and one list.</p>
	<p><strong>2010</strong>
		<br />As the last project of the Web developer education, elsbth takes it up a notch.</p>
	<p><strong>2018</strong>
		<br />elsbth started from scratch to build a better site that is easier to maintain and extend.</p>

@endsection


@section('sidebar.left')
@endsection