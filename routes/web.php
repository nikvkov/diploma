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

//get('/', ['as' => 'main', 'uses' => 'IndexController@index']);

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

 //Route::get('/home', 'HomeController@index');
Route::get('/', 'IndexController@index');
Route::get('projects', 'IndexController@projectsList');
Route::get('projects/{slug}', 'IndexController@projectsCart');
Route::get('about-us', 'IndexController@about');
Route::get('contact-us', 'IndexController@contacts');
Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@cart');
//get('projects', ['as' => 'projectsList', 'uses' => 'IndexController@projectsList']);

Route::get('projects/{slug}/{path}', 'ServiceController@showService');