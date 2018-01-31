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
//Route::post('services/ajax-bad-links', function (){
//    //echo ($_POST["createHTMLFile"]);
//    print_r($_POST);
//});
Route::post('services/ajax-bad-links','ServiceController@ajaxBadLinks');
Route::post('services/ajax-bad-links-load-file','ServiceController@ajaxLoadFile');
Route::post('services/ajax-get-all-links','ServiceController@ajaxGetAllLinks');
Route::post('services/ajax-get-links-show-data','ServiceController@showDataFromFile');
Route::post('services/ajax-get-links-show-all-files','ServiceController@showAllFiles');
Route::post('services/ajax-sitemap-step','ServiceController@sitemapStep2');
Route::post('services/ajax-sitemap-step3-from-area','ServiceController@sitemapStep3');
Route::post('services/ajax-sitemap-load-file','ServiceController@ajaxLoadFileForSitemap');
Route::post('services/ajax-sitemap-step3-from-exist-file','ServiceController@sitemapStep3ForExistFile');

Route::get('ajax-request/get-all-links/{link}/{domain}','AjaxController@getAllLinks');