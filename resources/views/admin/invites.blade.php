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


	@if($currentInvite)
		<h1><i class="fas fa-envelope"></i> {{ __('Invite') }}</h1>

		<h2>{{ $currentInvite->name }}</h2>
		<p>
			{{ $currentInvite->email }}
		</p>
		<p>{{ __('Invite created') }}: {{ $currentInvite->created_at->format('Y-m-d') }}</p>

		@if ($currentInvite->accepted && $currentInvite->getRelatedUserHid())
			<p><i class="fas fa-check"></i> {{ __('Invite accepted') }} -
				<a href="{{ route('admin.users.userid', $currentInvite->getRelatedUserHid()) }}">{{ __('Go to user') }}</a>
			</p>
		@else
			<p><i class="fas fa-clock"></i> {{ __('Invite not accepted yet') }}
				<br /><span class="link--long">{{ __('Registration link') }}: <a href="{{ route('register', $currentInvite->token) }}">{{ route('register', $currentInvite->token) }}</a></span>
			</p>
		@endif

		<hr />

		<div class="space-children">
			<a href="{{ route('admin.invites') }}">&laquo; {{ __('Back to invites') }}</a>
			<a href="{{ route('admin.invite.delete', $currentInvite->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this invite') }}</a>
		</div>
	@else
		<h1><i class="fas fa-envelope"></i> {{ __('Invites') }}</h1>

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
			@foreach ($invites as $key => $invite)
				<div class="invite--card">
					<strong>{{ $invite->name }}</strong>
					- {{ $invite->email }}
					<br />

					@if ($invite->accepted && $invite->getRelatedUserHid())
						<i class="fas fa-check"></i> {{ __('Invite accepted') }} {{ $invite->accepted_at->format('Y-m-d H:i') }}
					@else
						<i class="fas fa-clock"></i> {{ __('Invite not accepted yet') }}
					@endif

					<p class="space-children">
						<a href="{{ route('admin.invites', $invite->hid()) }}">{{ __('View invite') }}</a>
						@if ($invite->accepted && $invite->getRelatedUserHid())
							<a href="{{ route('admin.users.userid', $invite->getRelatedUserHid()) }}">{{ __('View user') }}</a>
						@endif
					</p>
				</div>
			@endforeach
		@else
			<p>{{ __('No invites') }}</p>
		@endif
	@endif


@endsection

@section('sidebar.left')

@endsection
