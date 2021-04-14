<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'lot','namespace' => 'Web'],function() {
    Route::get('lotInformation', 'LotController@lotInformation');

    Route::get('createRawMaterial','LotController@createRawMaterial');

    Route::post('createFishingInfo','LotController@createFishingInfo'); 

    Route::post('createUnloadingInfo','LotController@createUnloadingInfo');

    Route::post('createTransportInfo','LotController@createTransportInfo'); 
    
    Route::post('updateParasitismInfo','LotController@updateParasitismInfo'); 
    
    Route::post('createOrganolepticResistance','LotController@createOrganolepticResistance');

    Route::get('updateMaterial','LotController@updateMaterial');

    Route::post('updateOrganolepticResistance/{row_id}','LotController@updateOrganolepticResistance');

    Route::post('createWeight','LotController@createWeight');
    Route::get('rawMaterialArrival','LotController@rawMaterialArrival');
    Route::get('onlineQcList','LotController@onlineQcList');
    Route::get('labAnalysisList','LotController@labAnalysisList');
    Route::get('coldChainList','LotController@coldChainList');
    Route::post('createLotInfo','LotController@createLotInfo');
    Route::post('updateLotInfo/{row_id}','LotController@updateLotInfo');
    Route::post('createLabAnalysis','LotController@createLabAnalysis');
    Route::post('createColdChainStorage','LotController@createColdChainStorage');
    Route::post('addParasiteData','LotController@addParasiteData');

});
