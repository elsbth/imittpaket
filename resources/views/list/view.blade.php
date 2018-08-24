@extends('layouts.public')

@section('title', __('List'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)
        <?php $itemCount = $currentList->items->count(); ?>

        @auth
            <div class="list__actions list__actions--public space-children">
                    <a href="{{ route('lists') }}">&laquo; {{ __('My lists') }}</a>
                    <a href="{{ route('items') }}">&laquo; {{ __('My items') }}</a>

                @if ($isOwner)
                    <a href="{{ route('list.edit', $currentList->hid()) }}">{{ __('Edit this list') }}</a>
                @endif

            </div>
        @endauth

        <div class="list-details--public">
            <h1 class="h1--public">{{ $currentList->title }}</h1>

            <div class="list__details space-children">
                <span class="list__detail">{{ __('by') }}: {{ $ownerName }}</span>

                @if ($currentList->date)
                    <span class="list__detail">{{ $currentList->date }}</span>
                @endif

                @if ($itemCount)
                    <span class="list__detail">{{ $itemCount }} {{ $itemCount == 1 ? __('item') : __('items') }}</span>
                @endif
            </div>

            @if ($currentList->description)
                <p>{{ $currentList->description  }}</p>
            @endif

            @if (false)
            <button type="button" class="btn btn--primary" onclick="alert('Oh, how nice of you :)')">
                <i class="fas fa-hand-holding" style="font-size: 2rem"><i class="fas fa-gift"></i></i>
                <br />{{ __('I want to give an item on this list!') }}
            </button>
            @endif
        </div>

        @if ($itemsOnList)
            @foreach ($itemsOnList as $item)
                <div class="item item--card">
                    <h2>{{ $item->name }}</h2>

                    @if ($item->qty || $item->price)
                        <div class="item__details space-children">
                            @if ($item->qty)
                                <span class="item__detail">{{ $item->qty ? __('Quantity:') . ' ' . $item->qty : '' }}</span>
                            @endif
                            @if ($item->price)
                                <span class="item__detail">{{ $item->price ? __('Price:') . ' ' . $item->price : '' }}</span>
                            @endif
                        </div>
                    @endif

                    @if($item->description)
                        <p>{{ $item->description }}</p>
                    @endif

                    @if($item->link)
                        <p class="item__link link--long"><a href="{{ $item->link }}">{{ $item->link }}</a></p>
                    @endif

                    @if ($isOwner)
                        <div class="item__actions"><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></div>
                    @endif
                </div>
            @endforeach
        @endif

    @else
        <div class="list-details--public">
            <p>{{ __('No list here.') }}</p>
            <p><a href="{{ route('home') }}">{{ __('Go to the startpage') }}</a></p>
        </div>
    @endif
@endsection


@section('sidebar.left')
@endsection
