@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', route('lists'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)
        <?php $itemCount = $currentList->items->count(); ?>

        <h1><i class="fas fa-list"></i> {{ $currentList->title }}</h1>


        <div class="list__details space-children">
            @if ($currentList->date)
                <span class="list__detail">{{ $currentList->date }}</span>
            @endif

            @if ($itemCount)
                <span class="list__detail">{{ $itemCount }} {{ $itemCount == 1 ? __('item') : __('items') }}</span>
            @endif
        </div>

        @if ($currentList->description)
            <p>{{ $currentList->description }}</p>
        @endif

        <hr />
        <p>
            {{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}
            <br /><span class="link--long">{{ __('Public link') }}: <a href="{{ $publicLink }}">{{ $publicLink }}</a></span>
        </p>
        <div class="space-children">
            <a href="{{ route('lists') }}">&laquo; {{ __('Back to lists') }}</a>
            <a href="{{ route('list.edit', $currentList->hid()) }}">{{ __('Edit list details') }}</a>
        </div>
        <hr />

        @if ($itemsOnList)
            <h2>{{ __('Items on this list') }}</h2>
            <div class="reorder__container js-reorder-container">
                <div class="reorder__actions">
                    <a role="button" class="js-reorder-enable">{{ __('Reorder items') }} <i class="fas fa-chevron-down"></i> </a>
                    <p class="js-reorder-toggle-el" style="display: none"><i class="fas fa-info-circle"></i> {{ __('Reorder items by entering the position on the list for each item. When done, Save the new positions.') }}</p>
                </div>
                <form action="{{ route('lists.store.order', $currentList->hid()) }}" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Please fix the following errors
                        </div>
                    @endif

                    {!! csrf_field() !!}
                    @foreach ($itemsOnList as $item)
                        <div class="item reorder__item js-reorder-item">
                            <div class="reorder__field js-reorder-toggle-el" style="display: none">
                                <input type="number" class="reorder__input" name="item-position[{{ $item->hid() }}]" value="{{ $item->pivot->position }}" min="0" />
                            </div>
                            <h3 class="h5">{{ $item->name }}</h3>
                            <div style="display: none">
                                <div class="item__actions"><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></div>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit"
                            class="btn btn--primary js-reorder-submit js-reorder-toggle-el"
                            disabled
                            style="display: none">{{ __('Save positions') }}</button>
                </form>
            </div>
        @endif

    @else
        <h1><i class="fas fa-list"></i> {{ __('Lists') }}</h1>
        <h2>{{ __('Create list') }}</h2>
        <form action="{{ route('lists.create') }}" method="post">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form__field {{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title">Title <em class="required">*</em></label>
                <input type="text"
                       class="form-control js-toggle-trigger"
                       id="title"
                       name="title"
                       placeholder="Title"
                       value="{{ old('title') }}"
                       maxlength="255"
                       autocomplete="off"
                       data-toggle-trigger="title" />
                @if($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="js-toggle-when-triggered" data-toggle-trigger="title" style="{{ $errors->any() ? '' : 'display: none' }}">
                <div class="form__field {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <input type="text"
                           class="form-control"
                           id="description"
                           name="description"
                           placeholder="Description"
                           value="{{ old('description') }}"
                           maxlength="255"
                           autocomplete="off" />
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form__field {{ $errors->has('date') ? ' has-error' : '' }}">
                    <label for="date">{{ __('Date (YYYY-MM-DD)') }}</label>
                    <input type="text"
                           class="form-control"
                           id="date"
                           name="date"
                           placeholder="Date"
                           value="{{ old('date') }}"
                           pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                           maxlength="255"
                           autocomplete="off" />
                    @if($errors->has('date'))
                        <span class="help-block">{{ $errors->first('date') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn--primary">{{ __('Submit') }}</button>
            </div>
        </form>

        <hr />

        <h2>{{ __('My lists') }}</h2>
        @if ($lists)
            @foreach ($lists as $key => $list)
                <?php $itemCount = $list->items->count(); ?>
                <div class="list list--card">
                    <h2>{{ $list->title }}</h2>

                    <div class="list__details space-children">
                        @if ($list->date)
                            <span class="list__detail">{{ $list->date }}</span>
                        @endif

                        @if ($itemCount)
                            <span class="list__detail">{{ $itemCount }} {{ $itemCount == 1 ? __('item') : __('items') }}</span>
                        @endif

                    </div>


                    @if($list->description)
                        <p>{{ $list->description }}</p>
                    @endif

                    @if($list->link)
                        <p class="item__link link--long"><a href="{{ $list->link }}">{{ $list->link }}</a></p>
                    @endif
                    <div class="list__actions space-children">
                        <a href="{{ route('lists', array($list->hid())) }}">{{ __('View list') }}</a>
                        <a href="{{ route('list.edit', array($list->hid())) }}">{{ __('Edit') }}</a>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
@endsection


@section('sidebar.left')

@endsection