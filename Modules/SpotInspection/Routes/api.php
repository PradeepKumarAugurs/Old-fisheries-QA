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

Route::group(['prefix'=>'spotinspection','middleware'=>'auth:api', 'namespace'=>'Api'], function () {
    
    Route::post('createSpotInspectionInfo','SpotInspectionController@createSpotInspectionInfo');
    
    Route::get('getSpotInspectionInfo/{row_id}','SpotInspectionController@getSpotInspectionInfo');
    
    Route::post('updateQualityAssessment/{row_id}','SpotInspectionController@updateQualityAssessment');
    
    Route::get('getQualityAssessment/{row_id}','SpotInspectionController@getQualityAssessment');
    
    Route::post('update /{row_id}','SpotInspectionController@updateCutFishWeight');
    
    Route::get('getCutFishWeight/{row_id}','SpotInspectionController@getCutFishWeight');
    
    Route::post('updateCutFishLength/{row_id}','SpotInspectionController@updateCutFishLength');
    
    Route::get('getCutFishLength/{row_id}','SpotInspectionController@getCutFishLength');
    
    Route::post('updateDefrostInspection/{row_id}','SpotInspectionController@updateDefrostInspection');
    
    Route::get('getDefrostInspection/{row_id}','SpotInspectionController@getDefrostInspection');
    
    Route::post('updateWeightControl/{row_id}','SpotInspectionController@updateWeightControl');
    
    Route::get('getWeightControl/{row_id}','SpotInspectionController@getWeightControl');
    
    

}); 