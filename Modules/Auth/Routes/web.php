<?php
use Modules\Auth\Http\Controllers\HomeController;
// use Modules\Auth\Http\Controllers\Auth\LoginController;
// use Modules\Auth\Http\Controllers\Auth\ResetPasswordController;
use Modules\Auth\Http\Controllers\Web\UserController;

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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::group(['middleware' => 'islogin'],function() {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('dashboard', [HomeController::class, 'index']);
    
    Route::get('users_list',[UserController::class, 'index']);  
    Route::get('account_management',[UserController::class, 'index']);  
    Route::get('edit_profile/{row_id}',[UserController::class, 'edit_profile']);
    Route::post('update_password',[UserController::class,'updatePassword']);
    Route::post('update_profile',[UserController::class,'updateProfile']); 
}); 
Route::prefix('auth')->group(function() {
    Auth::routes();
    /*$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');

    
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');*/

});


