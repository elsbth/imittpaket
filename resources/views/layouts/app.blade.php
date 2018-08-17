<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - i mitt Paket</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/global.js') }}"></script>
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