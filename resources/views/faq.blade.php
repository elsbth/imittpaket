<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('FAQ'))
@section('currentNavItem', '/faq')

@push('styles')
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1>{{ __('FAQ') }}</h1>


	@if($faq)
		<table>
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

		<ul>
		@foreach($faqs as $key => $faq)
			<li>
				<a href="#{{ $faq->id }}">{{ $faq->question }}</a>
			</li>
		@endforeach
		</ul>

		<div class="hr"></div>

		@foreach($faqs as $key => $faq)
			<div class="faq" id="{{ $faq->id }}">
				<h2 class="faqQuestion">{{ $faq->question }}</h2>
				<div class="faqAnswer">
					<p>{{ $faq->answer }}</p>
				</div>
				<p><a href="{{ route('faq', array($faq->id)) }}">{{ __('Direct link') }}</a></p>
			</div>
		@endforeach
	@endif

@endsection


@section('sidebar.left')
	<p>{{ __('FAQs:') }}</p>

	@if($faq)
		<p><a href="/faq"><< {{ __('Back') }}</a> </p>
	@endif

@endsection