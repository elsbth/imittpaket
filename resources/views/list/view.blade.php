@extends('layouts.public')

@section('title', __('List'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)
        <?php $giver = (isset($giver)) ? $giver : false; ?>
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

            <i class="fas fa-hand-holding give-icon__hand"><i class="fas fa-gift give-icon__gift"></i></i>
            @if ($isOwner)
                {{ __('Owner can\'t mark items as "Give" on their own lists') }}
            @endif

            @if ($giver)
                Give mode unlocked for {{ $giver->email }}
            @endif

            @if (!$isOwner && !$giver)
                <button type="button"
                        class="btn btn--primary"
                        data-toggle="modal"
                        data-target="#give-instructions">
                    {{ __('I want to give an item on this list!') }}
                </button>

                <div class="modal fade" id="give-instructions"
                     tabindex="-1" role="dialog"
                     aria-labelledby="give-instructions-label">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 id="give-instructions-label">{{ __('Unlock give mode') }}</h2>
                                <button type="button" class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>To unlock the give mode, enter your email address below</p>

                                <form method="POST" action="{{ route('list.giver.create') }}" class="form--narrow">
                                    @csrf

                                    <div class="form__field">
                                        <label for="email">{{ __('Email') }}</label>

                                        <input type="text"
                                               id="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}">
                                        @if ($errors->store->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->store->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form__actions">
                                        <input type="hidden" name="list" value="{{ $currentList->public_hash }}" />
                                        <button type="submit" class="btn btn--primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn--secondary"
                                        data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
