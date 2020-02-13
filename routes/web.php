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
Route::get('/profile', 'UserController@show');
Route::get('/blog', 'PostController@add');
Route::post('/blog', 'PostController@addComplite');
Route::get('/blog/delete/{id}', 'PostController@delete');
Route::get('/card', 'CardController@index');
Route::post('/card', 'CardController@save');
Route::get('/card/{id}', 'CardController@getCardById');
Route::get('/card/{card_id}/{cards_with_words_id}', 'CardController@deleteWord');
Route::post('/card/{id}','CardController@addWordWithTranslation');
Route::get('/cards', 'CardController@getAllCards');
Route::get('/words/{id}', 'CardController@getAllWords');
Route::get('/test', 'CardController@test');
Route::get('/increment/{id}','CardController@increment');