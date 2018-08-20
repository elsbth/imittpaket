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
        <h1><i class="fas fa-gift"></i> {{ __('Items') }}</h1>
        <h2>{{ __('Add new item') }}</h2>
        <form action="{{ route('item.create') }}" method="post" class="form">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif

            {!! csrf_field() !!}
            <div class="form__field {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">{{ __('Name') }} <em class="required">*</em></label>
                <input type="text"
                       class="form-control js-toggle-trigger"
                       id="name"
                       name="name"
                       placeholder="{{ __('Name') }}"
                       value="{{ old('name') }}"
                       maxlength="100"
                       autocomplete="off"
                       data-toggle-trigger="name" />
                @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="js-toggle-when-triggered" data-toggle-trigger="name" style="{{ $errors->any() ? '' : 'display: none' }}">
                <div class="form__field {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">{{ __('Description') }}</label>
                    <input type="text"
                           class="form-control"
                           id="description"
                           name="description"
                           placeholder="{{ __('Description') }}"
                           value="{{ old('description') }}"
                           autocomplete="off"
                           maxlength="255" />
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form__field {{ $errors->has('qty') ? ' has-error' : '' }}">
                    <label for="qty">{{ __('Quantity') }}</label>
                    <input type="number"
                           class="form-control"
                           id="qty"
                           name="qty"
                           placeholder="{{ __('Quantity') }}"
                           value="{{ old('qty') }}"
                           autocomplete="off" />
                    @if($errors->has('qty'))
                        <span class="help-block">{{ $errors->first('qty') }}</span>
                    @endif
                </div>
                <div class="form__field{{ $errors->has('link') ? ' has-error' : '' }}">
                    <label for="link">{{ __('Link (include http://') }}</label>
                    <input type="text"
                           class="form-control"
                           id="link"
                           name="link"
                           placeholder="{{ __('Link') }}"
                           value="{{ old('link') }}"
                           autocomplete="off"
                           maxlength="400" />
                    @if($errors->has('link'))
                        <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>
                <div class="form__field {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">{{ __('Price') }}</label>
                    <input type="text"
                           class="form-control"
                           id="price"
                           name="price"
                           placeholder="{{ __('Price') }}"
                           value="{{ old('price') }}"
                           autocomplete="off"
                           maxlength="50" />
                    @if($errors->has('price'))
                        <span class="help-block">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn--primary">{{ __('Add item') }}</button>
            </div>
        </form>


        @if($items)
            <hr />
            <h2>{{ __('Your items') }}</h2>
            <div>
                @foreach($items as $key => $item)
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
                        <div class="item__actions"><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection


@section('sidebar.left')

@endsection