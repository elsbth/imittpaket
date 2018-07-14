<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Users'))
@section('currentNavItem', '/admin/users')

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Administrate: Users') }}</h1>


	@if($user)
		<table>
			<tr>
				<td>{{ __('Id') }}</td>
				<td>{{ $user->id }}</td>
			</tr>
			<tr>
				<td>{{ __('Name') }}</td>
				<td>{{ $user->name }}</td>
			</tr>
			<tr>
				<td>{{ __('Email') }}</td>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<td>{{ __('Birthday') }}</td>
				<td>{{ $user->birthday }}</td>
			</tr>
			<tr>
				<td>{{ __('Member since') }}</td>
				<td>{{ $user->created_at->format('Y-m-d') }}</td>
			</tr>
		</table>
	@endif


@endsection

@section('sidebar.left')
	<p>{{ __('Users:') }}</p>

	@if($user)
		<p><a href="/admin/users"><< {{ __('Back') }}</a> </p>
	@else
	<ul>
		@foreach($users as $key => $user)
			<li>
				<a href="/admin/users/{{$user->id}}">{{$user->name}}</a>
			</li>
		@endforeach
	</ul>
	@endif

@endsection
