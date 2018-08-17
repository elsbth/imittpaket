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
        <p>{{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}</p>

        <hr />
        <p class="space-children">
            <a href="{{ route('lists', $currentList->hid()) }}">&laquo; {{ __('Back to list view') }}</a>
            <a href="{{ route('list.delete', $currentList->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this list') }}</a>
        </p>

        <hr />

        <h2 id="edit">{{ __('Edit') }}</h2>

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

    @else
        <p>{{ __('Cannot view list') }}</p>
    @endif
@endsection


@section('sidebar.left')

@endsection