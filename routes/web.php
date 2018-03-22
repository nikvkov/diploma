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

//Проверка битых ссылок
Route::post('services/ajax-bad-links','ServiceController@ajaxBadLinks');
Route::post('services/ajax-bad-links-load-file','ServiceController@ajaxLoadFile');

//Получить ссылки с сайта
Route::post('services/ajax-get-all-links','ServiceController@ajaxGetAllLinks');
Route::post('services/ajax-get-links-show-data','ServiceController@showDataFromFile');
Route::post('services/ajax-get-links-show-all-files','ServiceController@showAllFiles');
Route::get('ajax-request/get-all-links/{link}/{domain}','AjaxController@getAllLinks');

//создание карты сайта
Route::post('services/ajax-sitemap-step3-from-area','ServiceController@sitemapStep3');
Route::post('services/ajax-sitemap-load-file','ServiceController@ajaxLoadFileForSitemap');
Route::post('services/ajax-sitemap-step3-from-exist-file','ServiceController@sitemapStep3ForExistFile');
Route::post('services/ajax-sitemap-step3-show-created-files','ServiceController@sitemapStep3ShowCteatedFiles');
Route::post('services/ajax-sitemap-step','ServiceController@sitemapStep2');

//marketplace amazon
Route::get('services/amazon-marketplace-show-select-file-type','ServiceController@ajaxMPAShowStep2');
Route::post('services/amazon-marketplace-load-file','ServiceController@ajaxMPALoadFile');
Route::get('services/amazon-marketplace-parse-data-from-file','ServiceController@ajaxMPAParseDataFromFile');
Route::get('services/amazon-marketplace-show-template-data','ServiceController@ajaxMPAShowTemplateData');
Route::get('services/amazon-marketplace-show-exist-file','ServiceController@ajaxMPAShowExistFile');

/*Amazon Ads*/
Route::get('services/adwertising-amazon-ads-show-step2','ServiceController@ajaxAmazonAdsShowStep2');
Route::get('services/amazon-ads-show-product-in-file','ServiceController@ajaxAmazonAdsShowProductInFile');
Route::get('services/amazon-ads-preview-file','ServiceController@ajaxAmazonAdsPreviewFile');
Route::get('services/amazon-ads-write-file','ServiceController@ajaxAmazonAdsWriteFile');
Route::get('services/amazon-ads-show-exist-file','ServiceController@ajaxAmazonAdsShowExistFile');

/*Merchant Center*/
Route::get('services/merchant-center-show-step2','ServiceController@ajaxMerchantCenterShowStep2');
Route::post('services/merchant-center-load-file','ServiceController@ajaxMerchantCenterLoadFile');
Route::get('services/google-merchant-parse-data-from-file','ServiceController@ajaxMerchantCenterParseDataFromFile');
Route::get('services/google-merchant-preview-file','ServiceController@ajaxMerchantCenterPreviewFile');
Route::get('services/google-merchant-write-file','ServiceController@ajaxMerchantCenterWriteFile');
Route::get('services/google-merchant-show-exist-file','ServiceController@ajaxMerchantCenterShowExistFile');

/*Yandex market*/
Route::get('services/yandex-marketplace-show-select-file-type','ServiceController@ajaxYMShowStep2');
Route::post('services/yandex-marketplace-load-file','ServiceController@ajaxYMLoadFile');
Route::get('services/yandex-marketplace-parse-data-from-file','ServiceController@ajaxYMParseDataFromFile');
Route::get('services/yandex-marketplace-preview-file','ServiceController@ajaxYMPreviewFile');
Route::get('services/yandex-marketplace-write-file','ServiceController@ajaxYMWriteFile');

/*Yandex Direct*/
Route::get('services/yandex-direct-show-select-file-type','ServiceController@ajaxYDShowStep2');
Route::post('services/yandex-direct-load-file','ServiceController@ajaxYDLoadFile');
Route::get('services/yandex-direct-parse-data-from-file','ServiceController@ajaxYDParseDataFromFile');
Route::get('services/yandex-direct-write-file','ServiceController@ajaxYDWriteFile');


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


Route::get('custom-admin/messages-show','CustomAdminController@showAllMessages');
Route::get('custom-admin/messages-show-by-user/{user}','CustomAdminController@showMessagesByUser');
Route::get('custom-admin/show-current-message/{message_id}','CustomAdminController@showCurrentMessage');
Route::get('custom-admin/delete-current-message/{message_id}','CustomAdminController@deleteCurrentMessage');
Route::get('custom-admin/delete-selected-messages','CustomAdminController@deleteSelectedMessage');
Route::get('custom-admin/create-new-message','CustomAdminController@createNewMessage');
Route::get('custom-admin/send-message-to-user','CustomAdminController@sendMessageToUser');
Route::get('custom-admin/send-message-to-selected-users','CustomAdminController@sendMessageToSelectedUsers');
Route::get('custom-admin/create-order-message-to-user/{user_id}','CustomAdminController@createOrderMessageToUser');
Route::get('custom-admin/create-order-message-selected-users','CustomAdminController@createOrderMessageToSelectedUsers');
Route::get('custom-admin/create-new-mailing','CustomAdminController@createNewMailing');
Route::get('custom-admin/start-mailing','CustomAdminController@startMailing');
Route::get('custom-admin/archive-mailing','CustomAdminController@archiveMailing');
Route::get('custom-admin/show-current-mailing/{mailing_id}','CustomAdminController@showCurrentMailing');
Route::get('custom-admin/delete-current-mailing/{mailing_id}','CustomAdminController@deleteCurrentMailing');
Route::get('custom-admin/delete-selected-mailings','CustomAdminController@deleteSelectedMailings');
Route::get('custom-admin/create-order-current-mailing/{mailing_id}','CustomAdminController@createOrderCurrentMailing');
Route::get('custom-admin/create-order-selected-mailings','CustomAdminController@createOrderSelectedMailing');
Route::get('custom-admin/show-user-page','CustomAdminController@showUserPage');
Route::get('custom-admin/create-order-stat-create-file','CustomAdminController@createOrderStatFiles');
Route::get('custom-admin/create-order-stat-create-order','CustomAdminController@createOrderStatOrders');
Route::get('custom-admin/create-order-stat-create-message','CustomAdminController@createOrderStatMessages');
Route::get('custom-admin/create-order-stat-created_time','CustomAdminController@createOrderStatCreatedTime');
Route::get('custom-admin/create-order-by-current-user/{user_id}','CustomAdminController@createOrderByCurrentUser');
Route::get('custom-admin/create-order-by-selected-users','CustomAdminController@createOrderBySelectedUsers');
Route::get('custom-admin/current-user-statistic/{user_id}','CustomAdminController@getStatByCurrentUser');
Route::get('custom-admin/selected-user-statistic','CustomAdminController@getStatBySelectedUser');
Route::get('custom-admin/show-files-page','CustomAdminController@showFilesPage');
Route::get('custom-admin/create-order-by-selected-files','CustomAdminController@createOrderBySelectedFiles');
Route::get('custom-admin/show-user-orders-page','CustomAdminController@showUserOrdersPage');
Route::get('custom-admin/create-order-by-selected-user-orders','CustomAdminController@createOrderBySelectedUserOrders');
Route::get('custom-admin/show-admin-orders-page','CustomAdminController@showAdminOrdersPage');


//test
Route::get('my-test','SubscribeController@testUser');