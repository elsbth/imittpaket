<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Changelog'))
@section('currentNavItem', route('changelog'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1><i class="fas fa-code"></i> {{ __('Changelog') }}</h1>

	<p style="font-style: italic">Re-building the site from scratch with Laravel to make it easier to maintain the code. Read all about the changes released to the site in this changelog.</p>

	<h2>0.4.0 <span class="h6">2018-09-23</span> </h2>
	<p>Select a category for your items. Category is shown with an icon in the list.</p>
	<p>Copy public link to clipboard. In edit list view.</p>

	<hr />

	<h2>0.3.0 <span class="h6">2018-09-09</span> </h2>
	<p>Possible to change position of the items on the lists.</p>
	<p>Only list view is the public list. Edit list view is updated.</p>
	<p>Fix: Unselecting all lists for one item is now saved correctly.</p>

	<hr />
	<h2>0.2.0 <span class="h6">2018-08-26</span> </h2>
	<p>Cookie notice.</p>
	<p>Public list view has new styling.</p>
	<p>You can register as a Giver for a public list. As a giver you can select the items that you intend to give and see what others have already selected.</p>
	<p>Terms &amp; conditions when registering for an account and as a giver.</p>

	<hr />
	<h2>0.1.2 <span class="h6">2018-08-23</span></h2>
	<p>New logo saying this is a test site.</p>

	<hr />
	<h2>0.1.1 <span class="h6">2018-08-20</span></h2>
	<p>Fixed mobile styilng.</p>

	<hr />
	<h2>0.1.0 <span class="h6">2018-08-19</span></h2>
	<p>MVP (minimum viable product) release. Features include creating lists, creating items and adding them to lists. All lists are public.</p>

@endsection


@section('sidebar.left')
@endsection