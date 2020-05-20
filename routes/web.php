<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'host'], function (){
    Route::get('',['as'=>'host','uses'=>'HostController@index']);
    Route::get('crud',['as'=>'host.crud','uses'=>'HostController@crud']);
    Route::get('create',['as'=>'host.create','uses'=> 'HostController@create']);
    Route::post('store',['as'=>'host.store','uses'=> 'HostController@store']);
    Route::delete('{id}/destroy',['as'=>'host.destroy','uses'=> 'HostController@destroy']);
    Route::get('{id}/edit',['as'=>'host.edit','uses'=> 'HostController@edit']);
    Route::patch('{id}/update',['as'=>'host.update','uses'=>'HostController@update']);
});





Route::get('/', function () {
    return view('welcome');
});
