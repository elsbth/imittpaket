@extends('layouts.app')

@section('title', __('Items'))
@section('currentNavItem', route('items'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentItem)

        <h1>{{ $currentItem->name }}</h1>
        <p>{{ __('Created') }}: {{ $currentItem->created_at->format('Y-m-d') }}</p>

        <ul>
            <li><a href="#edit">{{ __('Edit') }} &gt;</a></li>
            <li><a href="#inlists">{{ __('Item in list') }} &gt;</a></li>
            <li><a href="{{ route('item.delete', $currentItem->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this item') }}</a></li>
        </ul>

        <hr />

        <h2 id="edit">{{ __('Edit') }}</h2>

        <form action="{{ route('item.store', $currentItem->hid()) }}" method="post">
            @if ($errors->store->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form-group{{ $errors->store->has('title') ? ' has-error' : '' }}">
                <label for="name">Name <em class="required">*</em></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name', $currentItem->name) }}" maxlength="255">
                @if($errors->store->has('name'))
                    <span class="help-block">{{ $errors->store->first('name') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('description') ? ' has-error' : '' }}">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description', $currentItem->description) }}" maxlength="255">
                @if($errors->store->has('description'))
                    <span class="help-block">{{ $errors->store->first('description') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('qty') ? ' has-error' : '' }}">
                <label for="qty">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" value="{{ old('qty', $currentItem->qty) }}">
                @if($errors->store->has('qty'))
                    <span class="help-block">{{ $errors->store->first('qty') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('link') ? ' has-error' : '' }}">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('link', $currentItem->link) }}" maxlength="255">
                @if($errors->store->has('link'))
                    <span class="help-block">{{ $errors->store->first('link') }}</span>
                @endif
            </div>
            <div class="form-group{{ $errors->store->has('price') ? ' has-error' : '' }}">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price', $currentItem->price) }}" maxlength="50">
                @if($errors->store->has('price'))
                    <span class="help-block">{{ $errors->store->first('price') }}</span>
                @endif
            </div>

            <input type="hidden" name="item_id" value="{{ $currentItem->hid() }}" />
            <button type="submit" class="btn btn-default">{{ __('Save changes') }}</button>
        </form>

        <hr />

        <h2 id="inlists">{{ __('Item in lists') }}</h2>
        <p>{{ __('Select a list to add the item to it. Unselect to remove the item from that list.') }}</p>

        @if($lists)

            <form action="{{ route('item.addtolist') }}" method="post">
                @if ($errors->addToList->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                <ul>
                    @foreach($lists as $key => $list)
                        <li>
                            <input type="checkbox"
                                   name="wishlist_id[]"
                                   id="wishlist_id_{{ $list->id }}"
                                   value="{{ $list->id }}"
                                   {{ $itemListIds && in_array($list->id, $itemListIds) ? 'checked' : null }}
                            />
                            <label for="wishlist_id_{{ $list->id }}">{{ $list->title }}</label>
                        </li>
                    @endforeach
                </ul>

                @if($errors->addToList->has('wishlist_id'))
                    <span class="help-block">{{ $errors->addToList->first('wishlist_id') }}</span>
                @endif

                <input type="hidden" name="item_id" value="{{ $currentItem->hid() }}" />
                <button type="submit" class="btn btn-default">{{ __('Add to/Remove from lists') }}</button>
            </form>

        @else
            <p>{{ __('To add items to a list, start with Creating a list') }}</p>
        @endif

    @else
        <p>{{ __('No item here') }}</p>
    @endif
@endsection


@section('sidebar.left')
    <p>{{ __('Items:') }}</p>

    @if($currentItem)
        <p><a href="{{ route('items') }}"><< {{ __('Back') }}</a> </p>
    @endif

    @if($items)
        <ul>
            @foreach($items as $key => $item)
                <li>
                    <a href="{{ route('item.edit', array($item->hid())) }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif

@endsection