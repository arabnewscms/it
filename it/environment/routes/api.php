<?php
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
// your api is integerated but if you want reintegrate no problem
// to configure jwt-auth visit this link https://jwt-auth.readthedocs.io/en/docs/

Route::group(['middleware' => ['ApiLang', 'cors'], 'prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

	Route::get('/', function () {

	});
	// Insert your Api Here Start //
	Route::group(['middleware' => 'guest'], function () {
		Route::post('login', 'AuthApiLoggedIn@login')->name('api.login');
	});

	Route::group(['middleware' => 'auth:api'], function () {
		Route::get('account', 'AuthApiLoggedIn@account')->name('api.account');
		Route::post('logout', 'AuthApiLoggedIn@logout')->name('api.logout');
		Route::post('refresh', 'AuthApiLoggedIn@refresh')->name('api.refresh');
		Route::post('me', 'AuthApiLoggedIn@me')->name('api.me');
		Route::post('change/password', 'AuthApiLoggedIn@change_password')->name('api.change_password');
		//Auth-Api-Start//
		//Auth-Api-End//
	});
	// Insert your Api Here End //
});