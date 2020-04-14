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
    return view('first');
});

Route::get('/admin', function () {
    return view('admin/dash');
});


Route::get('/admin/groupes', function () {
    return view('admin/groupes');
});

Route::get('/admin/nouveauWf', function () {
    return view('admin/nouveauWf');
});

Route::get('/admin/test', function () {
    return view('admin/test');
});

/******USER******* */

Route::get('/user/dash', function () {
    return view('user/dash');
});

Route::get('/user/calendar', function () {
    return view('user/calendar');
});

Route::get('/user/document', function () {
    return view('user/document');
});


Route::get('/pdf', function () {
    return view('admin/pdf');
});

//user
Route::get('/admin/users','UserController@index');
Route::post('/admin/users','UserController@store');
Route::post('/admin/edit/user','UserController@update');
Route::post('/admin/delete/user','UserController@destroy');

//groupes
Route::get('/admin/groupes','GroupController@index');
Route::post('/admin/groupes','GroupController@store');
Route::post('/admin/delete/groupe','GroupController@destroy');

//document
Route::get('/admin/documents','TdocController@index');
Route::post('/admin/documents','TdocController@store');

/*******USER****** */

//doc
Route::get('/user/documents','DocController@index');
Route::get('/user/taches','TacheController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
