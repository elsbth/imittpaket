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
    [ LOCALE: {{ App::getLocale() }} ]
    <h1>{{ __(':name, this is your profile', ['name' => $currentUser->name]) }}</h1>
    <p><a href="{{ route('profile.edit') }}">{{ __('Edit profile') }}</a></p>
    <table>
    	<tr>
    		<td>{{ __('Name') }}</td>
    		<td>{{ $currentUser->name }}</td>
    	</tr>
    	<tr>
    		<td>{{ __('Email') }}</td>
    		<td>{{ $currentUser->email }}</td>
    	</tr>
    	<tr>
    		<td>{{ __('Birthday') }}</td>
    		<td>{{ $currentUser->birthday }}</td>
    	</tr>
    	<tr>
    		<td>{{ __('Member since') }}</td>
    		<td>{{ $currentUser->created_at->format('Y-m-d') }}</td>
    	</tr>
    </table>
@endsection

@section('sidebar.left')
@endsection
