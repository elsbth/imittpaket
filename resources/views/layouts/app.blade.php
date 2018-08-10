<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - i mitt Paket</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body>
	<?php
	$currentNavItem = $__env->yieldContent('currentNavItem');

	//var_dump($session);
	?>

	@include('includes.header', ['currentNavItem' => $currentNavItem])

    <div class="wrapper">

        @hasSection('sidebar.left')
            <div class="sidebar sidebar--left">
                @yield('sidebar.left')
            </div>
        @endif
        <div class="content">

            @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>


	@include('includes.footer')


    @stack('scripts')
</body>
</html>