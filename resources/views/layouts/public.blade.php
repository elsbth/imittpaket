<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-19382374-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-19382374-1');
    </script>

    <meta charset="utf-8">
    <meta name="description" content="{{ __('Add the items you wish for to your list. Share the list with your friends.') }}">
    <meta name="author" content="elsbth.se">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - i mitt Paket</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/global.js') }}"></script>
    @stack('styles')

</head>
<body>
	<?php
	$currentNavItem = $__env->yieldContent('currentNavItem');

	//var_dump($session);
	?>

    @include('cookieConsent::index')


    <header class="header--public">
        <a href="{{ route('home') }}" class="link--logo-header-public">
            <img src="{{ asset('images/logo-test-1row.png') }}" alt="i mitt Paket" class="logo--1row" />
        </a>

    </header>

    <div class="wrapper">
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