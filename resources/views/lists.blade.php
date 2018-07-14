@extends('layouts.app')

@section('title', __('Lists'))
@section('currentNavItem', '/lists')

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentList)

        <h1>List: {{ $currentList->title }} ({{ $currentList->id }})</h1>

        <table>
            <tr>
                <td>{{ __('Id') }}</td>
                <td>{{ $currentList->id }}</td>
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
                <td>{{ __('Created') }}</td>
                <td>{{ $currentList->created_at->format('Y-m-d') }}</td>
            </tr>
        </table>

    @else
        <div class="container">
            <div class="row">
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
                    <div class="form-group">
                        [DATE]
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
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
                    <a href="{{ route('lists', array($list->id)) }}">{{ $list->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif

@endsection