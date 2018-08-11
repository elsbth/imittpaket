<?php

$currentNav = isset($currentNavItem) ? $currentNavItem : '/';

$isAuth = auth()->check();

$leftNavItems = array(
	route('home') => __('Start'),
);

$authNavItems = array(
	route('lists') => __('Lists'),
	route('items') => __('Items'),
);

$rightNavItems = array(
	route('faq') => __('FAQ'),
	route('about') => __('About'),
);

$friendsNavItems = array(
	'/friends' => __('[Friends]'),
);

if ($isAuth) {
    $leftNavItems = array_merge($leftNavItems, $authNavItems);
    $rightNavItems = array_merge($friendsNavItems, $rightNavItems);
}

$adminNavItems = array(
	route('admin') => __('Dashboard'),
	route('admin.faq') => __('FAQ'),
	route('admin.users') => __('Users'),
	route('admin.invites') => __('Invites'),
);
?>

<div style="position:fixed; top: 0; right: 0; padding: 3px 5px;">
	[ LOCALE: {{ App::getLocale() }} ]
	[ URL: {{ $currentNav }} ]
	[ {{ $isAdmin }} ]
	[ PERMISSION:  {{ $permission }} ]

</div>

<header>

	<img src="{{ asset('images/imittpaket_beta_logo_square.png') }}" alt="i mitt Paket" />

    @if($isAdmin)

    	<nav class="nav--admin">
			<ul class="nav__list nav__list--admin">
				@foreach($adminNavItems as $key => $item)
					<li class="nav__item">
						<a href="{{$key}}" class="nav__link {{ ($key == $currentNav) ? 'nav__link--current' : '' }}">
							{{$item}}
						</a>
				</li>
				@endforeach
			</ul>
    	</nav>

    @endif

	<nav>
		<div class="nav__container nav__container--left">
			<ul class="nav__list nav__list--user">
				@foreach($leftNavItems as $key => $item)
					<li class="nav__item">
						<a href="{{$key}}" class="nav__link {{ ($key == $currentNav) ? 'nav__link--current' : '' }}">
							{{$item}}
						</a>
					</li>
				@endforeach

				@if($isAuth)
					<li class="nav__item">
						<a class="nav__link {{ ($currentNav == 'profile') ? 'nav__link--current' : '' }}" href="{{ route('profile') }}">{{ __('Profile') }}</a>
					</li>
				@else
					<li class="nav__item">
						<a class="nav__link {{ ($currentNav == 'register') ? 'nav__link--current' : '' }}" href="/register">{{ __('Create account') }}</a>
					</li>
					<li class="nav__item">
						<a class="nav__link {{ ($currentNav == 'login') ? 'nav__link--current' : '' }}" href="/login">{{ __('Log in') }}</a>
					</li>
				@endif
			</ul>
		</div>

		<div class="nav__container nav__container--right">
			<ul class="nav__list nav__list--general">
				@foreach($rightNavItems as $key => $item)
					<li class="nav__item">
						<a href="{{$key}}" class="nav__link {{ ($key == $currentNav) ? 'nav__link--current' : '' }}">
							{{$item}}
						</a>
					</li>
				@endforeach

				@if($isAuth)
					<li class="nav__item nav__item--logout">
						<a class="nav__link" href="/logout">{{ __('Log out') }}</a>
					</li>
				@endif
			</ul>
		</div>
	</nav>

</header>