<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('404'))
@section('currentNavItem', '')

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1><i class="fas fa-exclamation-triangle"></i> {{ __('404') }}</h1>

	<p style="font-style: italic">{{ __('This is not the page you\'re looking for...') }}</p>
	<p>{{ __('Try our') }} <a href="{{ route('faq') }}">{{ __('FAQ') }}</a> {{ __('or head over to the') }} <a href="{{ route('home') }}">{{ __('startpage') }}</a>. </p>

@endsection


@section('sidebar.left')
@endsection