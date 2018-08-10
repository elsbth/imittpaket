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

Auth::routes();

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

Route::get('/lists/{hid?}', 'WishlistController@index')->name('lists')->middleware('auth');
Route::post('/lists', 'WishlistController@create')->name('lists.create')->middleware('auth');

Route::get('/list/{hash}', 'WishlistController@view')->name('list.view');

Route::get('/items/{hid?}', 'ItemController@index')->name('items')->middleware('auth');
Route::post('/item/add', 'ItemController@create')->name('item.create')->middleware('auth');
Route::post('/item/addtolist', 'ItemController@addToList')->name('item.addtolist')->middleware('auth');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/store/{hid}', 'ProfileController@store')->name('profile.store');

Route::get('/faq/{hid?}', 'FaqController@index')->name('faq');

Route::get('/sign-up', function () {
    return view('user.create');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');