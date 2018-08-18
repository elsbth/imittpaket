<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - FAQ'))
@section('currentNavItem', route('admin.faq'))

@push('styles')
	<link href="{{ asset('css/faq.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1><i class="fas fa-life-ring"></i> {{ __('FAQ') }}</h1>
	<p><a href="{{ route('admin.faq.add') }}">{{ __('Add FAQ') }}</a> </p>
	<hr />

	@if($faq)
		<p class="space-children">
			<a href="{{ route('admin.faq') }}">&laquo; {{ __('Back to FAQs') }}</a>
			<a href="{{ route('admin.faq.edit', array($faq->hid())) }}">{{ __('Edit') }}</a>
		</p>

		<table>
			<tr>
				<td>{{ __('Id') }}</td>
				<td>{{ $faq->hid() }}</td>
			</tr>
			<tr>
				<td>{{ __('Question') }}</td>
				<td>{{ $faq->question }}</td>
			</tr>
			<tr>
				<td>{{ __('Answer') }}</td>
				<td>{{ $faq->answer }}</td>
			</tr>
			<tr>
				<td>{{ __('Position') }}</td>
				<td>{{ $faq->position }}</td>
			</tr>
			<tr>
				<td>{{ __('Votes') }}</td>
				<td>{{ $faq->votes}}</td>
			</tr>
		</table>
	@else
		@if ($faqs)
			@foreach($faqs as $key => $faq)
				<div class="faq__card {{ $loop->iteration == 1 ? 'faq__card--no-border' : '' }}" id="{{ $faq->hid() }}">
					<h2 class="faq__question">{{ $faq->question }}</h2>
					<div class="faq__question">
						<p>{{ $faq->answer }}</p>
					</div>
					<a href="{{ route('admin.faq.edit', $faq->hid()) }}">{{ __('Edit') }}</a>
				</div>
			@endforeach
		@endif
	@endif


@endsection

@section('sidebar.left')

@endsection
