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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'LoginController@login');

Route::group(['namespace' => 'API'],function(){
	
	Route::resource('users', 'UserAPIController');

	Route::get('program', 'UserAPIController@getProgramUser');

	Route::get('update-address', 'UserAPIController@updateAddressUser');
	
	Route::resource('user_dash', 'UserDashAPIController');

	Route::post('proposals','UserDashAPIController@test');

});
