<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - FAQ'))
@section('currentNavItem', '/admin/faq')

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Administrate: FAQ') }}</h1>

	@if($faq)
		<p><a href="{{ route('admin.faq.edit', array($faq->id)) }}">{{ __('Edit FAQ question') }}</a></p>

		<table>
			<tr>
				<td>{{ __('Id') }}</td>
				<td>{{ $faq->id }}</td>
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
	@endif


@endsection

@section('sidebar.left')
	<p>{{ __('FAQs:') }}</p>
	<p><a href="/admin/faq/add">{{ __('Add FAQ') }}</a> </p>

	@if($faq)
		<p><a href="/admin/faq"><< {{ __('Back') }}</a> </p>
	@else
	<ul>
		@foreach($faqs as $key => $faq)
			<li>
				<a href="/admin/faq/{{$faq->id}}">{{$faq->question}}</a>
			</li>
		@endforeach
	</ul>
	@endif

@endsection
