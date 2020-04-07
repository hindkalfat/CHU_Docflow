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
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin/dash');
});


Route::get('/admin/documents', function () {
    return view('admin/documents');
});

Route::get('/admin/archives', function () {
    return view('admin/archives');
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

Route::get('/user/taches', function () {
    return view('user/taches1');
});

Route::get('/user/documents', function () {
    return view('user/documents');
});

Route::get('/user/document', function () {
    return view('user/document');
});


Route::get('/pdf', function () {
    return view('admin/pdf');
});


Route::get('/admin/users','UserController@index');
Route::post('/admin/users','UserController@store');