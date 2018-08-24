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

        <div class="giver-actions">
            <div class="giver-actions__notice">
                <i class="fas fa-hand-holding give-icon__hand"><i class="fas fa-gift give-icon__gift"></i></i>
                @if ($isOwner)
                    {{ __('Owner can\'t mark items as "Give" on their own lists') }}
                @endif

                @if ($giver)
                    Give mode unlocked for {{ $giver->email }}
                    <br /><a href="{{ $currentList->getPublicLink() }}">Leave give mode</a>
                @endif

                @if (!$isOwner && !$giver)
                    <button type="button"
                            class="btn btn--primary"
                            data-toggle="modal"
                            data-target="#give-instructions">
                        {{ __('I want to give an item on this list!') }}
                    </button>
                @endif
            </div>

            @if (!$isOwner && !$giver)
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
                                <p>Register as a giver to be able to mark items on this list as "Giving"</p>

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
