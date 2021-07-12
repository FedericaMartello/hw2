<?php


use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', 'LoginController@login');
Route::post('login', 'LoginController@checkLogin');

Route::get('home', 'HomeController@home');
Route::get('feed', 'FeedController@feed');

Route::get('orders', 'OrderController@index');
Route::get('hw2/public/orders/type/{q}', 'OrderController@checkType');
Route::get('orders/get_info/{o}', 'OrderController@get_order_informations');
Route::get('delete/ordine/{o}', 'OrderController@delete_order');


Route::get('home/data/{d}/ora/{t}', 'OrderController@newOrder');
Route::get('home/ordine/{o}/prodotto/{p}/quantita/{q}', 'OrderController@completeorder');

Route::get('foto', 'FotoController@index');
Route::get('foto/query/{query}','FotoController@unsplash');


Route::get('recipes', 'RecipesController@index');
Route::get('recipes/query/{query}','RecipesController@spoonacular');


Route::get('ingredients', 'IngredientsController@index');
Route::get('get_ingredients', 'IngredientsController@AllIngredients');
Route::get('ingredients/i1/{i1}', 'IngredientsController@WhatInside_1');
Route::get('ingredients/i1/{i1}/i2/{i2}', 'IngredientsController@WhatInside_2');
Route::get('ingredients/i1/{i1}/i2/{i2}/i3/{i3}', 'IngredientsController@WhatInside_3');

Route::get('logout', 'LoginController@logout');

Route::get('signup', 'RegisterController@index');
Route::post('signup', 'RegisterController@create');
Route::get("hw2/public/signup/username/{q}", "RegisterController@checkUsername");
