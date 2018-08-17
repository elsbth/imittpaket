<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('FAQ'))
@section('currentNavItem', route('faq'))

@push('styles')
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')


	@if($faq)
		<div class="faq" id="{{ $faq->hid() }}">
			<h1 class="faq__question">{{ $faq->question }}</h1>
			<div class="faq__question">
				<p>{{ $faq->answer }}</p>
			</div>
		</div>
		<hr />
		<p><a href="{{ route('faq') }}">&laquo; {{ __('Back to FAQ') }}</a></p>

	@else
		<h1><i class="fas fa-life-ring"></i> {{ __('FAQ') }}</h1>

		<ul>
		@foreach($faqs as $key => $faq)
			<li>
				<a href="#{{ $faq->hid() }}">{{ $faq->question }}</a>
			</li>
		@endforeach
		</ul>

		<p>&nbsp;</p>

		@foreach($faqs as $key => $faq)
			<div class="faq__card {{ $loop->iteration == 1 ? 'faq__card--no-border' : '' }}" id="{{ $faq->hid() }}">
				<h2 class="faq__question">{{ $faq->question }}</h2>
				<div class="faq__question">
					<p>{{ $faq->answer }}</p>
				</div>
			</div>
		@endforeach
	@endif

@endsection


@section('sidebar.left')

@endsection