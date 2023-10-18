<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    //Route User
    Route::get('/user','App\Http\Controllers\UserController@user')->name('user.index');
    Route::post('/user/post','App\Http\Controllers\UserController@store')->name('user.store');
    Route::post('/user/edit/{id}','App\Http\Controllers\UserController@update')->name('user.update');
    Route::delete('/user-hapus/{id}','App\Http\Controllers\UserController@destroy')->name('user.destroy');
    //lokasi
    Route::get('/lokasi', 'App\Http\Controllers\LokasiController@index')->name('lokasi.index');
    Route::post('/lokasi/post', 'App\Http\Controllers\LokasiController@store')->name('lokasi.store');
    Route::post('/lokasi/edit/{id}', 'App\Http\Controllers\LokasiController@edit')->name('lokasi.edit');
    Route::delete('/lokasi/delete/{id}','App\Http\Controllers\LokasiController@destroy')->name('lokasi.destroy');
    Route::post('/lokasi/tanggal','App\Http\Controllers\LokasiController@filter')->name('lokasi.filter');
    //Area
    Route::get('/area', 'App\Http\Controllers\AreaController@index')->name('area.index');
    Route::post('/area/post', 'App\Http\Controllers\AreaController@store')->name('area.store');
    Route::post('/area/update/{id}', 'App\Http\Controllers\AreaController@update')->name('area.edit');
    Route::delete('/area/delete/{id}','App\Http\Controllers\AreaController@destroy')->name('area.destroy');
    Route::post('/area/tanggal','App\Http\Controllers\AreaController@filter')->name('area.filter');

    //AC
    Route::get('/ac', 'App\Http\Controllers\AcController@index')->name('ac.index');
    Route::post('/ac/post', 'App\Http\Controllers\AcController@store')->name('ac.store');
    Route::post('/ac/update/{id}', 'App\Http\Controllers\AcController@update')->name('ac.edit');
    Route::delete('/ac/delete/{id}','App\Http\Controllers\AcController@destroy')->name('ac.destroy');
    Route::post('/ac/tanggal','App\Http\Controllers\AcController@filter')->name('ac.filter');
    //AC DETAIL
    Route::get('/ac/{id_ac}', 'App\Http\Controllers\AcController@show')->name('detail_ac.index');
    Route::get('get-data-ac', 'App\Http\Controllers\AcController@getData')->name('get.dataac');
    //Teknisi
    Route::get('/teknisi', 'App\Http\Controllers\TeknisiController@index')->name('teknisi.index');
    Route::post('/teknisi/post', 'App\Http\Controllers\TeknisiController@store')->name('teknisi.store');
    Route::post('/teknisi/update/{id}', 'App\Http\Controllers\TeknisiController@update')->name('teknisi.edit');
    Route::delete('/teknisi/delete/{id}','App\Http\Controllers\TeknisiController@destroy')->name('teknisi.destroy');
    Route::post('/teknisi/tanggal','App\Http\Controllers\TeknisiController@filter')->name('teknisi.filter');

    //Service
    Route::get('/service', 'App\Http\Controllers\TrServiceController@index')->name('service.index');
    Route::post('/service/post', 'App\Http\Controllers\TrServiceController@store')->name('service.store');
    Route::post('/service/update/{id}', 'App\Http\Controllers\TrServiceController@update')->name('service.edit');
    Route::delete('/service/delete/{id}','App\Http\Controllers\TrServiceController@destroy')->name('service.destroy');
    Route::get('service/tanggal','App\Http\Controllers\TrServiceController@filter')->name('service.filter');
    Route::post('/service/{tanggal}','App\Http\Controllers\TrServiceController@tanggal')->name('service.tanggal');

    //Dashoboard
    Route::get('/dashboard/indoor', 'App\Http\Controllers\HomeController@indoor')->name('indoor.index');
    Route::get('/dashboard/outdoor', 'App\Http\Controllers\HomeController@outdoor')->name('outdoor.index');
    Route::get('/dashboard/detail/{id_area}', 'App\Http\Controllers\HomeController@detail_dashboard')->name('detail_dashboard');
    //FetchData
    Route::post('api/fetch/lokasi', 'App\Http\Controllers\LokasiController@fetchlokasi');
    Route::post('api/fetch/area', 'App\Http\Controllers\LokasiController@fetcharea');
    Route::post('api/fetch/type_lokasi', 'App\Http\Controllers\LokasiController@fetchtype');

});

