<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Admin - FAQ - edit'))
@section('currentNavItem', '/admin/faq/edit')

@push('styles')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush

@push('scripts')
@endpush


<!-- build page content -->


@section('content')
    <h1>{{ __('Edit :name', ['name' => $faq->name]) }}</h1>
    <p><a href="{{ route('admin.faq.view', array($faq->id)) }}">{{ __('Back to FAQ') }}</a></p>

    <form method="POST" action="{{ route('admin.faq.store', array($faq->id)) }}">
        @csrf

        <div class="form-group row">
            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

            <div class="col-md-6">
                <textarea id="question" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question"
                >{{ old('question') }}</textarea>
                {{ $faq->question }}

                @if ($errors->has('question'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

            <div class="col-md-6">
                <textarea id="answer" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer"
                >{{ old('answer') }}</textarea>
                {{ $faq->answer }}

                @if ($errors->has('answer'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

            <div class="col-md-6">
                <input id="position" type="number" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}">
                {{ $faq->position }}

                @if ($errors->has('position'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                @endif
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
