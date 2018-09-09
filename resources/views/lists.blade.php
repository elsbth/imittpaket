@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', route('lists'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

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
                    <a href="{{ route('list.edit', array($list->hid())) }}">{{ __('Edit') }}</a>
                    <a href="{{ route('list.view', $list->public_hash) }}">{{ __('View') }}</a>
                </div>
            </div>
        @endforeach
    @endif
@endsection


@section('sidebar.left')

@endsection