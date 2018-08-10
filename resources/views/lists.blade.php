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

        <table>
            <tr>
                <td>{{ __('Id') }}</td>
                <td>{{ $currentList->hid() }}</td>
            </tr>
            <tr>
                <td>{{ __('Title') }}</td>
                <td>{{ $currentList->title }}</td>
            </tr>
            <tr>
                <td>{{ __('Description') }}</td>
                <td>{{ $currentList->description }}</td>
            </tr>
            <tr>
                <td>{{ __('Date') }}</td>
                <td>{{ $currentList->date }}</td>
            </tr>
            <tr>
                <td>{{ __('Public link') }}</td>
                <td><a href="{{ $publicLink }}">{{ $publicLink }}</a></td>
            </tr>
            <tr>
                <td>{{ __('Created') }}</td>
                <td>{{ $currentList->created_at->format('Y-m-d') }}</td>
            </tr>
        </table>

        <hr />
        <p>
            <strong>{{ __('Actions:') }}</strong>
            <br /><a href="{{ route('list.delete', $currentList->hid()) }}" onclick="return confirm('{{ __('Are you sure you want to delete? This action can not be undone') }}')">{{ __('Delete this list') }}</a>
        </p>

        @if ($itemsOnList)
            <h2>{{ __('Items on this list') }}</h2>
            <ul>
                @foreach ($itemsOnList as $item)
                    <li>
                        <strong>{{ $item->name }}</strong>
                        <p>{{ $item->description }}</p>
                        <p>{{ $item->price }} @if ($item->link) <a href="{{ $item->link }}">{{ $item->link }}</a>@endif</p>
                    </li>
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
                    <label for="title">Title</label>
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
                <div class="form-group">
                    [DATE]
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