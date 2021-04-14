<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
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

// Route::middleware('auth:api')->get('/accountmanagement', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix'=>'accountmanagement'],function() {
// Route::get('test','SopController@tokenExpired'); 
// Route::get('getUserProfile','AccountManagementController@getUserProfile');
// });


Route::group(['prefix'=>'accountmanagement','middleware' => ['auth:api']],function() {

    Route::group(['middleware' => ['isadmin:api']],function() {
        
        Route::get('getBasicInfo/{user_id}', 'AccountManagementController@getBasicInfo');  //  
        Route::post('updateBasicInfo', 'AccountManagementController@updateBasicInfo');
        Route::get('getGeneralInfo/{user_id}', 'AccountManagementController@getGeneralInfo'); // 
        Route::post('updateGeneralInfo', 'AccountManagementController@updateGeneralInfo');
        Route::post('updateAccess', 'AccountManagementController@updateAccess');
        Route::get('getCustomization/{producer_id}', 'CustomizationController@getCustomization'); // 
        Route::post('updateCustomization', 'CustomizationController@updateCustomization');
        Route::get('getSpecificationSop/{producer_id}','SopController@getSpecificationSop'); 
        Route::post('updateSpecificationSop','SopController@updateSpecificationSop'); 
        Route::get('getdiscrepancies','CustomizationController@getdiscrepancies');
        Route::post('saveDiscrepancy','CustomizationController@saveDiscrepancy'); 
        Route::get('getAllUser','AccountManagementController@getAllUser');
        Route::get('getUser/{user_id}','AccountManagementController@getUser');
        Route::post('updateUser/{row_id}','AccountManagementController@updateUser');
        Route::get('getAllPositions','AccountManagementController@getAllPositions'); 
        Route::post('createUser','AccountManagementController@createUser');
        Route::get('getAllProducers','AccountManagementController@getAllProducers'); 
        
        /*  DELETE ROUTE*/
        Route::delete('zone/{id}','ZoneController@deletezone');
        Route::delete('supplier/{id}','SupplierController@deletesupplier');
        Route::delete('userDiscrepancy/{id}','DiscrepancyController@deleteUserDiscrepancy');
        Route::delete('masterDiscrepancy/{id}','DiscrepancyController@deleteMasterDiscrepancy');
        Route::delete('sopfile/{id}','SopFileController@deleteSopFile');
        /* END DELETE ROUTE*/ 

        Route::put('zone/{id}','ZoneController@update');
        Route::put('supplier/{id}','SupplierController@update');
        Route::put('userDiscrepancy/{id}','DiscrepancyController@updateUserDiscrepancy');
        Route::put('masterDiscrepancy/{id}','DiscrepancyController@updateMasterDiscrepancy');

        /* SPEC TYPE */
        Route::put('saveSpecType/{user_id}','SopController@saveSpecType');
        Route::get('getSpecType/{user_id}','SopController@getSpecType');
        Route::put('updateSpecType/{user_id}/{id}','SopController@updateSpecType');
        Route::delete('deleteSpecType/{user_id}/{id}','SopController@deleteSpecType');
        /* END OF the Spec TYPE*/
        
        /* create Producers */
        Route::post('saveSpecies','SopController@saveSpecies'); 
        Route::get('getProducer/{producer_id}','ProducerController@getProducer'); 
        Route::post('createProducer','ProducerController@createProducer');
        Route::get('getAllProducer','ProducerController@getAllProducer');
        Route::post('createCustomFields','ProducerController@createCustomFields');
        Route::post('createCustomRows','ProducerController@createCustomRows');
        Route::post('createCustomProducerData','ProducerController@createCustomProducerData');
        Route::post('updateProducer/{row_id}','ProducerController@updateProducer');
        Route::get('getAllCities','ProducerController@getAllCities'); 
    });
    
    Route::get('all_master_access', 'MasterAccessController@all_master_access');
    Route::get('all_countries', 'AccountManagementController@all_countries');
    Route::get('getAccess/{user_id}', 'AccountManagementController@getAccess'); // 
    Route::get('suppliers', 'AccountManagementController@suppliers');
    Route::get('producers', 'AccountManagementController@producers');
    Route::get('getLeader','AccountManagementController@getLeader');
    Route::get('getSpecs','SopController@getSpecs');
    Route::post('uploadFiles','SopFileController@uploadFiles');
    Route::get('getUserProfile','AccountManagementController@getUserProfile');
    Route::post('updateProfile/{row_id}','AccountManagementController@updateProfile');
    Route::get('getAffiliationsData','AccountManagementController@getAffiliationsData');
    
    Route::get('getAlluserAccess/{user_id}','AccountManagementController@getAlluserAccess');
    Route::get('getAccessAllData','AccountManagementController@getAccessAllData');
    
    Route::post('createVessel','VesselController@createVess el');
    Route::post('updateVessel/{row_id}','VesselController@updateVessel');
    Route::get('getAllvessels/{user_id}','VesselController@getAllvessels');
    Route::get('getVessels','VesselController@getVessels');

    Route::get('accessData','AccountManagementController@accessData');
    
});
