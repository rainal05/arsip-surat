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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'HakRole:Admin']], function () {
    //bidang
    Route::group(['prefix' => '/bidang'],     function () {
        Route::get('/', 'UserController@index');
        Route::post('/store', 'UserController@store');
        Route::get('/{id}', 'UserController@edit');
        Route::post('/{id}/update', 'UserController@update');
        Route::get('/{id}/delete/', 'UserController@delete');
    });
    //kode-surat
    Route::group(['prefix' => '/kode/surat'],     function () {
        Route::get('/', 'KodeController@index');
        Route::post('/store', 'KodeController@store');
        Route::get('/p2950{id}9W1n6', 'KodeController@edit');
        Route::post('/{id}/update', 'KodeController@update');
        Route::get('/9L02{id}72gb/delete/', 'KodeController@delete');
    });
    //pimpinan
    Route::group(['prefix' => '/pimpinan'],     function () {
        Route::get('/', 'UserController@indexpim');
        Route::post('/storepim', 'UserController@storepim');
        Route::get('/s029{id}9t7ya', 'UserController@editpim');
        Route::post('/{id}/update', 'UserController@updatepim');
        Route::get('/{id}/delete/', 'UserController@deletepim');
    });
    //rekap
    Route::group(['prefix' => '/rekap'],     function () {
        Route::get('/surat/masuk', 'RekapController@masuk');
        Route::get('/surat/masuk/{awalkas}/{akhirkas}', 'RekapController@rmasuk');
        Route::get('/surat/keluar', 'RekapController@keluar');
        Route::get('/surat/keluar/{awalkeluar}/{akhirkeluar}', 'RekapController@rkeluar');
    });
    // keperluan
    Route::group(['prefix' => '/keperluan/disposisi'],     function () {
        Route::get('/', 'KeperluanController@index');
        Route::post('/store', 'KeperluanController@store');
        Route::get('/{id}', 'KeperluanController@edit');
        Route::post('/{id}/update', 'KeperluanController@update');
        Route::get('/{id}/delete/', 'KeperluanController@delete');
    });
});

Route::group(['middleware' => ['auth', 'HakRole:Admin,Ketua,Sekretaris']], function () {
    //s-masuk
    Route::group(['prefix' => '/surat/masuk'],     function () {
        Route::get('/', 'SmasukController@index');
        Route::post('/store', 'SmasukController@store');
        Route::post('/dispos', 'SmasukController@dispos');
        // disposisi adm
        Route::post('/disposadm', 'SmasukController@disposadm');
        Route::get('/detail/{id}', 'SmasukController@detail');
        Route::get('/disposisi/{id}', 'SmasukController@disposisi');
        // edit-delete-print disposisi
        Route::get('/disposisi/{id}/edit', 'SmasukController@disposisiedit');
        Route::post('/disposisi/{id}/update', 'SmasukController@updatedispos');
        Route::get('/disposisi/{id}/delete/', 'SmasukController@deletedispos');
        Route::get('/disposisi/{id}/print', 'SmasukController@printdispos');
        // end edit
        Route::get('/edit/{id}', 'SmasukController@edit');
        Route::post('/{id}/update', 'SmasukController@update');
        Route::get('/{id}/delete/', 'SmasukController@delete');
        Route::get('/{id}/print', 'SmasukController@print');
    });
    //s-keluar
    Route::group(['prefix' => '/surat/keluar'],     function () {
        Route::get('/', 'SkeluarController@index');
        Route::post('/store', 'SkeluarController@store');
        Route::get('/detail/{id}', 'SkeluarController@detail');
        Route::get('/edit/{id}', 'SkeluarController@edit');
        Route::post('/{id}/update', 'SkeluarController@update');
        Route::get('/{id}/delete/', 'SkeluarController@delete');
    });
});

Route::group(['middleware' => ['auth', 'HakRole:Bidang']], function () {
    //s-masuk
    Route::group(['prefix' => '/bidang/surat'],     function () {
        Route::get('/masuk', 'BidangController@masuk');
        Route::get('/masuk/detail/{id}', 'BidangController@mdetail');
        Route::get('/keluar', 'BidangController@keluar');
        Route::get('/keluar/detail/{id}', 'BidangController@kdetail');
    });
});
// profil
Route::group(['middleware' => ['auth', 'HakRole:Admin,Ketua,Sekretaris,Bidang']], function () {
    Route::group(['prefix' => '/profile'],     function () {
        Route::get('/', 'ProfilController@index');
        Route::get('/{id}', 'ProfilController@edit');
        Route::post('/{id}/update', 'ProfilController@update');
    });
});
