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

//petugas
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
  return Auth::user()->level;
})->middleware('jwt.verify');
Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

//jenis
// Route::get('jenis','jenisController@index')->middleware('jwt.verify');
Route::post('/add_jenis','JenisController@store')->middleware('jwt.verify');
Route::put('/update_jenis/{id}','JenisController@update')->middleware('jwt.verify');
Route::get('/tampil_jenis','JenisController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}','JenisController@destroy')->middleware('jwt.verify');

//Pelanggan
// Route::get('Pelanggan','PelangganController@index')->middleware('jwt.verify');
Route::post('/add_p','PelangganController@store')->middleware('jwt.verify');
Route::put('/update_p/{id}','PelangganController@update')->middleware('jwt.verify');
Route::get('/tampil_p','PelangganController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_p/{id}','PelangganController@destroy')->middleware('jwt.verify');

//Mobil
// Route::get('Mobil','MobilController@index')->middleware('jwt.verify');
Route::post('/add_mobil','MobilController@store')->middleware('jwt.verify');
Route::put('/update_mobil/{id}','MobilController@update')->middleware('jwt.verify');
Route::get('/tampil_mobil','MobilController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_mobil/{id}','MobilController@destroy')->middleware('jwt.verify');
