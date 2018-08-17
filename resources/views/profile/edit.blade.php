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
    <h1>{{ __('Edit :name', ['name' => $currentUser->name]) }}</h1>
    <p><a href="{{ route('profile') }}">{{ __('Back to profile') }}</a></p>
    <p>{{ __('Email can\'t be updated at the moment') }}</p>

    <form method="POST" action="{{ route('profile.store', $currentUser->hid()) }}" class="form">
        @csrf

        <div class="form__field">
            <label for="name">{{ __('Name') }}</label>

            <input type="text"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   id="name"
                   name="name"
                   value="{{ old('name', $currentUser->name) }}"
                   autocomplete="off"
                   required />

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form__field">
            <label for="birthday">{{ __('Birthday') }}</label>

            <input type="date"
                   class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                   id="birthday"
                   name="birthday"
                   value="{{ old('birthday', $currentUser->birthday) }}"
                   autocomplete="off"
                   pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                   placeholder="{{ __('YYYY-MM-DD') }}" />

            @if ($errors->has('birthday'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
        </div>

        <div class="form__field">
            <label for="password">{{ __('Password') }}</label>

            <input type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   id="password"
                   name="password"
                   autocomplete="off"/>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form__field">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        </div>

        <div class="form__actions">
            <button type="submit" class="btn btn--primary">
                {{ __('Save changes') }}
            </button>
        </div>
    </form>

    <hr />

@endsection

@section('sidebar.left')
@endsection
