<?php

$currentNav = isset($currentNavItem) ? $currentNavItem : '/';

$isAuth = auth()->check();
$lockRegistration = true;
$debug = false;

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
//	'/friends' => __('[Friends]'),
);

if ($isAuth) {
    $leftNavItems = array_merge($leftNavItems, $authNavItems);
    $rightNavItems = array_merge($friendsNavItems, $rightNavItems);
}

$adminNavItems = array(
	route('admin') => __('Admin:'),
	route('admin.faq') => __('FAQ'),
	route('admin.users') => __('Users'),
	route('admin.givers') => __('Givers'),
	route('admin.invites') => __('Invites'),
	route('admin.itemcategories') => __('Item categories'),
);
?>

@if ($debug)
	<div style="position:fixed; top: 0; right: 0; padding: 3px 5px;">
		[ LOCALE: {{ App::getLocale() }} ]
		[ URL: {{ $currentNav }} ]
		[ {{ $isAdmin }} ]
		[ PERMISSION:  {{ $permission }} ]

	</div>
@endif

<header class="{{ $isAdmin ? 'header--admin'  :'' }}">

	<a href="{{ route('home') }}" class="link--logo-header">
		<img src="{{ asset('images/logo-test-2rows.png') }}" alt="i mitt Paket" class="logo--header" />
	</a>

    @if($isAdmin)

    	<nav class="nav--admin">
			<ul class="nav__list nav__list--admin">
				@foreach($adminNavItems as $key => $item)
					<?php $current = $key == $currentNav ?>
					<li class="nav__item {{ ($current) ? 'nav__item--current' : '' }}">
						<a href="{{$key}}" class="nav__link {{ ($current) ? 'nav__link--current' : '' }}">
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
                    <?php $current = $key == $currentNav ?>
					<li class="nav__item {{ ($current) ? 'nav__item--current' : '' }}">
						<a href="{{$key}}" class="nav__link {{ ($current) ? 'nav__link--current' : '' }}">
							{{$item}}
						</a>
					</li>
				@endforeach

				@if($isAuth)
					<li class="nav__item {{ ($currentNav == route('profile')) ? 'nav__item--current' : '' }}">
						<a class="nav__link {{ ($currentNav == route('profile')) ? 'nav__link--current' : '' }}" href="{{ route('profile') }}">{{ __('Account') }}</a>
					</li>
				@else
					@if (!$lockRegistration)
						<li class="nav__item {{ ($currentNav == 'register') ? 'nav__item--current' : '' }}">
							<a class="nav__link {{ ($currentNav == 'register') ? 'nav__link--current' : '' }}" href="{{ route('register') }}">{{ __('Create account') }}</a>
						</li>
					@endif
					<li class="nav__item {{ ($currentNav == 'login') ? 'nav__item--current' : '' }}">
						<a class="nav__link {{ ($currentNav == 'login') ? 'nav__link--current' : '' }}" href="{{ route('login') }}">{{ __('Log in') }}</a>
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
			</ul>
		</div>
	</nav>

</header>