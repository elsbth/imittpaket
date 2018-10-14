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
        </div>

        @if (!$isOwner)
        <div class="giver-actions">
            <div class="giver-actions__notice">
                <i class="fas fa-hand-holding give-icon__hand"><i class="fas fa-gift give-icon__gift"></i></i>
                @if ($giver)
                    Give mode unlocked for {{ $giver->email }}
                    <br /><a href="{{ $currentList->getPublicLink() }}"><i class="fas fa-sign-out-alt"></i> Leave give mode</a>
                @else
                    <button type="button"
                            class="btn btn--primary"
                            data-toggle="modal"
                            data-target="#give-instructions">
                        {{ __('I want to give an item on this list!') }}
                    </button>
                @endif
            </div>

            @if (!$giver)
                <div class="modal fade" id="give-instructions"
                     tabindex="-1" role="dialog"
                     aria-labelledby="give-instructions-label">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 id="give-instructions-label">{{ __('Give items') }}</h2>
                                <button type="button" class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Register as a giver to select items you will give.</p>

                                <form method="POST" action="{{ route('list.giver.create') }}" class="form--narrow">
                                    @csrf

                                    <div class="form__field">
                                        <label for="email">{{ __('E-mail address') }}</label>

                                        <input type="text"
                                               id="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}"
                                               required />
                                        @if ($errors->store->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form__field">
                                        <label for="accepted">

                                            <input type="checkbox"
                                                   id="accepted"
                                                   class="{{ $errors->has('accepted') ? ' is-invalid' : '' }}"
                                                   name="accepted"
                                                   value="1"
                                                   required />
                                            {{ __('I accept') }}</label> {{ __('the') }} <a href="{{ route('terms') }}" target="_blank">{{ __('terms and conditions') }}</a>
                                        @if ($errors->store->has('accepted'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('accepted') }}</strong>
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
                        </div>
                    </div>
                </div>
            @endif
            </div>
        @endif

        @if ($itemsOnList)
            @foreach ($itemsOnList as $item)
                <div class="item item--card">
                    <h2 class="{{ $item->got_date ? 'item__name--got' : '' }}">{{ $item->name }}</h2>

                    @if ($item->qty || $item->price)
                        <div class="item__details space-children">
                            @if ($item->category)
                                <span class="item__detail"><i class="fas fa-{{ $item->category->icon }}"></i> {{ $item->category->name }}</span>
                            @endif
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

                    @if ($isOwner || $giver)
                        <div class="item__actions space-children">
                            @if ($isOwner)
                                <a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit item') }}</a>
                                <div class="item-actions__right">
                                    @if($item->got_date)
                                        {{ __('Got it') }} <i class="fas fa-check"></i>
                                    @else
                                        <button type="button"
                                                class="btn btn--tertiary btn--size-small"
                                                data-toggle="modal"
                                                data-target="#got-item"
                                                data-item-id="{{ $item->hid() }}"
                                                data-item-name="{{ $item->name }}">
                                            {{ __('Got it!') }}
                                        </button>
                                    @endif
                                </div>
                            @endif

                            @if (!$isOwner && $giver)
                                <?php
                                    $allMarked = $item->isAllMarked();
                                    $qtyByGiver = $item->getQtyMarkedByGiver($giver->id);
                                ?>
                                @if ($allMarked === true)
                                    @if ($qtyByGiver === false)
                                        <span class="item__give-info">
                                            <i class="fas fa-user-friends"></i> Someone else is already giving this item
                                        </span>
                                    @else
                                        @if ($item->qty)
                                            <span class="item__give-info">
                                                <i class="fas fa-check"></i> You are giving {{ $qtyByGiver }}. None left.
                                            </span>

                                            @if(!$item->got_date)
                                                <div class="item-actions__right">
                                                    <form method="POST" action="{{ route('item.mark') }}" class="form--give">
                                                        @csrf

                                                        <input type="number" name="marked_qty" value="{{ $qtyByGiver }}" min="0" max="{{ $qtyByGiver }}" />
                                                        <input type="hidden" name="item" value="{{ $item->hid() }}" />
                                                        <input type="hidden" name="giver" value="{{ $giver->token }}" />
                                                        <button type="submit" class="btn btn--secondary">
                                                            <i class="fas fa-sync"></i> <span class="d-none d-sm-inline">{{ __('Update') }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @else
                                            <span class="item__give-info">
                                                <i class="fas fa-check"></i> You are giving this
                                            </span>

                                            @if(!$item->got_date)
                                                <div class="item-actions__right">
                                                    <form method="POST" action="{{ route('item.mark') }}" class="form--give">
                                                        @csrf

                                                        <input type="hidden" name="marked_qty" value="0" />
                                                        <input type="hidden" name="item" value="{{ $item->hid() }}" />
                                                        <input type="hidden" name="giver" value="{{ $giver->token }}" />
                                                        <button type="submit" class="btn btn--cancel">
                                                            <i class="fas fa-ban"></i> <span class="d-none d-sm-inline">{{ __('Cancel') }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    <?php $giveStartValue = $item->qty; ?>
                                    @if ($item->qty)
                                        <?php $giveStartValue = $item->qty - (int)$allMarked; ?>

                                        <span class="item__give-info">
                                            Left to give: {{ $item->qty - (int)$allMarked }}.
                                            @if ($qtyByGiver !== false)
                                                <br class="d-inline d-sm-none" /><i class="fas fa-check"></i> You are giving {{ $qtyByGiver }}.
                                                <?php $giveStartValue = $qtyByGiver; ?>
                                            @endif

                                        </span>
                                    @endif

                                    @if(!$item->got_date)
                                        <div class="item-actions__right">
                                            <form method="POST" action="{{ route('item.mark') }}" class="form--give">
                                                @csrf

                                                @if ($item->qty)
                                                    <input type="number" name="marked_qty" value="{{ $giveStartValue }}" min="0" max="{{ $item->qty - (int)$allMarked + $qtyByGiver }}" />
                                                @endif

                                                <input type="hidden" name="item" value="{{ $item->hid() }}" />
                                                <input type="hidden" name="giver" value="{{ $giver->token }}" />
                                                @if ($qtyByGiver === false)
                                                    <button type="submit" class="btn btn--primary">
                                                        <i class="fas fa-gift"></i> <span class="d-none d-sm-inline">{{ __('Give this') }}</span>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn--secondary">
                                                        <i class="fas fa-sync"></i> <span class="d-none d-sm-inline">{{ __('Update') }}</span>
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    @endif
                                @endif

                                @if($item->got_date)
                                    <div class="item-actions__right">
                                        {{ __('Got it') }} <i class="fas fa-check"></i>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            @include('item.modal-got')

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
