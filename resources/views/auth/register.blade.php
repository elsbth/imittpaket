@extends('layouts.app')

@section('title', __('Register'))
@section('currentNavItem', 'register')


@section('content')
    @if ($lockRegistration)
        <h1>{{ __('Register with invite') }}</h1>
        <p>{{ __('Hi :name! You\'re a VIP.', ['name' => $invite->name]) }}
        <br />{{ __('Please complete the registration below to create your account.') }}</p>
        @if (!$invite)
            <p>{{ __('No access') }}</p>
        @endif
    @else
        <h1>{{ __('Register') }}</h1>
    @endif

    @if (($lockRegistration && $invite) || (!$lockRegistration))

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form__field">
                <label for="name">{{ __('Name') }}</label>

                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $invite ? old('name', $invite->name) : old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__field">
                <label for="birthday">{{ __('Birthday') }}</label>

                <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="{{ __('YYYY-MM-DD') }}">

                @if ($errors->has('birthday'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__field">
                <label for="email">{{ __('E-mail address') }} {{ ($lockRegistration && $invite) ? __('(this field is locked to the value from the invite sign-up)') : null }}</label>

                @if ($invite)
                    <input id="email" type="email" readonly disabled class="form-control" name="email" value="{{ $invite->maskedEmail() }}">
                @else
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @endif

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__field">
                <label for="password">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__field">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form__actions">
                @if ($lockRegistration && $invite)
                    <input type="hidden" name="control" value="{{ $invite->token }}" required>
                @endif
                <button type="submit" class="btn btn--primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    @endif
@endsection
