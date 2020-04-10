<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//CUSTOM ROUTES
Route::post('/company/login','companyController@login');

Route::post('/company','companyController@create');
Route::get('/company','companyController@getAll');
Route::get('/company/{id}','companyController@getById');
Route::put('/company/{id}','companyController@updateById');
Route::delete('/company/{id}','companyController@deleteById');
