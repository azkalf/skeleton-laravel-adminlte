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

Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

// CONFIGURATION
// Profile
Route::get('/profile', 'ProfileController@index');
Route::patch('/profile/{id}', 'ProfileController@update');
// Password
Route::get('/changePassword', 'ProfileController@changePassword');
Route::patch('/changePassword/{id}', 'ProfileController@updatePassword');
// Company
Route::get('/company', 'ProfileController@companySetting');
Route::patch('/company/{id}', 'ProfileController@updateCompany');
// Group
Route::get('/group', 'ConfigurationController@group');
Route::get('/group/create', 'ConfigurationController@createGroup');
Route::post('/group', 'ConfigurationController@storeGroup');
Route::delete('/group/{id}', 'ConfigurationController@destroyGroup');
Route::get('/group/{id}/edit', 'ConfigurationController@editGroup');
Route::patch('/group/{id}', 'ConfigurationController@updateGroup');
// User
Route::get('/user', 'ConfigurationController@user');
Route::get('/user/create', 'ConfigurationController@createUser');
Route::post('/user', 'ConfigurationController@storeUser');
Route::delete('/user/{id}', 'ConfigurationController@destroyUser');
// Menu
Route::get('/menu', 'ConfigurationController@Menu');
Route::get('/menu/create', 'ConfigurationController@createMenu');
Route::post('/menu', 'ConfigurationController@storeMenu');
Route::post('/menuAjax', 'ConfigurationController@listMenu');
Route::delete('/menu/{id}', 'ConfigurationController@destroyMenu');
Route::post('/menuGen', 'ConfigurationController@generateMenu');
Route::get('/menu/{id}/edit', 'ConfigurationController@editMenu');
Route::patch('/menu/{id}', 'ConfigurationController@updateMenu');
// Company Admin
Route::get('/companyAdmin', 'ConfigurationController@company');

Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');