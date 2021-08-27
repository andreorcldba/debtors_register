<?php

use Src\Route as Route;

/**
  * Login page
***/
Route::get('/', function(){
	include "ROOT_PATH" . "../../../resource/views/auth/index.php";
});
Route::post('/auth', 'Controllers\AuthController@authentication');
Route::post('/logout', 'Controllers\AuthController@logout');

/**
  * Home page
***/
Route::get('/home', function(){
	include "ROOT_PATH" . "../../../resource/views/home/index.php";
});

/**
  * Users
***/
Route::get('/user', 'Controllers\UserController@index');
Route::get('/user/{id}/show', 'Controllers\UserController@show');
Route::get('/user/list', 'Controllers\UserController@list');
Route::get('/user/create', 'Controllers\UserController@create');
Route::get('/user/edit/{id}', 'Controllers\UserController@edit');
Route::delete('/user/{id}/delete', 'Controllers\UserController@destroy');
Route::post('/user', 'Controllers\UserController@store');
Route::patch('/user/{id}', 'Controllers\UserController@update');
/**
  * Company
***/
Route::get('/company', 'Controllers\CompanyController@index');
Route::get('/company/{id}/show', 'Controllers\CompanyController@show');
Route::get('/company/list', 'Controllers\CompanyController@list');
Route::get('/company/create', 'Controllers\CompanyController@create');
Route::get('/company/edit/{id}', 'Controllers\CompanyController@edit');
Route::delete('/company/{id}/delete', 'Controllers\CompanyController@destroy');
Route::post('/company', 'Controllers\CompanyController@store');
Route::patch('/company/{id}', 'Controllers\CompanyController@update');
/**
  * Debtors
***/
Route::get('/debtor', 'Controllers\DebtorsController@index');
Route::get('/debtor/{id}/show', 'Controllers\DebtorsController@show');
Route::get('/debtors/list', 'Controllers\DebtorsController@list');
Route::get('/debtor/create', 'Controllers\DebtorsController@create');
Route::get('/debtors/edit/{id}', 'Controllers\DebtorsController@edit');
Route::delete('/debtor/{id}/delete', 'Controllers\DebtorsController@destroy');
Route::post('/debtor', 'Controllers\DebtorsController@store');
Route::patch('/debtors/{id}', 'Controllers\DebtorsController@update');
/**
  * Dasboard endpoint
***/
Route::get('/dashboard/{id}', 'Controllers\DashboardController@show');

