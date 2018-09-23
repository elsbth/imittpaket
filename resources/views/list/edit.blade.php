@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', route('lists'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)

        <h1><i class="fas fa-list"></i> {{ $currentList->title }}</h1>
        <p>
            {{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}
            <br /><span class="link--long">{{ __('Public link') }}: <a href="{{ $publicLink }}" id="public-link">{{ $publicLink }}</a></span>
            <br /><button class="js-copy-trigger btn btn--tertiary btn--size-small" data-copy-from="#public-link"><i class="fas fa-copy"></i> {{ __('Copy public link to clipboard') }}</button>

        </p>

        <hr />
        <p class="space-children">
            <a href="{{ route('lists') }}">&laquo; {{ __('My lists') }}</a>
            <a href="{{ $publicLink }}"> {{ __('View list') }}</a>
            <a href="{{ route('list.delete', $currentList->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')"> {{ __('Delete list') }}</a>
        </p>

        <hr />

        <h2 id="edit">{{ __('Edit details') }}</h2>

        <form action="{{ route('list.store', $currentList->hid()) }}" method="post">
            @if ($errors->store->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form-group{{ $errors->store->has('title') ? ' has-error' : '' }}">
                <label for="title">Title <em class="required">*</em></label>
                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       placeholder="Title"
                       value="{{ old('title', $currentList->title) }}"
                       autocomplete="off"/>

                @if($errors->store->has('title'))
                    <span class="help-block">{{ $errors->store->first('title') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('description') ? ' has-error' : '' }}">
                <label for="description">Description</label>
                <input type="text"
                       class="form-control"
                       id="description"
                       name="description"
                       placeholder="Description"
                       value="{{ old('description', $currentList->description) }}"
                       autocomplete="off" />
                @if($errors->store->has('description'))
                    <span class="help-block">{{ $errors->store->first('description') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('date') ? ' has-error' : '' }}">
                <label for="date">Date (YYYY-MM-DD)</label>
                <input type="text"
                       class="form-control"
                       id="date"
                       name="date"
                       placeholder="Date"
                       value="{{ old('date', $currentList->date) }}"
                       autocomplete="off"
                       pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"/>
                @if($errors->store->has('date'))
                    <span class="help-block">{{ $errors->store->first('date') }}</span>
                @endif
            </div>

            <input type="hidden" name="list_id" value="{{ $currentList->hid() }}" />
            <button type="submit" class="btn btn--primary">{{ __('Save changes') }}</button>
        </form>

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
                    <div>
                        @foreach ($itemsOnList as $item)
                            <div class="item reorder__item js-reorder-item">
                                <div class="reorder__field js-reorder-toggle-el" style="display: none">
                                    <input type="number" class="reorder__input" name="item-position[{{ $item->hid() }}]" value="{{ $item->pivot->position }}" min="0" />
                                </div>
                                <h3 class="h5 reorder__item-name">{{ $item->name }}</h3>
                                <div class="reorder__item-actions js-reorder-toggle-el">
                                    <a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit"
                            class="btn btn--primary js-reorder-submit js-reorder-toggle-el"
                            disabled
                            style="display: none">{{ __('Save positions') }}</button>
                </form>
            </div>
        @endif


    @else
        <p>{{ __('Cannot view list') }}</p>
    @endif
@endsection


@section('sidebar.left')

@endsection