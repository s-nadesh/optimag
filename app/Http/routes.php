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

    //Sections
    resource('admin/sections', 'SectionController');
    get('admin/sections/destroy/{key}', 'SectionController@destroy');

    //Adsense
    resource('admin/adsenses', 'AdsenseController');
    get('admin/adsenses/destroy/{key}', 'AdsenseController@destroy');
    
    //Articles
    get('admin/article/index', 'ArticleController@index');
    get('admin/article/create', 'ArticleController@create');
    post('admin/article/store', 'ArticleController@store');
    get('admin/article/edit/{key}', 'ArticleController@edit');
    get('admin/article/destroy/{key}', 'ArticleController@destroy');
    post('admin/article/update', 'ArticleController@update');
    
    //Ads
    resource('admin/ads', 'AdsController');
    post('admin/ads/store', 'AdsController@store'); 
    get('admin/ads/destroy/{key}', 'AdsController@destroy');
    
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
    get('search/{langkey}/{search_value}/{eid}', 'HomeController@search');  
});
//Route::get('sections/{testkey}', 'HomeController@sections');
