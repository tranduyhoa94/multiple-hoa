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

Route::post('register', 'LoginController@registerUser');

Route::group(['namespace' => 'API','middleware'=>'mutichoice'],function(){
	
	Route::resource('users', 'UserAPIController');

	Route::get('program', 'UserAPIController@getProgramUser');

	Route::get('update-address', 'UserAPIController@updateAddressUser');
	
	Route::resource('user_dash', 'UserDashAPIController');

	Route::post('proposals','UserDashAPIController@test');

	Route::resource('products', 'ProductAPIController');

	Route::post('upload/image','ProductAPIController@uploadImage');
	

});

Route::group(['namespace' => 'API\Auth'],function(){

	Route::post('oauth/{driver}', 'OAuthController@redirectToProvider');

	Route::get('oauth/{driver}/callback', 'OAuthController@handleProviderCallback')->name('oauth.callback');

	Route::get('create-folder', 'PhotoController@createFolder');

	Route::get('get-folder', 'PhotoController@getListFolder');

});



