@extends('layouts.app')

@section('title', __('Log in'))
@section('currentNavItem', 'login')

@section('content')
    <h1>{{ __('Login') }}</h1>
    <p>{{ __('Currently the users are VIP invites only.') }}
    <br />{{ __('If you\'re interested, use the signup form on the ') }}<a href="{{ route('home') }}">{{ __('startpage') }}</a>.</p>

    <hr />
    <form method="POST" action="{{ route('login') }}" class="form form--narrow">
        @csrf

        <div class="form__field">
            <label for="email">{{ __('E-mail address') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
        </div>

        <div class="form__actions">
            <button type="submit" class="btn btn--primary">
                {{ __('Login') }}
            </button>
        </div>
    </form>

    <hr />
    <a href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
@endsection
