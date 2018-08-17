@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', route('lists'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)

        <h1>{{ $currentList->title }}</h1>
        <p>{{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}
        <br />{{ __('Public link') }}: <a href="{{ $publicLink }}">{{ $publicLink }}</a></p>

        @if ($currentList->description)
            <p>{{ $currentList->description }}</p>
        @endif
        @if ($currentList->date)
            <p>{{ __('Date') }}: {{ $currentList->date }}</p>
        @endif


        <hr />
        <div class="space-children">
            <a href="{{ route('lists') }}">&laquo; {{ __('Back to lists') }}</a>
            <a href="{{ route('list.edit', $currentList->hid()) }}">{{ __('Edit list details') }}</a>
        </div>
        <hr />

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
                    <div class="item__actions"><a href="{{ route('item.edit', array($item->hid())) }}">{{ __('Edit') }}</a></div>
                </div>
            @endforeach
        @endif

    @else
        <h1>{{ __('Lists') }}</h1>
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
                <button type="button" class="btn btn--secondary btn--toggle-close js-toggle-trigger" data-toggle-trigger="name">{{ __('Close Create list form') }}</button>

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
                <button type="submit" class="btn btn--primary">Submit</button>
            </div>
        </form>
    @endif
@endsection


@section('sidebar.left')
    @if(!$currentList)
        <p>{{ __('Your lists:') }}</p>

        @if($lists)
            <ul>
                @foreach($lists as $key => $list)
                    <li>
                        <a href="{{ route('lists', array($list->hid())) }}">{{ $list->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif

@endsection