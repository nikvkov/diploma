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
Route::post('services/ajax-sitemap-step3-show-created-files','ServiceController@sitemapStep3ShowCteatedFiles');

Route::get('ajax-request/get-all-links/{link}/{domain}','AjaxController@getAllLinks');
Route::get('subscribe/all-emails','SubscribeController@getAllEmails');
Route::get('subscribe/add-email/{email}','SubscribeController@addNewEmail');
Route::get('subscribe/add-user-data','SubscribeController@addUserAdditionalData');

Route::get('test','SubscribeController@testUser');

Route::get('my-account','MyAccountController@showMyAccountDashboard');
Route::get('my-account/show-file-info','MyAccountController@showDataFromAllFIle');
Route::get('my-account/show-file-in-project','MyAccountController@showDataFromFIleInProject');
Route::get('my-account/show-detail-data','MyAccountController@showDetailData');
Route::get('my-account/show-file-in-service','MyAccountController@showDataFromFIleInService');
Route::get('my-account/search-file','MyAccountController@searchFile');
Route::get('my-account/create-all-file-order','MyAccountController@createOrderForAllFile');
Route::get('my-account/create-order-file-in-project','MyAccountController@createOrderForProjectFile');
Route::get('my-account/create-order-file-in-service','MyAccountController@createOrderForServiceFile');
Route::get('my-account/show-page','MyAccountController@showPage');
Route::get('my-account/show-order-info','MyAccountController@showDataFromAllOrder');
Route::get('my-account/show-order-in-project','MyAccountController@showDataFromOrderInProject');
Route::get('my-account/show-detail-data-for-order','MyAccountController@showDetailDataForOrder');
Route::get('my-account/show-order-in-service','MyAccountController@showDataFromOrderInService');
Route::get('my-account/search-order','MyAccountController@searchOrder');
Route::get('my-account/get-message-body','MyAccountController@getMessageBody');
Route::get('my-account/get-event-body','MyAccountController@getEventBody');
Route::get('my-account/search-event','MyAccountController@searchEvent');
Route::get('my-account/search-message','MyAccountController@searchMessage');
Route::get('my-account/search-read-event','MyAccountController@searchReadEvents');
Route::get('my-account/search-noread-event','MyAccountController@searchNoReadEvents');
Route::get('my-account/search-read-message','MyAccountController@searchReadMessages');
Route::get('my-account/search-noread-message','MyAccountController@searchNoReadMessages');

//test
Route::get('my-test','SubscribeController@testUser');