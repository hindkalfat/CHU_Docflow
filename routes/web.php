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


Auth::routes();




Route::group(['middleware' => ['auth']], function () {

    //profil
    Route::get('/profil','UserController@profil');
    Route::get('edit/profil','UserController@edit_profil');
    Route::post('/edit','UserController@update_profil')->name('edit');;

    //mailbox
    Route::get('/mailbox', 'MailboxController@index');
    Route::post('/envoyer', 'MailboxController@envoyer');
    Route::post('/enregister', 'MailboxController@enregister');
    Route::post('/supprimer', 'MailboxController@supprimer');

    //filter search
    Route::get('/search','DocController@search');
    
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
        Route::get('/admin/document/{id}','DocController@details');

        //WF
        Route::get('/admin/test','WfController@index');
        Route::post('/admin/addWf','WfController@store');
        Route::post('/admin/test','WfController@addAction');
        Route::post('/admin/cond','WfController@addCond');
        Route::post('/admin/unique','WfController@checkUniqueWf');
        Route::post('/admin/successeurs','WfController@successeurs');
        Route::get('my-demo-mail','Controller@myDemoMail');
        Route::post('/test','WfController@test');
        Route::get('/admin/workflows','WfController@liste');
        Route::post('/admin/delete/workflow','WfController@destroy');

    });

    /*******USER****** */
    Route::group(['middleware' => ['user']], function () {
        //doc
        Route::get('/user/documents','DocController@index');
        Route::post('/user/documents','DocController@store');
        Route::get('/user/document/{id}','DocController@details');
        Route::post('/user/document/archiver','DocController@archiver');
        Route::post('/user/delete/document','DocController@destroy');
        Route::post('/metas','DocController@metas');

        //tache
        Route::get('/user/calendar', 'TacheController@calendar');
        Route::get('/user/taches','TacheController@index');
        Route::post('/user/taches','DocController@effectuerTache');
        Route::post('/user/affecter/tache','TacheController@affecter');
    
    });

    Route::get('/accesrefuse', function () {
        return view('auth/403');
    });

});