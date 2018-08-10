@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', route('lists'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)

        <h1>List: {{ $currentList->title }}</h1>
        <p>{{ __('Created') }}: {{ $currentList->created_at->format('Y-m-d') }}</p>

        @if ($currentList->description)
            <p>{{ $currentList->description }}</p>
        @endif
        @if ($currentList->date)
            <p>{{ __('Date') }}: {{ $currentList->date }}</p>
        @endif

        <p>{{ __('Public link') }}: <a href="{{ $publicLink }}">{{ $publicLink }}</a></p>

        <hr />
        <p>
            <a href="{{ route('list.edit', $currentList->hid()) }}">{{ __('Edit') }}</a>
        </p>

        @if ($itemsOnList)
            <h2>{{ __('Items on this list') }}</h2>
            <ul>
                @foreach ($itemsOnList as $item)
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
            </ul>
        @endif

    @else
            <h1>Create a list</h1>
            <form action="/lists" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title <em class="required">*</em></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description') }}">
                    @if($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    <label for="date">Date (YYYY-MM-DD)</label>
                    <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="{{ old('date') }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    @if($errors->has('date'))
                        <span class="help-block">{{ $errors->first('date') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
    @endif
@endsection


@section('sidebar.left')
    <p>{{ __('Lists:') }}</p>

    @if($currentList)
        <p><a href="{{ route('lists') }}"><< {{ __('Back') }}</a> </p>
    @endif

    @if($lists)
        <ul>
            @foreach($lists as $key => $list)
                <li>
                    <a href="{{ route('lists', array($list->hid())) }}">{{ $list->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif

@endsection