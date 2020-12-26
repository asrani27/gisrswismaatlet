<?php


Route::get('/', 'HomeController@index');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@home');
    Route::get('/polygon', 'HomeController@polygon');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/kelurahan', 'KelurahanController@index');
    Route::get('/kelurahan/add', 'KelurahanController@add');
    Route::post('/kelurahan/add', 'KelurahanController@store');
    Route::get('/kelurahan/edit/{id}', 'KelurahanController@edit');
    Route::post('/kelurahan/edit/{id}', 'KelurahanController@update');
    Route::get('/kelurahan/delete/{id}', 'KelurahanController@delete');
    
    Route::get('/marker', 'MarkerController@index');
    Route::get('/marker/add', 'MarkerController@add');
    Route::post('/marker/add', 'MarkerController@store');
    Route::get('/marker/edit/{id}', 'MarkerController@edit');
    Route::post('/marker/edit/{id}', 'MarkerController@update');
    Route::get('/marker/delete/{id}', 'MarkerController@delete');
    
    Route::get('/pasien', 'PasienController@index');
    Route::post('/pasien/upload', 'PasienController@upload');
});
