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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/

    Route::post('/company/logout','companyController@logout');
});

//CUSTOM ROUTES
Route::post('/company/login','companyController@authenticate');
Route::post('/company','companyController@register');
Route::put('/company/{id}','companyController@updateById');

Route::get('/company','companyController@getAll');
Route::get('/company/{id}','companyController@getById');
Route::delete('/company/{id}','companyController@deleteById');

