<?php
// use Modules\AccountManagement\Http\Controllers\Web\AccountManagementController;
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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'accountmanagement','middleware' => 'islogin'],function() {

    Route::get('users','Web\AccountManagementController@users');
    Route::get('createUser','Web\AccountManagementController@createUser'); 
    Route::post('saveUser','Web\AccountManagementController@saveUser'); 
    Route::post('updateAccess','Web\AccountManagementController@updateAccess');
    Route::get('editUser/{user_id}','Web\AccountManagementController@editUser'); 
    Route::post('updateUser/{user_id}','Web\AccountManagementController@updateUser');


    Route::get('producers','Web\AccountManagementController@producers');
    Route::get('addProducer','Web\AccountManagementController@addProducer');
    Route::post('createProducer','Web\AccountManagementController@createProducer');
    Route::get('getWrFishDescripancies','Web\ProducerController@getWrFishDescripancies');
    Route::get('getCutFishDescripancies','Web\ProducerController@getCutFishDescripancies');
    Route::post('updateCustomization','Web\AccountManagementController@updateCustomization');
    Route::post('saveSpecType','Web\ProducerController@saveSpecType'); 
    Route::get('getLengthWidthSpecies','Web\ProducerController@getLengthWidthSpecies');
    Route::post('updateSpecificationSop','Web\AccountManagementController@updateSpecificationSop');
    Route::get('editProducers/{row_id}','Web\AccountManagementController@editProducers');

    
    Route::get('getCitiesByCountryId','Web\AccountManagementController@getCitiesByCountryId');
    Route::get('getAllAccessChildsByAccessId','Web\AccountManagementController@getAllAccessChildsByAccessId');

    Route::get('getAllVessel','Web\AccountManagementController@getAllVessel');
    Route::get('updateVessels/{user_id}','Web\AccountManagementController@updateVessels');
    Route::get('createVessele','Web\AccountManagementController@createVessele');
    
    Route::get('createSpotInspection','Web\AccountManagementController@createSpotInspection');
    Route::get('createSop','Web\AccountManagementController@createSop');
    Route::get('createHistamine','Web\AccountManagementController@createHistamine');
    Route::get('createComment','Web\AccountManagementController@createComment');
    Route::post('createVesselRecord','Web\AccountManagementController@createVesselRecord');
    Route::post('updateVesselRecord','Web\AccountManagementController@updateVesselRecord');
    Route::post('createLotInfoRecord','Web\AccountManagementController@createLotInfoRecord');
    Route::get('getCustomization/{user_id}', 'Web\AccountManagementController@getCustomization');
    Route::post('createAccess','Web\AccountManagementController@createAccess');
    Route::post('updateSpecificationSop','Web\AccountManagementController@updateSpecificationSop');
    Route::post('updateProducer','Web\AccountManagementController@updateProducer');
    Route::post('createSopSpecification','Web\AccountManagementController@createSopSpecification');
    Route::post('createCity','Web\AccountManagementController@createCity');
    
});