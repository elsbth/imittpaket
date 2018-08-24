<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
//Auth::routes();

// Instead of Auth:routes() --- start
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register/{token?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Instead of Auth:routes() --- end

Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');

Route::get('/admin/users','AdminController@users')->name('admin.users')->middleware('admin');
Route::get('/admin/users/{hid}','AdminController@users')->name('admin.users.userid')->middleware('admin');

Route::get('/admin/faq','Admin\FaqController@index')->name('admin.faq')->middleware('admin');
Route::get('/admin/faq/add','Admin\FaqController@add')->name('admin.faq.add')->middleware('admin');
Route::post('/admin/faq/add','Admin\FaqController@create')->name('admin.faq.create')->middleware('admin');
Route::get('/admin/faq/edit/{hid}','Admin\FaqController@edit')->name('admin.faq.edit')->middleware('admin');
Route::post('/admin/faq/store/{hid}','Admin\FaqController@store')->name('admin.faq.store')->middleware('admin');
Route::get('/admin/faq/{hid}','Admin\FaqController@index')->name('admin.faq.view')->middleware('admin');

Route::get('/admin/invites/{hid?}','Admin\InviteController@index')->name('admin.invites')->middleware('admin');
Route::post('/admin/invites','Admin\InviteController@create')->name('admin.invites.create')->middleware('admin');
Route::get('/admin/invites/{hid}/delete', 'Admin\InviteController@delete')->name('admin.invite.delete')->middleware('admin');

Route::get('/lists/{hid?}', 'WishlistController@index')->name('lists')->middleware('auth');
Route::get('/lists/edit/{hid}', 'WishlistController@edit')->name('list.edit')->middleware('auth');
Route::post('/lists/store/{hid}', 'WishlistController@store')->name('list.store')->middleware('auth');
Route::get('/lists/{hid}/delete', 'WishlistController@delete')->name('list.delete')->middleware('auth');
Route::post('/lists', 'WishlistController@create')->name('lists.create')->middleware('auth');

Route::get('/list/give/{list_token}/{giver_token?}', 'GiverController@index')->name('list.giver');
Route::post('/list/give/add','GiverController@create')->name('list.giver.create');

Route::get('/list/{hash}', 'WishlistController@view')->name('list.view');

Route::get('/items/{hid?}', 'ItemController@index')->name('items')->middleware('auth');
Route::get('/items/edit/{hid}', 'ItemController@edit')->name('item.edit')->middleware('auth');
Route::post('/items/store/{hid}', 'ItemController@store')->name('item.store')->middleware('auth');
Route::get('/items/{hid}/delete', 'ItemController@delete')->name('item.delete')->middleware('auth');

Route::post('/item/add', 'ItemController@create')->name('item.create')->middleware('auth');
Route::post('/item/addtolist', 'ItemController@addToList')->name('item.addtolist')->middleware('auth');

Route::get('/account', 'ProfileController@index')->name('profile');
Route::get('/account/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/account/store/{hid}', 'ProfileController@store')->name('profile.store');

Route::get('/faq/{hid?}', 'FaqController@index')->name('faq');

//Route::get('/sign-up', function () { return view('user.create'); });

Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/changelog', function () { return view('changelog'); })->name('changelog');
Route::get('/cookies', function () { return view('cookies'); })->name('cookies');
Route::get('/privacy-policy', function () { return view('privacypolicy'); })->name('privacy-policy');
