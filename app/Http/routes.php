<?php
/* ronafreitasweb@gmail.com */


Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {return view('inicio');});
    Route::get('register',function () {return view('permissao_negada');});
});

Route::group(['middleware' => 'web', 'prefix' => 'sistema' ], function () {

    Route::auth();

    Route::get('register',function () {return view('inicio'); });

    Route::get('/home', 'HomeController@index');

    /* users */
    Route::group(['prefix'=> 'usuarios', 'where'=>['id'=>'[0-9]+'] ], function () {
    //Route::group(['prefix'=> 'usuarios'], function () {
        Route::get('', [ 'uses' => 'UserController@index', 'as' => 'usuario.index']);
        Route::get('index', [ 'uses' => 'UserController@index', 'as' => 'usuario.index']);
        Route::get('inserir', ['uses'=> 'UserController@create' , 'as' => 'usuario.create']);
        Route::post('inserir', ['uses'=> 'UserController@store' , 'as' => 'usuario.store']);
        Route::get('{id}/editar', ['uses'=> 'UserController@edit' , 'as' => 'usuario.edit']);
        Route::post('{id}/editar', ['uses'=> 'UserController@update' , 'as' => 'usuario.update']);
        Route::get('{id}/deletar', ['uses'=> 'UserController@delete' , 'as' => 'usuario.delete']);
    });
});