<?php
use Illuminate\Support\Facades\Route;
view()->addLocation(__DIR__ .'/views');
\Illuminate\Support\Facades\View::addNamespace('it', __DIR__ .'/views');

Route::group(['namespace' => 'Phpanonymous\It\Controllers'],
function () {

		\Lang::addNamespace('it', __DIR__ .'/lang');

		Route::get('/', function () {return it_views('welcome');});

		Route::get('workflow', 'WorkFlow@loading');
		if (class_exists('Barryvdh\Elfinder\Session\LaravelSession')) {
			Route::get('merge', 'Merge@merge');
		}

		Route::get('baboon-sd', 'Baboon\Home@index');
		Route::post('baboon-sd', 'Baboon\Home@index_post');
		Route::post('create/namespace/{type}', 'Baboon\Home@makeNamespace');
	});

//////// Elfinder Configurations Routes ///////////////
Route::group(['namespace'                   => 'Barryvdh\Elfinder'], function () {
		Route::any('connector', ['as'             => 'elfinder.connector', 'uses'             => 'ElfinderController@showConnector']);
		Route::get('popup/{input_id}', ['as'      => 'elfinder.popup', 'uses'      => 'ElfinderController@showPopup']);
		Route::get('filepicker/{input_id}', ['as' => 'elfinder.filepicker', 'uses' => 'ElfinderController@showFilePicker']);
		Route::get('tinymce', ['as'               => 'elfinder.tinymce', 'uses'               => 'ElfinderController@showTinyMCE']);
		Route::get('tinymce4', ['as'              => 'elfinder.tinymce4', 'uses'              => 'ElfinderController@showTinyMCE4']);
		Route::get('ckeditor', ['as'              => 'elfinder.ckeditor', 'uses'              => 'ElfinderController@showCKeditor4']);
	});
//////// Elfinder Configurations Routes ///////////////