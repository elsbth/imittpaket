@extends('layouts.app')

@section('content')
    <h1>{{ __('Reset Password') }}</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form--narrow">
        @csrf

        <div class="form__field">
            <label for="email">{{ __('E-mail address') }}</label>

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form__field">
            <button type="submit" class="btn btn--primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection
