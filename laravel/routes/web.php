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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories', 'CategoriesController');
// Resource zorgt ervoor dat alle methods in de controller aangeroepen worden, zodat je niet voor elke method
// een route moet maken. Zie php artisan route:list

Route::resource('posts', 'PostController');
