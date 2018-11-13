<?php

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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();


Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', 'DashboardController@index');
	


	Route::group(['middleware' => ['role:Administrator|Penggugat']], function() {

		Route::get('trans_perkara/{trans_id}/detail', [
			'as'   => 'trans_perkara.detail',
			'uses' => 'TransPerkaraController@det_perkara'
		]);

		Route::get('trans_perkara/{trans_id}/cetak_trans_perkara', [
			'as' => 'trans_perkara.cetak_trans_perkara',
			'uses' => 'TransPerkaraController@cetak_trans_perkara',
		]);

		Route::get('/trans_perkara/create', [
			'as' => 'trans_perkara.create',
			'uses' => 'TransPerkaraController@create',
		]);


		Route::post('/trans_perkara', [
			'as' => 'trans_perkara.store',
			'uses' => 'TransPerkaraController@store',
		]);


		Route::get('trans_perkara', [
			'as' => 'trans_perkara.index',
			'uses' => 'TransPerkaraController@index',
		]);


	});

	Route::group(['middleware' => ['role:Administrator']], function() {
		Route::resource('users', 'UserController');
		Route::resource('mst_perkara', 'MstPerkaraController');
		Route::resource('mst_uraian', 'MstUraianController');

		Route::get('trans_perkara/{trans_id}/create_uraian', [
			'as' => 'trans_perkara.create_uraian',
			'uses' => 'TransPerkaraController@create_uraian',

		]);

		Route::post('trans_perkara/store_uraian', [
			'as' => 'trans_perkara.store_uraian',
			'uses' => 'TransPerkaraController@store_uraian',

		]);

		Route::post('trans_perkara/destroy_uraian', [
			'as' => 'trans_perkara.destroy_uraian',
			'uses' => 'TransPerkaraController@destroy_uraian',

		]);

		Route::get('trans_perkara/{det_id}/edit_uraian', [
			'as' => 'trans_perkara.edit_uraian',
			'uses' => 'TransPerkaraController@edit_uraian',

		]);

		Route::post('trans_perkara/{det_id}/update_uraian', [
			'as' => 'trans_perkara.update_uraian',
			'uses' => 'TransPerkaraController@update_uraian',

		]);



		Route::get('trans_perkara/index_admin', [
			'as' => 'trans_perkara.index_admin',
			'uses' => 'TransPerkaraController@index_admin',

		]);

		Route::get('/trans_perkara/{id}/edit', [
			'as' => 'trans_perkara.edit',
			'uses' => 'TransPerkaraController@edit',

		]);

		Route::patch('/trans_perkara/{id}', [
			'as' => 'trans_perkara.update',
			'uses' => 'TransPerkaraController@update',

		]);

		Route::put('/trans_perkara/{id}', [
			'as' => 'trans_perkara.update',
			'uses' => 'TransPerkaraController@update',

		]);

		Route::delete('/trans_perkara/{id}', [
			'as' => 'trans_perkara.destroy',
			'uses' => 'TransPerkaraController@destroy',

		]);

	});

	Route::group(['middleware' => ['role:Penggugat']], function() {

		Route::get('trans_perkara/index_penggugat', [
			'as'   => 'trans_perkara.index_penggugat', 
			'uses' => 'TransPerkaraController@index_penggugat',	
		]);

	});


});


