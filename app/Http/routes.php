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

    //Articles
    get('admin/article/index', 'ArticleController@index');
    get('admin/article/create', 'ArticleController@create');
    post('admin/article/store', 'ArticleController@store');
    get('admin/article/edit/{key}', 'ArticleController@edit');
    post('admin/article/update', 'ArticleController@update');
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
