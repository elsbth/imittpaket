<?php

$currentNav = isset($currentNavItem) ? $currentNavItem : '/';

$navItems = array(
	'/' => __('Start'),
	'/faq' => __('FAQ'),
	'/lists' => __('Lists'),
	'/items' => __('Items'),
);

$adminNavItems = array(
	'/admin' => __('Dashboard'),
	'/admin/faq' => __('FAQ'),
	'/admin/users' => __('Users'),
);
?>

<div style="position:fixed; top: 0; right: 0; padding: 3px 5px;">
	[ LOCALE: {{ App::getLocale() }} ]
	[ URL: {{ $currentNav }} ]
	[ {{ $isAdmin }} ]
	[ PERMISSION:  {{ $permission }} ]

</div>

<header>

	<img src="{{ asset('images/logo-tmp.png') }}" alt="i mitt Paket" />

    @if($isAdmin)

    	<nav>
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
		<ul class="nav__list">

			@foreach($navItems as $key => $item)
				<li class="nav__item">
					<a href="{{$key}}" class="nav__link {{ ($key == $currentNav) ? 'nav__link--current' : '' }}">
						{{$item}}
					</a>
				</li>
			@endforeach

            @if(auth()->check())
                <li class="nav__item">
                    <a class="nav__link {{ ($currentNav == 'profile') ? 'nav__link--current' : '' }}" href="/profile">{{ __('Profile (:name)', ['name' => Auth::user()->name]) }}</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="/logout">{{ __('Log out') }}</a>
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
	</nav>

</header>