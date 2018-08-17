<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', $currentUser->name)
@section('currentNavItem', 'profile')

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1><i class="fas fa-user-cog"></i> {{ __('Profile') }}</h1>
    <p class="space-children">
		<a href="{{ route('profile.edit') }}">{{ __('Edit profile') }}</a>
		@auth
			<a class="nav__link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> {{ __('Log out') }}</a>
		@endauth
	</p>

	<p>
		{{ __('Name') }}: {{ $currentUser->name }}
		<br />{{ __('Email') }}: {{ $currentUser->email }}
		<br />{{ __('Birthday') }}: {{ $currentUser->birthday }}
		<br />{{ __('User since') }}: {{ $currentUser->created_at->format('Y-m-d') }}
	</p>
@endsection

@section('sidebar.left')
@endsection
