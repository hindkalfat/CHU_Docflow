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

Route::get('/first', function () {
});

Route::get('/admin', function () {
    return view('admin/dash');
});


Route::get('/admin/nouveauWf', function () {
    return view('admin/nouveauWf');
});


/******USER******* */

Route::get('/user/dash', function () {
    return view('user/dash');
});

Route::get('/user/calendar', function () {
    return view('user/calendar');
});


Route::get('admin/pdf', function () {
    return view('admin/pdf');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/action', 'DocController@actions');
Route::get('/nextActions', 'DocController@nextActions');


Route::group(['middleware' => ['auth']], function () {
    
    /*******ADMIN****** */
    Route::group(['middleware' => ['admin']], function () {
        
        //user
        Route::get('/admin/users','UserController@index');
        Route::post('/admin/users','UserController@store');
        Route::post('/admin/edit/user','UserController@update');
        Route::post('/admin/delete/user','UserController@destroy');

        //groupes
        Route::get('/admin/groupes','GroupController@index');
        Route::post('/admin/groupes','GroupController@store');
        Route::post('/admin/edit/groupe','GroupController@update');
        Route::post('/admin/delete/groupe','GroupController@destroy');

        //document
        Route::get('/admin/documents','TdocController@index');
        Route::post('/admin/documents','TdocController@store');

        //WF
        Route::get('/admin/test','WfController@index');
        Route::post('/admin/addWf','WfController@store');
        Route::post('/admin/test','WfController@addAction');
        Route::post('/admin/unique','WfController@checkUniqueWf');
        Route::post('/admin/successeurs','WfController@successeurs');

    });

    /*******USER****** */
    Route::group(['middleware' => ['user']], function () {
        //doc
        Route::get('/user/documents','DocController@index');
        Route::post('/user/documents','DocController@store');
        Route::get('/user/document/{id}','DocController@details');
        Route::post('/metas','DocController@metas');

        //tache
        Route::get('/user/taches','TacheController@index');
    
    });

    Route::get('/accesrefuse', function () {
        return view('auth/403');
    });

});