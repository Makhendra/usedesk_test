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



Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth',
        'namespace' => 'Api',
    ],
    function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
    }
);

Route::group(['middleware' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::get('/unauthorized', ['as' => 'unauthorized', 'uses' => 'ApiController@sendUnauthorized']);

    Route::group(['middleware' => 'auth'], function() {
        Route::resource('clients', 'ClientController');
    });
});
