<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - Givers'))
@section('currentNavItem', route('admin.givers'))

@push('styles')
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')


	<h1><i class="fas fa-hand-holding"></i> {{ __('Givers') }}</h1>

	@if ($givers)
		<ul>
		@foreach ($givers as $key => $giver)
			<li>
				{{ $giver->email }} ({{ $giver->markedItems->count() }} marked)
			</li>
		@endforeach
		</ul>
	@endif

@endsection

@section('sidebar.left')
@endsection
