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

Route::group(['prefix'=>'onlineqccontrol','middleware'=>'auth:api','namespace'=>'Api'], function() {
    
    Route::post('createQcSummaryList','OnlineQcControlController@createQcSummaryList');
    Route::get('getAllSummaryList/{user_id}','OnlineQcControlController@getAllSummaryList'); 
    Route::post('createUpdateQcControl','OnlineQcControlController@createUpdateQcControl');
    Route::get('getAllLotControl/{row_id}','OnlineQcControlController@getAllLotControl');
    Route::post('createUpdateHistamine','OnlineQcControlController@createUpdateHistamine');
    Route::get('getAllHistamine/{row_id}','OnlineQcControlController@getAllHistamine');
    Route::post('updateFreezingOperation/{row_id}','OnlineQcControlController@updateFreezingOperation');
    Route::get('getAllFreezingOperation/{row_id}','OnlineQcControlController@getAllFreezingOperation');
    Route::post('updateCreateColdStorage/{row_id}','OnlineQcControlController@updateCreateColdStorage');
    Route::get('getAllClodStorage/{row_id}','OnlineQcControlController@getAllClodStorage');
    Route::post('updateThawingBlockInspection/{row_id}','OnlineQcControlController@updateThawingBlockInspection');
    Route::get('getThawingBlock/{row_id}','OnlineQcControlController@getThawingBlock');
});

