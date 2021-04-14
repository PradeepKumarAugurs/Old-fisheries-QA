<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;

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




Route::group(['prefix'=>'lot','middleware' => 'auth:api','namespace' => 'Api'],function() {
    
  
  Route::post('createFishing','FishArrivalController@createFishing');
  Route::post('updateFishing/{id}','FishArrivalController@updateFishing');
  Route::get('getFishing/{arrival_id}','FishArrivalController@getFishing');
  Route::post('updateUnloadingInfo/{row_id}','UnloadingController@updateUnloadingInfo');
  Route::get('getUnloadingInfo/{row_id}','UnloadingController@getUnloadingInfo');
  Route::post('updateTransportationInfo/{row_id}','TransportationController@updateTransportationInfo');
  Route::get('getTransportationInfo/{row_id}','TransportationController@getTransportationInfo');
  Route::post('updateParasitismInfo/{row_id}','FishArrivalController@updateParasitismInfo');
  Route::get('getParasitismInfo/{row_id}','FishArrivalController@getParasitismInfo');
  Route::post('updateOrganolepticResistance/{row_id}','FishArrivalController@updateOrganolepticResistance');
  Route::get('getOrganolepticResistance/{row_id}','FishArrivalController@getOrganolepticResistance');
  Route::get('getAllArrivals','FishArrivalController@getAllArrivals');

  /* Old Route  */
  Route::post('createLotGenralInfo','LotController@createLotGenralInfo');
  Route::post('updateLotGenralInfo/{row_id}','LotController@updateLotGenralInfo');
  Route::get('getLotGenralInfo/{row_id}','LotController@getLotGenralInfo');
  Route::get('getLotFishReception/{row_id}','LotController@getLotFishReception');
  Route::get('getFishReceptionAllMaterParasites','LotController@getFishReceptionAllMaterParasites'); 
  Route::get('getLotCountiresInfo/{user_id}','LotController@getLotCountiresInfo');
  Route::get('getLotSupplierInfo/{user_id}/{reference_country_id}','LotController@getLotSupplierInfo');
  Route::get('getSpecType/{user_id}','LotController@getSpecType'); 
  Route::get('getLotProducerInfo/{user_id}/{reference_country_id}/{supplier_id}','LotController@getLotProducerInfo');
  Route::get('getCountryList/{reference_country_id}','LotController@getCountryList');
  Route::get('getAllTypes','LotController@getAllTypes');
  Route::get('getAllQuality','LotController@getAllQuality');
  Route::get('getAllCutSizeTypes/{user_id}/{spec_type}','LotController@getAllCutSizeTypes');
  Route::get('getAllUnits','LotController@getAllUnits');
  Route::get('getAllZones','LotController@getAllZones');
  Route::get('getAllLots','LotController@getAllLots');
  // * codes * //
  Route::post('updateLotFishingInfo/{row_id}','LotController@updateLotFishingInfo');
  Route::get('getLotFishingInfo/{row_id}','LotController@getLotFishingInfo');
  Route::post('updateLotWrOr/{row_id}','LotController@updateLotWrOr');
  Route::get('getLotWrWeightOr/{row_id}','LotController@getLotWrWeightOr');
  Route::post('updateLotWrFinishProduct/{row_id}','LotController@updateLotWrFinishProduct');
  Route::get('getLotWrWeightFinishProduct/{user_id}','LotController@getLotWrWeightFinishProduct');
  Route::post('updateLotCutFishWeight/{row_id}','LotController@updateLotCutFishWeight');
  Route::get('getlotCutFishWeight/{user_id}','LotController@getlotCutFishWeight');
  Route::post('updateLotCutFishlength/{row_id}','LotController@updateLotCutFishlength');
  Route::get('getlotCutFishLength/{user_id}','LotController@getlotCutFishLength');

  Route::post('createLotRawMaterial','LotController@createLotRawMaterial');
  Route::post('updateLotRawMaterial/{row_id}','LotController@updateLotRawMaterial');
  Route::get('getAllLotRawMatterial','LotController@getAllLotRawMatterial');
  Route::get('getLotRawMaterial/{row_id}','LotController@getLotRawMaterial');
  Route::get('getFishArrivalList','FishArrivalController@getFishArrivalList');
  Route::get('getFishArrival/{row_id}','FishArrivalController@getFishArrival');

});