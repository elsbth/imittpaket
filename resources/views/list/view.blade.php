@extends('layouts.app')

@section('title', __('List'))
@section('currentNavItem', '/list')

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)

        <h1>{{ $currentList->title }}</h1>

        <p>{{ __('Description') }}</p>

        @if ($itemsOnList)
            <h2>{{ __('Items on this list') }}</h2>
            <ul>
                @foreach ($itemsOnList as $item)
                    <li>
                        <strong>{{ $item->name }}</strong>
                        <p>{{ $item->description }}</p>
                        <p>{{ $item->price }} @if ($item->link) <a href="{{ $item->link }}">{{ $item->link }}</a>@endif</p>
                    </li>
                @endforeach
            </ul>
        @endif

    @else
        <p>{{ __('No list for this link') }}</p>
    @endif
@endsection


@section('sidebar.left')

    @if ($currentList)
        @if ($ownerName)
            <p>{{ __('Owner') }}: {{ $ownerName }}</p>
        @endif

        @if ($currentList->date)
            <p>{{ __('Date') }}: {{ $currentList->date->format('Y-m-d') }}</p>
        @endif

        <p>{{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}</p>
    @endif
@endsection