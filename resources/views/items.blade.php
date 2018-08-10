@extends('layouts.app')

@section('title', __('Items'))
@section('currentNavItem', route('items'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentItem)

        <p>
            <strong>{{ $currentItem->name }}</strong>
            <br /><a href="{{ route('item.edit', $currentItem->hid()) }}">{{ __('Edit item') }}</a>
        </p>

    @else
        <h1>{{ __('Items') }}</h1>
        <h2>{{ __('Add item') }}</h2>
        <form action="{{ route('item.create') }}" method="post">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="name">Name <em class="required">*</em></label>
                <input type="text"
                       class="form-control js-toggle-trigger"
                       id="name"
                       name="name"
                       placeholder="Name"
                       value="{{ old('name') }}"
                       maxlength="255"
                       autocomplete="off"
                       data-toggle-trigger="name" />
                @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="js-toggle-when-triggered" data-toggle-trigger="name" style="display: none">

                <button type="button" class="js-toggle-trigger" data-toggle-trigger="name">{{ __('Close Add item form') }}</button>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <input type="text"
                           class="form-control"
                           id="description"
                           name="description"
                           placeholder="Description"
                           value="{{ old('description') }}"
                           autocomplete="off"
                           maxlength="255" />
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                    <label for="qty">Quantity</label>
                    <input type="number"
                           class="form-control"
                           id="qty"
                           name="qty"
                           placeholder="Quantity"
                           value="{{ old('qty') }}"
                           autocomplete="off" />
                    @if($errors->has('qty'))
                        <span class="help-block">{{ $errors->first('qty') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                    <label for="link">Link</label>
                    <input type="text"
                           class="form-control"
                           id="link"
                           name="link"
                           placeholder="Link"
                           value="{{ old('link') }}"
                           autocomplete="off"
                           maxlength="255" />
                    @if($errors->has('link'))
                        <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Price</label>
                    <input type="text"
                           class="form-control"
                           id="price"
                           name="price"
                           placeholder="Price"
                           value="{{ old('price') }}"
                           autocomplete="off"
                           maxlength="50" />
                    @if($errors->has('price'))
                        <span class="help-block">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>


        @if($items)
            <hr />
            <div>
                @foreach($items as $key => $item)
                    <div class="item item--card">
                        <h2>{{ $item->name }}</h2>
                        @if($item->description)
                            <p>{{ $item->description }}</p>
                        @endif
                        @if($item->link)
                            <p>{{ __('Link:') }} <a href="{{ $item->link }}">{{ $item->link }}</a></p>
                        @endif

                        <p>
                            <span>{{ $item->qty ? __('Quantity:') . ' ' . $item->qty : '' }}</span>
                            <span>{{ $item->price ? __('Price:') . ' ' . $item->price : '' }}</span>
                        </p>
                        <p><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></p>
                    </div>
                @endforeach
            </div>
        @endif
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