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
Route::group(['prefix'=>'host_dns'], function (){
    Route::get('',['as'=>'host_dns','uses'=>'HostDnsController@index']);
    Route::get('crud',['as'=>'host_dns.crud','uses'=>'HostDnsController@crud']);
    Route::get('create',['as'=>'host_dns.create','uses'=> 'HostDnsController@create']);
    Route::post('store',['as'=>'host_dns.store','uses'=> 'HostDnsController@store']);
    Route::delete('{id}/destroy',['as'=>'host_dns.destroy','uses'=> 'HostDnsController@destroy']);
    Route::get('{id}/edit',['as'=>'host_dns.edit','uses'=> 'HostDnsController@edit']);
    Route::patch('{id}/update',['as'=>'host_dns.update','uses'=>'HostDnsController@update']);
});


Route::get('/', function () {
    return view('welcome');
});
