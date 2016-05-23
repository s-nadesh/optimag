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

Route::get('/', function () {
    return view('welcome');
});

// Admin area
get('admin', function () {
    return redirect('/admin/dashboard');
});

$router->group([
    'namespace' => 'Admin',
    'middleware' => 'auth',
        ], function () {
    get('admin/dashboard', 'DashboardController@index');
    get('admin/profile', 'DashboardController@getProfile');
    post('admin/profile', 'DashboardController@postProfile');

    //Editions
    resource('admin/editions', 'EditionController');
    get('admin/editions/destroy/{key}', 'EditionController@destroy');

    //Sections
    resource('admin/sections', 'SectionController');
    get('admin/sections/destroy/{key}', 'SectionController@destroy');

    //Adsense
    resource('admin/adsenses', 'AdsenseController');
    get('admin/adsenses/destroy/{key}', 'AdsenseController@destroy');
    
    //ArchiveCategory
    resource('admin/archivecategories', 'ArchiveCategoryController');
    post('admin/archivecategories/store', 'ArchiveCategoryController@store'); 
    get('admin/archivecategories/destroy/{key}', 'ArchiveCategoryController@destroy');
    
    //ArchiveImage
//    resource('admin/archiveimages', 'ArchiveImageController');
    get('admin/archiveimages/index/{key}', 'ArchiveImageController@index');
    get('admin/archiveimages/create', 'ArchiveImageController@create');
    post('admin/archiveimages/store', 'ArchiveImageController@store'); 
    get('admin/archiveimages/edit/{key}', 'ArchiveImageController@edit');
    get('admin/archiveimages/destroy/{key}', 'ArchiveImageController@destroy');
    post('admin/archiveimages/update', 'ArchiveImageController@update');
    
    //Articles
    get('admin/article/index', 'ArticleController@index');
    get('admin/article/create', 'ArticleController@create');
    post('admin/article/store', 'ArticleController@store');
    get('admin/article/edit/{key}', 'ArticleController@edit');
    get('admin/article/destroy/{key}', 'ArticleController@destroy');
    post('admin/article/update', 'ArticleController@update');
    
    //Ads
//    resource('admin/ads', 'AdsController');
    get('admin/ads/index', 'AdsController@index');
    get('admin/ads/create', 'AdsController@create');
    post('admin/ads/store', 'AdsController@store'); 
    get('admin/ads/destroy/{key}', 'AdsController@destroy');
    get('admin/ads/show/{key}', 'AdsController@show');
    get('admin/ads/previewimage/{key}', 'AdsController@previewimage');
    get('admin/ads/edit/{key}', 'AdsController@edit');
    post('admin/ads/update', 'AdsController@update');
    
    //AboutUsController
    get('admin/aboutus/edit', 'AboutUsController@edit'); 
    post('admin/aboutus/update', 'AboutUsController@update');
    
    #resource('admin/adssetting', 'AdsSettingController');
    
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');

Route::group(array('prefix' => 'api/v1'), function()
{    
    get('home/{langkey}', 'HomeController@index');
    get('sections/{langkey}/{sid}', 'HomeController@sections');   
    get('article/{aid}', 'HomeController@article');  
    get('search/{langkey}/{search_value}/{eid}/{sid}', 'HomeController@search');  
    get('archive/{pages}/{langkey}/{id}', 'HomeController@archives');
    get('aboutus/{langkey}', 'HomeController@aboutus');
});

Route::get('admin/sendemail', function () {

//    $data = array(
//        'name' => "Learning Laravel",
//    );

    $data = [ 'name' => Input::get('message') ];
Mail::send('admin.emails.welcome', $data, function($message)
{
    $message->to('nachiyappan.arumugam@arkinfotec.com', 'nachi')
        ->from('nachiyappan92@gmail.com')
        ->subject('Welcome!');
});
//    Mail::send('admin.emails.welcome', $data, function ($message) {
//
//        $message->from('nachiyappan.arumugam@arkinfotec.com', 'Learning Laravel');
//
//        $message->to('nachiyappan92@gmail.com')->subject('Learning Laravel test email');
//
//    });

    return "Your email has been sent successfully";

});
//Route::get('sections/{testkey}', 'HomeController@sections');
