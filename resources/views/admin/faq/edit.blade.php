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
    <h1><i class="fas fa-life-ring"></i> {{ __('Edit :name', ['name' => $faq->question]) }}</h1>
    <p><a href="{{ route('admin.faq') }}">&laquo; {{ __('Back to FAQs') }}</a></p>

    <form method="POST" action="{{ route('admin.faq.store', array($faq->hid())) }}">
        @csrf

        <div class="form-group row">
            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

            <div class="col-md-6">
                <textarea id="question"
                          class="form-control{{ $errors->store->has('question') ? ' is-invalid' : '' }}"
                          name="question"
                >{{ old('question', $faq->question) }}</textarea>
                @if ($errors->store->has('question'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->store->first('question') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

            <div class="col-md-6">
                <textarea id="answer"
                          class="form-control{{ $errors->store->has('answer') ? ' is-invalid' : '' }}"
                          name="answer"
                >{{ old('answer', $faq->answer) }}</textarea>
                @if ($errors->store->has('answer'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->store->first('answer') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

            <div class="col-md-6">
                <input type="number"
                       id="position"
                       class="form-control{{ $errors->store->has('position') ? ' is-invalid' : '' }}"
                       name="position"
                       value="{{ old('position', $faq->position) }}">
                @if ($errors->store->has('position'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->store->first('position') }}</strong>
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
