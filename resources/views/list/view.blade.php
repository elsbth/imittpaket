@extends('layouts.app')

@section('title', __('List'))
@section('currentNavItem', '/list')

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)
        <?php $itemCount = $currentList->items->count(); ?>

        <h1>{{ $currentList->title }}</h1>


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

        @if ($itemsOnList)
            <h2>{{ __('Items on this list') }}</h2>
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
                        <p class="item__link"><a href="{{ $item->link }}">{{ $item->link }}</a></p>
                    @endif

                    @if ($isOwner)
                        <div class="item__actions"><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></div>
                    @endif
                </div>
            @endforeach
        @endif

    @else
        <p>{{ __('No list for this link') }}</p>
    @endif
@endsection


@section('sidebar.left')
@endsection