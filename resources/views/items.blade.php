@extends('layouts.app')

@section('title', __('Items'))
@section('currentNavItem', '/items')

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')

    @if($currentItem)

        <h1>List: {{ $currentItem->title }} ({{ $currentItem->id }})</h1>

        <table>
            <tr>
                <td>{{ __('Id') }}</td>
                <td>{{ $currentItem->id }}</td>
            </tr>
            <tr>
                <td>{{ __('Name') }}</td>
                <td>{{ $currentItem->name }}</td>
            </tr>
            <tr>
                <td>{{ __('Description') }}</td>
                <td>{{ $currentItem->description }}</td>
            </tr>
            <tr>
                <td>{{ __('Link') }}</td>
                <td>{{ $currentItem->link }}</td>
            </tr>
            <tr>
                <td>{{ __('Qty') }}</td>
                <td>{{ $currentItem->qty }}</td>
            </tr>
            <tr>
                <td>{{ __('Price') }}</td>
                <td>{{ $currentItem->price }}</td>
            </tr>
            <tr>
                <td>{{ __('Created') }}</td>
                <td>{{ $currentItem->created_at->format('Y-m-d') }}</td>
            </tr>
        </table>

        <h2>Add to list</h2>

        @if($lists)

            <form action="{{ route('item.addtolist') }}" method="post">
                @if ($errors->any())
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

                @if($errors->has('wishlist_id'))
                    <span class="help-block">{{ $errors->first('wishlist_id') }}</span>
                @endif

                <input type="hidden" name="item_id" value="{{ $currentItem->id }}" />
                <button type="submit" class="btn btn-default">Submit</button>
            </form>


        @else
            <p>{{ __('To add items to a list, start with Creating a list') }}</p>
        @endif

    @else
        <div class="container">
            <div class="row">
                <h1>Create an item</h1>
                <form action="{{ route('item.create') }}" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Please fix the following errors
                        </div>
                    @endif

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Title" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
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
                        [LINK]
                        <br />[QTY]
                        <br />[PRICE]
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
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
                    <a href="{{ route('items', array($item->id)) }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif

@endsection