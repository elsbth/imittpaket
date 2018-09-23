<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Item Categories'))
@section('currentNavItem', route('admin.itemcategories'))

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')


	@if($currentCategory)
		<h1><i class="fas fa-tag"></i> {{ __('Item Category') }}</h1>
		<p>
			{{ __('Name:') }} <strong>{{ $currentCategory->name }}</strong>
			<br /> {{ __('Icon:') }} {{ $currentCategory->icon }}  <i class="fas fa-{{ $currentCategory->icon }}"></i>
		</p>

		<hr />

        <p style="font-style: italic"><strong>TODO:</strong> Prevent deleting categories that are currently assigned to items.</p>

		<div class="space-children">
			<a href="{{ route('admin.itemcategories') }}">&laquo; {{ __('Back to item categories') }}</a>
			<a href="{{ route('admin.itemcategory.delete', $currentCategory->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this item category') }}</a>
		</div>
	@else
		<h1><i class="fas fa-tag"></i> {{ __('Item categories') }}</h1>

		<h2>{{ __('Add item category') }}</h2>

		<form method="POST" action="{{ route('admin.itemcategories.create') }}" class="form--2-col">
			@csrf

			<div class="form__field">
				<label for="name">{{ __('Name') }}</label>

				<input type="text"
					   id="name"
					   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
					   name="name"
					   value="{{ old('name') }}"
					   autocomplete="off"
                       maxlength="50">
				@if ($errors->store->has('name'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<label for="icon">{{ __('Fontawesome Icon') }}</label>
				<span>(<a href="https://fontawesome.com/icons?d=gallery&m=free" rel="nofollow">{{ __('icon gallery') }}</a>)</span>


				<input type="text"
					   id="icon"
					   class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}"
					   name="icon"
					   value="{{ old('icon') }}"
					   autocomplete="off"
                       maxlength="50">
				@if ($errors->store->has('icon'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('icon') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<button type="submit" class="btn btn--primary">
					{{ __('Add item category') }}
				</button>
			</div>
		</form>

		<hr />

		<h2>{{ __('Item Categories') }}</h2>

		@if ($categories)
			@foreach ($categories as $key => $category)
				<p>
					<i class="fas fa-{{ $category->icon }}"></i> <strong>{{ $category->name }}</strong>
					- {{ $category->icon }}
					- <a href="{{ route('admin.itemcategory.edit', $category->hid()) }}">{{ __('Edit') }}</a>
				</p>
			@endforeach
		@else
			<p>{{ __('No item categories') }}</p>
		@endif
	@endif


@endsection

@section('sidebar.left')

@endsection
