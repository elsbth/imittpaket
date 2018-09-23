<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Item Category - Edit'))
@section('currentNavItem', route('admin.itemcategories'))

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')


	@if($category)
		<h1><i class="fas fa-tag"></i> {{ __('Edit :name', ['name' => $category->name]) }}</h1>
		<p><a href="{{ route('admin.itemcategories') }}">&laquo; {{ __('Back to Item categories') }}</a></p>
		<p>
			{{ __('Name:') }} <strong>{{ $category->name }}</strong>
			<br /> {{ __('Icon:') }} {{ $category->icon }}  <i class="fas fa-{{ $category->icon }}"></i>
		</p>

		<hr />

        <p style="font-style: italic"><strong>TODO:</strong> Prevent deleting categories that are currently assigned to items.</p>

		<div class="space-children">
			<a href="{{ route('admin.itemcategories') }}">&laquo; {{ __('Back to item categories') }}</a>
			<a href="{{ route('admin.itemcategory.delete', $category->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this item category') }}</a>
		</div>


		<form method="POST" action="{{ route('admin.itemcategory.store', array($category->hid())) }}">
			@csrf

			<div class="form__field">
				<label for="name" >{{ __('Name') }}</label>

				<input type="text"
					   id="name"
					   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
					   name="name"
					   value="{{ old('name', $category->name) }}"
					   autocomplete="off"
					   maxlength="50">
				@if ($errors->store->has('name'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<label for="icon">{{ __('Fontawesome icon') }}</label>

				<input type="text"
					   id="icon"
					   class="form-control{{ $errors->store->has('icon') ? ' is-invalid' : '' }}"
					   name="icon"
					   value="{{ old('icon', $category->icon) }}"
					   autocomplete="off"
					   maxlength="50">
				@if ($errors->store->has('icon'))
					<span class="invalid-feedback">
						<strong>{{ $errors->store->first('icon') }}</strong>
					</span>
				@endif
			</div>

			<div class="form__field">
				<button type="submit" class="btn btn-primary">
					{{ __('Save changes') }}
				</button>
			</div>
		</form>

	@endif


@endsection

@section('sidebar.left')

@endsection
