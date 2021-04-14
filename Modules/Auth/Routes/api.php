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

// Route::middleware('auth:api')->get('/auth', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/auth')->group(function() {
    
    Route::post('login', 'UserController@login');
	Route::post('register', 'UserController@register');
	Route::group(['middleware' => 'auth:api'], function(){
	Route::get('details', 'UserController@details');
	});

	Route::group([   
		'middleware' => 'api',    
		'prefix' => 'password'
	], function () {    		
		Route::post('create', 'PasswordResetController@create');
		Route::get('find/{token}', 'PasswordResetController@find');
		Route::post('reset', 'PasswordResetController@reset');
	});


});
