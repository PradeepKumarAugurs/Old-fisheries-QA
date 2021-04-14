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

Route::group(['prefix'=>'lotconsultation','middleware'=>'auth:api','namespace'=>'Api'], function () {
    
    Route::post('comments/{row_id}','LotConsultationController@comments');

    Route::get('getAllLotRecords','LotConsultationController@getAllLotRecords');
    
});