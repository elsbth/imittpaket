@extends('layouts.app')

@section('title', __('Items'))
@section('currentNavItem', route('items'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentItem)

        <h1><i class="fas fa-gift"></i> {{ $currentItem->name }}</h1>
        <p>{{ __('Created') }}: {{ $currentItem->created_at->format('Y-m-d') }}</p>

        <hr />
        <p> {{ __('Scroll down to select which list(s) the item should be added to.') }}</p>
        <p class="space-children">
            <a href="{{ route('items') }}">&laquo; {{ __('Back to items') }}</a>
            <a href="{{ route('item.delete', $currentItem->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this item') }}</a>
        </p>

        <hr />

        <h2 id="edit">{{ __('Edit details') }}</h2>

        <form action="{{ route('item.store', $currentItem->hid()) }}" method="post" class="form">
            @if ($errors->store->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form__field {{ $errors->store->has('title') ? ' has-error' : '' }}">
                <label for="name">Name <em class="required">*</em></label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       placeholder="Name"
                       value="{{ old('name', $currentItem->name) }}"
                       autocomplete="off"
                       maxlength="255" />
                @if($errors->store->has('name'))
                    <span class="help-block">{{ $errors->store->first('name') }}</span>
                @endif
            </div>
            <div class="form__field {{ $errors->store->has('description') ? ' has-error' : '' }}">
                <label for="description">Description</label>
                <input type="text"
                       class="form-control"
                       id="description"
                       name="description"
                       placeholder="Description"
                       value="{{ old('description', $currentItem->description) }}"
                       autocomplete="off"
                       maxlength="255" />
                @if($errors->store->has('description'))
                    <span class="help-block">{{ $errors->store->first('description') }}</span>
                @endif
            </div>
            <div class="form__field {{ $errors->store->has('qty') ? ' has-error' : '' }}">
                <label for="qty">Quantity</label>
                <input type="number"
                       class="form-control"
                       id="qty"
                       name="qty"
                       placeholder="Quantity"
                       value="{{ old('qty', $currentItem->qty) }}"
                       autocomplete="off" />
                @if($errors->store->has('qty'))
                    <span class="help-block">{{ $errors->store->first('qty') }}</span>
                @endif
            </div>
            <div class="form__field {{ $errors->store->has('link') ? ' has-error' : '' }}">
                <label for="link">Link</label>
                <input type="text"
                       class="form-control"
                       id="link"
                       name="link"
                       placeholder="Link"
                       value="{{ old('link', $currentItem->link) }}"
                       autocomplete="off"
                       maxlength="400" />
                @if($errors->store->has('link'))
                    <span class="help-block">{{ $errors->store->first('link') }}</span>
                @endif
            </div>
            <div class="form__field {{ $errors->store->has('price') ? ' has-error' : '' }}">
                <label for="price">Price</label>
                <input type="text"
                       class="form-control"
                       id="price"
                       name="price"
                       placeholder="Price"
                       value="{{ old('price', $currentItem->price) }}"
                       autocomplete="off"
                       maxlength="50" />
                @if($errors->store->has('price'))
                    <span class="help-block">{{ $errors->store->first('price') }}</span>
                @endif
            </div>

            <input type="hidden" name="item_id" value="{{ $currentItem->hid() }}" />
            <button type="submit" class="btn btn--primary">{{ __('Save changes') }}</button>
        </form>

        <hr />

        <h2 id="inlists">{{ __('Item in lists') }}</h2>
        <p>{{ __('Select a list to add the item to it. Unselect to remove.') }}</p>

        @if($lists)

            <form action="{{ route('item.addtolist') }}" method="post">
                @if ($errors->addToList->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                @foreach($lists as $key => $list)
                    <div class="form__field form__field--checkbox">
                        <input type="checkbox"
                               name="wishlist_id[]"
                               id="wishlist_id_{{ $list->id }}"
                               value="{{ $list->id }}"
                               {{ $itemListIds && in_array($list->id, $itemListIds) ? 'checked' : null }}
                        />
                        <label for="wishlist_id_{{ $list->id }}">{{ $list->title }}</label>
                    </div>
                @endforeach

                @if($errors->addToList->has('wishlist_id'))
                    <span class="help-block">{{ $errors->addToList->first('wishlist_id') }}</span>
                @endif

                <input type="hidden" name="item_id" value="{{ $currentItem->hid() }}" />
                <button type="submit" class="btn btn--primary">{{ __('Add to/Remove from lists') }}</button>
            </form>

        @else
            <p>{{ __('To add items to a list, start with Creating a list') }}</p>
        @endif

    @else
        <p>{{ __('No item here') }}</p>
    @endif
@endsection


@section('sidebar.left')

@endsection