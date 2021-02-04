<?php


Route::get('/', 'HomeController@index');

Route::get('/testmap', function () {
    return view('testmap');
});
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');
Route::get('/data/pasien/v/{id}', 'HomeController@data');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@home');
    Route::get('/polygon', 'HomeController@polygon');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/report', 'ReportController@index');
    Route::get('/report/kelurahan', 'ReportController@akumulasi');
    Route::post('/report/kelurahan/search', 'ReportController@search');

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
    Route::get('/pasien/add', 'PasienController@add');
    Route::post('/pasien/add', 'PasienController@store');
    Route::get('/pasien/delete/{id}', 'PasienController@delete');
    Route::get('/pasien/edit/{id}', 'PasienController@edit');
    Route::post('/pasien/edit/{id}', 'PasienController@update');
    
    Route::get('/data/pasien/{id}', 'PasienController@data');
});
