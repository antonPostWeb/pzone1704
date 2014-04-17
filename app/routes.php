<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('auth', 'AuthController');
Route::controller('client', 'ClientController');
Route::controller('manager', 'ManagerController');
Route::controller('admin', 'AdminController');
Route::controller('tempuser', 'TempuserController');



Route::get('/', function()
{
   return View::make('auth/onlylogin');
});


Route::when('clien*', 'client');
Route::when('clien*', 'auth');
Route::when('manag*', 'manager');
Route::when('manag*', 'auth');
Route::when('admi*', 'admin');
Route::when('admi*', 'auth');
Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('auth');
});
