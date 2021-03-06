<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Users'))
@section('currentNavItem', route('admin.users'))

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')


	@if($user)
		<h1><i class="fas fa-users"></i> {{ __('User: :name', ['name' => $user->name]) }}</h1>
		<table>
			<tr>
				<td>{{ __('Id') }}</td>
				<td>{{ $user->hid() }}</td>
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
			<tr>
				<td>{{ __('Permission') }}</td>
				<td>{{ $user->permission }}</td>
			</tr>

			@if ($user->invite())
				<tr>
					<td>{{ __('Invite') }}</td>
					<td><a href="{{ route('admin.invites', $user->invite()) }}">{{ __('Go to invite') }}</a></td>
				</tr>
			@endif
		</table>

		<hr />

		<div class="space-children">
			<a href="{{ route('admin.users') }}">&laquo; {{ __('Back to users') }}</a>
		</div>
	@else
		<h1><i class="fas fa-users"></i> {{ __('Users') }}</h1>

		<p>{{ __('* admin user') }}</p>
		@foreach($users as $key => $user)
			<p>
				<a href="/admin/users/{{$user->hid()}}">{{$user->name}}</a> {{ ($user->permission == 'admin') ? '*' : '' }}
				- {{ $user->email }}
				<br />User since {{ $user->created_at->format('Y-m-d') }}. {{ $user->lists->count() }} lists, {{ $user->items->count() }} items
			</p>
		@endforeach
	@endif


@endsection

@section('sidebar.left')
@endsection
