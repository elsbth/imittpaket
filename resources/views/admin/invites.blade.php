<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Invites'))
@section('currentNavItem', route('admin.invites'))

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1><i class="fas fa-envelope"></i> {{ __('Invites') }}</h1>


	@if($currentInvite)
		<table>
			<tr>
				<td>{{ __('Registration link') }}</td>
				<td><a href="{{ route('register', $currentInvite->token) }}">{{ route('register', $currentInvite->token) }}</a></td>
			</tr>
			<tr>
				<td>{{ __('Name') }}</td>
				<td>{{ $currentInvite->name }}</td>
			</tr>
			<tr>
				<td>{{ __('Email') }}</td>
				<td>{{ $currentInvite->email }}</td>
			</tr>
			<tr>
				<td>{{ __('Created') }}</td>
				<td>{{ $currentInvite->created_at->format('Y-m-d') }}</td>
			</tr>
			<tr>
				<td>{{ __('Related user') }}</td>
				<td>
				@if ($currentInvite->accepted && $currentInvite->getRelatedUserHid())
					<a href="{{ route('admin.users.userid', $currentInvite->getRelatedUserHid()) }}">{{ __('Go to user') }}</a>
				@else
					-
				@endif
				</td>
			</tr>
		</table>

		<hr />

		<div class="space-children">
			<a href="{{ route('admin.invites') }}">&laquo; {{ __('Back to invites') }}</a>
			<a href="{{ route('admin.invite.delete', $currentInvite->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this invite') }}</a>
		</div>
	@else

		<h2>{{ __('Add invite') }}</h2>

		<form method="POST" action="{{ route('admin.invites.create') }}" class="form--narrow">
			@csrf

			<div class="form__field">
				<label for="name">{{ __('Name') }}</label>

				<input type="text"
					   id="name"
					   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
					   name="name"
					   value="{{ old('name') }}">
				@if ($errors->store->has('name'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<label for="email">{{ __('Email') }}</label>

				<input type="text"
					   id="email"
					   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
					   name="email"
					   value="{{ old('email') }}">
				@if ($errors->store->has('email'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('email') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<button type="submit" class="btn btn--primary">
					{{ __('Add invite') }}
				</button>
			</div>
		</form>

		<hr />

		<h2>{{ __('Invites') }}</h2>

		@if ($invites)

			<table>
				<tr>
					<th>{{ __('Name') }}</th>
					<th>{{ __('Email') }}</th>
					<th>{{ __('Accepted') }} ({{ config('app.timezone') }})</th>
					<th>{{ __('More') }}</th>
				</tr>
				@foreach($invites as $key => $invite)
					<tr>
						<td>
							@if ($invite->accepted && $invite->getRelatedUserHid())
								<a href="{{ route('admin.users.userid', $invite->getRelatedUserHid()) }}">
							@endif
							{{ $invite->name }}

							@if ($invite->accepted && $invite->getRelatedUserHid())
								</a>
							@endif
						</td>
						<td>{{ $invite->email }}</td>
						<td>{{ $invite->accepted ? $invite->accepted_at->format('Y-m-d H:i') : 'No' }}</td>
						<td>
							<a href="{{ route('admin.invites', $invite->hid()) }}">{{ __('View') }}</a>
						</td>
					</tr>
				@endforeach
			</table>
		@endif
	@endif


@endsection

@section('sidebar.left')

@endsection
