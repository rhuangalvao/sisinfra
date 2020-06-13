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
Route::group(['prefix'=>'host_ip'], function (){
    Route::get('',['as'=>'host_ip','uses'=>'HostIpController@index']);
    Route::get('crud',['as'=>'host_ip.crud','uses'=>'HostIpController@crud']);
    Route::get('create',['as'=>'host_ip.create','uses'=> 'HostIpController@create']);
    Route::post('store',['as'=>'host_ip.store','uses'=> 'HostIpController@store']);
    Route::delete('{id}/destroy',['as'=>'host_ip.destroy','uses'=> 'HostIpController@destroy']);
    Route::get('{id}/edit',['as'=>'host_ip.edit','uses'=> 'HostIpController@edit']);
    Route::patch('{id}/update',['as'=>'host_ip.update','uses'=>'HostIpController@update']);
});
Route::group(['prefix'=>'operating_system'], function (){
    Route::get('',['as'=>'operating_system','uses'=>'OperatingSystemController@index']);
    Route::get('crud',['as'=>'operating_system.crud','uses'=>'OperatingSystemController@crud']);
    Route::get('create',['as'=>'operating_system.create','uses'=> 'OperatingSystemController@create']);
    Route::post('store',['as'=>'operating_system.store','uses'=> 'OperatingSystemController@store']);
    Route::delete('{id}/destroy',['as'=>'operating_system.destroy','uses'=> 'OperatingSystemController@destroy']);
    Route::get('{id}/edit',['as'=>'operating_system.edit','uses'=> 'OperatingSystemController@edit']);
    Route::patch('{id}/update',['as'=>'operating_system.update','uses'=>'OperatingSystemController@update']);
});
Route::group(['prefix'=>'ocs_map_os'], function (){
    Route::get('',['as'=>'ocs_map_os','uses'=>'OcsMapOsController@index']);
    Route::get('crud',['as'=>'ocs_map_os.crud','uses'=>'OcsMapOsController@crud']);
    Route::get('create',['as'=>'ocs_map_os.create','uses'=> 'OcsMapOsController@create']);
    Route::post('store',['as'=>'ocs_map_os.store','uses'=> 'OcsMapOsController@store']);
    Route::delete('{id}/destroy',['as'=>'ocs_map_os.destroy','uses'=> 'OcsMapOsController@destroy']);
    Route::get('{id}/edit',['as'=>'ocs_map_os.edit','uses'=> 'OcsMapOsController@edit']);
    Route::patch('{id}/update',['as'=>'ocs_map_os.update','uses'=>'OcsMapOsController@update']);
});

Route::get('/', function () {
    return view('welcome');
});
