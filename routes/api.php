<?php

use Illuminate\Http\Request;

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

Route::get('items', 'ItemController@getAllItems');
Route::post('items', 'ItemController@createItems');
Route::put('items/{id}', 'ItemController@updateItems');
Route::delete('items/{id}', 'ItemController@deleteItems');

Route::get('pajaks', 'PajakController@getAllPajaks');
Route::post('pajaks', 'PajakController@createPajaks');
Route::put('pajaks/{id}', 'PajakController@updatePajaks');
Route::delete('pajaks/{id}', 'PajakController@deletePajaks');

Route::get('listdataitem', 'ListdataitemController@getAll');
