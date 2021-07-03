<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user',

function (Request $request) {
		return $request->user();
	});

Route::group(['middleware' => ['ApiLang', 'cors'], 'prefix' => 'v1', 'namespace' => 'Api'], function () {
		// Insert your Api Here Start //
		Route::post('login', 'AuthApiLoggedIn@login');
		Route::post('logout', 'AuthApiLoggedIn@logout');
		Route::post('refresh', 'AuthApiLoggedIn@refresh');
		Route::post('me', 'AuthApiLoggedIn@me');
		// Insert your Api Here End //
	});