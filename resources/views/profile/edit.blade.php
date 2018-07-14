<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Edit :name', ['name' => $currentUser->name]))
@section('currentNavItem', 'profile')

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <pre>{{$currentUser}}</pre>
    <h1>{{ __('Edit :name', ['name' => $currentUser->name]) }}</h1>
    <p><a href="{{ route('profile') }}">{{ __('Back to profile') }}</a></p>
    <table>
    	<tr>
    		<td>{{ __('Name') }}</td>
    		<td>{{ $currentUser->name }}</td>
    	</tr>
    	<tr>
    		<td>{{ __('Email') }}</td>
    		<td>{{ $currentUser->email }} ({{ __('Email can\'t be updated at the moment') }})</td>
    	</tr>
    	<tr>
    		<td>{{ __('Birthday') }}</td>
    		<td>{{ $currentUser->birthday }}</td>
    	</tr>
    	<tr>
    		<td>{{ __('Member since') }}</td>
    		<td>{{ $currentUser->created_at->format('Y-m-d') }}</td>
    	</tr>
    </table>

    <form method="POST" action="{{ route('profile.store', $currentUser->id) }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                {{ $currentUser->name }}

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

            <div class="col-md-6">
                <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="{{ __('YYYY-MM-DD') }}">
                {{ $currentUser->birthday }}

                @if ($errors->has('birthday'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('birthday') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save changes') }}
                </button>
            </div>
        </div>
    </form>

    <hr />

@endsection

@section('sidebar.left')
@endsection
