<?php
$isAuth = auth()->check();
?>

@extends('layouts.app')

@section('title', __('Welcome'))
@section('currentNavItem', route('home'))

@section('content')

    @auth
        <div class="dashboard-links__wrapper">
            <a href="{{ route('lists') }}" class="dashboard-link" title="{{ __('Create your own wishlists') }}">
                <i class="fas fa-list dashboard-link__icon"></i>
                <span class="dashboard-link__label">{{ __('Lists') }}</span>
            </a>
            <a href="{{ route('items') }}" class="dashboard-link" title="{{ __('Create items and add them to your lists') }}">
                <i class="fas fa-gift dashboard-link__icon"></i>
                <span class="dashboard-link__label">{{ __('Items') }}</span>
            </a>
            <a href="{{ route('faq') }}" class="dashboard-link" title="{{ __('Have a question about how the site is working?') }}">
                <i class="fas fa-life-ring dashboard-link__icon"></i>
                <span class="dashboard-link__label">{{ __('FAQ') }}</span>
            </a>
            <a href="{{ route('profile') }}" class="dashboard-link" title="{{ __('Edit your account details') }}">
                <i class="fas fa-user-cog dashboard-link__icon"></i>
                <span class="dashboard-link__label">{{ __('Account') }}</span>
            </a>
        </div>
    @endauth

    @guest
        <h1>{{ __('Welcome to i mitt Paket!') }}</h1>

        <p style="font-style: italic">{{ __('Sorry about the mess... I\'m building from scratch!') }}</p>

        <p>{!! __('Access is currently <b>invites only</b>. <b>Sign up</b> below and to get updates and, eventually, an invite.') !!}</p>
        <p>{{ __('Please follow') }} <a href="http://www.facebook.com/apps/application.php?id=156385977730812">{{ __('i mitt Paket on Facebook') }}</a></p>

        <hr />
        <h2>{{ __('Invite sign up') }}</h2>

        <!-- Begin MailChimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
            /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
               We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div id="mc_embed_signup" class="form--narrow" style="margin: 0 auto;">
            <form action="https://imittpaket.us19.list-manage.com/subscribe/post?u=c0253123be7b46b4bf8f7c8bb&amp;id=e42289ea51" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                    <div class="indicates-required"><span class="asterisk">*</span> Required field</div>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email address  <span class="asterisk">*</span>
                        </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Name  <span class="asterisk">*</span>
                        </label>
                        <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
                    </div>
                    <div class="mc-field-group size1of2">
                        <label for="mce-BIRTHDAY-month">Birthday </label>
                        <div class="datefield">
                            <span class="subfield monthfield"><input class="birthday " type="text" pattern="[0-9]*" value="" placeholder="MM" size="2" maxlength="2" name="BIRTHDAY[month]" id="mce-BIRTHDAY-month"></span> /
                            <span class="subfield dayfield"><input class="birthday " type="text" pattern="[0-9]*" value="" placeholder="DD" size="2" maxlength="2" name="BIRTHDAY[day]" id="mce-BIRTHDAY-day"></span>
                            <span class="small-meta nowrap">( mm / dd )</span>
                        </div>
                    </div>	<div id="mce-responses" style="clear:both;">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c0253123be7b46b4bf8f7c8bb_e42289ea51" tabindex="-1" value=""></div>
                    <div style="clear:both;"><input type="submit" value="Sign up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
    @endguest

    <hr />
    <p>{{ __('See updates to the site in the') }} <a href="{{ route('changelog') }}">{{ __('changelog') }}</a>.</p>
@endsection
