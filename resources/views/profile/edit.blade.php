<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Edit :name', ['name' => $currentUser->name]))
@section('currentNavItem', route('profile'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1><i class="fas fa-user-cog"></i> {{ __('Edit account') }}</h1>
    <p><a href="{{ route('profile') }}">&laquo; {{ __('Back to account') }}</a></p>

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
            <label for="email">{{ __('E-mail address') }} ({{ __('can\'t be changed yet') }})</label>

            <input id="email" type="email" readonly disabled class="form-control" name="email" value="{{ $currentUser->email }}">

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
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

        <p>{{ __('Password') }}
            <br />{{ __('Changing password is not implemented yet.') }}</p>

        <div class="form__actions">
            <input type="hidden" name="user_id" value="{{ $currentUser->hid() }}" />
            <button type="submit" class="btn btn--primary">
                {{ __('Save changes') }}
            </button>
        </div>
    </form>

    <hr />

@endsection

@section('sidebar.left')
@endsection
