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

Route::middleware([ 'auth'])->group(function () {
//    Alle routes in deze groep zijn beschermd door de auth middleware
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');
    // Resource zorgt ervoor dat alle methods in de controller aangeroepen worden, zodat je niet voor elke method
    // een route moet maken. Zie php artisan route:list
    Route::get('posts/search', 'PostController@search')->name('posts.search');
    Route::get('posts/{category}/filter', 'PostController@filter')->name('posts.filter');
    Route::resource('posts', 'PostController')->middleware('auth');

});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{user}/undo-admin', 'UsersController@undoAdmin')->name('users.undo-admin');
});
