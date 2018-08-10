<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - FAQ - add'))
@section('currentNavItem', '/admin/faq/add')

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Administrate: FAQ - Add') }}</h1>

	<form method="POST" action="{{ route('admin.faq.create') }}">
		@csrf

		<div class="form-group row">
			<label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

			<div class="col-md-6">
				<textarea id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" required autofocus>
					{{ old('question') }}
				</textarea>

				@if ($errors->has('question'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('question') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

			<div class="col-md-6">
				<textarea id="answer" type="text" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" required>
					{{ old('answer') }}
				</textarea>

				@if ($errors->has('answer'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('answer') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					{{ __('Add FAQ') }}
				</button>
			</div>
		</div>
	</form>

@endsection

@section('sidebar.left')
	<p>{{ __('FAQs:') }}</p>

	<p><a href="/admin/faq"><< {{ __('Back') }}</a> </p>
	<ul>
		@foreach($faqs as $key => $faq)
			<li>
				<a href="/admin/faq/{{$faq->hid()}}">{{$faq->question}}</a>
			</li>
		@endforeach
	</ul>

@endsection
