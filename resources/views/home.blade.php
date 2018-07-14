@extends('layouts.app')

@section('title', '')
@section('currentNavItem', '/')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <dl>
                        <dt>mitt_vardagsliv</dt>
                        <dd>admin</dd>
                        <dd>pwd: laravel</dd>
                        <dt>anna@example.com</dt>
                        <dd>??</dd>
                        <dt>user@example.com</dt>
                        <dd>user</dd>
                        <dd>pwd: laravel</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
