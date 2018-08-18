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

	<div class="dashboard-links__wrapper">
		<a href="{{ route('admin.invites') }}" class="dashboard-link">
			<i class="fas fa-envelope dashboard-link__icon"></i>
			<span class="dashboard-link__label">{{ __('Invites') }}</span>
		</a>
		<a href="{{ route('admin.users') }}" class="dashboard-link">
			<i class="fas fa-users dashboard-link__icon"></i>
			<span class="dashboard-link__label">{{ __('Users') }}</span>
		</a>
		<a href="{{ route('admin.faq') }}" class="dashboard-link">
			<i class="fas fa-life-ring dashboard-link__icon"></i>
			<span class="dashboard-link__label">{{ __('FAQ') }}</span>
		</a>
	</div>
@endsection

@section('sidebar.left')
@endsection
