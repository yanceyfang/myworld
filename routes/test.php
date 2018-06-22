<?php


/*
|--------------------------------------------------------------------------
| test Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function(){
    Route::get('test1','Test\TestController@test1');
    Route::get('test2','Test\TestController@test2');





















});
