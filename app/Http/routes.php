<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('proba.php', function(){
		return response()->json(session('cart'));
});

Route::post('send-email', [
		'as' => 'sendEmail',
		'uses' => 'ItemController@sendEmailReminder'
	]);

Route::get('add-to-cart/{id}', [
		'as' => 'item.addToCart',
		'uses' => 'CartController@addToCart'
	]);

Route::get('reduce-one/{id}', [
		'as' => 'item.reduceByOne',
		'uses' => 'CartController@getReduceByOne'
	]);

Route::get('reduce-all/{id}', [
		'as' => 'item.removeItem',
		'uses' => 'CartController@getRemoveItem'
	]);

Route::get('shopping-cart', [
	'as' => 'item.showCart',
	'uses' => 'CartController@showCart'
	]);

Route::get('checkout', [
		'as' => 'shop.checkout',
		'uses' => 'CartController@getCheckout'
	]);

Route::post('checkout', [
		'as' => 'shop.checkout',
		'uses' => 'CartController@postCheckout'
	]);

Route::get('/', [
// 'middleware' => 'auth',
		'as' => 'index',
		'uses' => 'CategoryController@index',
	]);
// KATEGORIJE
Route::get('kategorije', [
		'as' => 'kategorije.index',
		'uses' => 'CategoryController@index'
	]);
Route::get('kategorije/{kategorije}', [
		'as' => 'kategorije.show',
		'uses' => 'CategoryController@show'
	]);
Route::resource('categories', 'CategoryController', [
		'only' => [ 'store',  'destroy'],
	]);

// POTKATEGORIJE
Route::delete('subcats/{subcat}', [
	'uses' => 'SubcatController@destroy',
	'as' => 'subcats.destroy'
	]);

Route::get('kategorije/{kategorije}/{potkategorije}', [
		'as' => 'kategorije.potkategorije.show',
		'uses' => 'SubcatController@show'
	]);

Route::resource('categories.subcats', 'SubcatController');

// ITEMS
Route::resource('items', 'ItemController');

// ITEMS - PONUDE

Route::group(['prefix' => 'ponude'], function(){
	Route::get('novo', 'ItemController@novo');
	Route::get('popular', 'ItemController@popular');
	Route::get('akcija', 'ItemController@akcija');
});

// ITEMS - INACTIVE
Route::group(['prefix' => 'inactive'], function(){
	Route::get('/', ['as' => 'inactive', 'uses' => 'ItemController@showTrashed']);
	Route::get('/{item}', ['as' => 'inactive.item', 'uses' => 'ItemController@restoreTrashed']);
	Route::delete('/{item}', ['as' => 'inactive.delete', 'uses' => 'ItemController@deleteTrashed']);
});

Route::get('carousel', [
	'middleware' => 'auth',
	'as' => 'carousel.index',
	'uses' => 'CarouselController@index'
]);

Route::post('carousel', [
	'middleware' => 'auth',
	'as' => 'carousel.store',
	'uses' => 'CarouselController@store'
]);

Route::get('andor-admin', function(){
	return view('auth.login');
});

Route::post('andor-admin', 'Auth\AuthController@login');

Route::get('logout', 'Auth\AuthController@logout');