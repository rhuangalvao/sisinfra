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
Route::group(['prefix'=>'host_param'], function (){
    Route::get('',['as'=>'host_param','uses'=>'HostParamController@index']);
    Route::get('crud',['as'=>'host_param.crud','uses'=>'HostParamController@crud']);
    Route::get('create',['as'=>'host_param.create','uses'=> 'HostParamController@create']);
    Route::post('store',['as'=>'host_param.store','uses'=> 'HostParamController@store']);
    Route::delete('{id}/destroy',['as'=>'host_param.destroy','uses'=> 'HostParamController@destroy']);
    Route::get('{id}/edit',['as'=>'host_param.edit','uses'=> 'HostParamController@edit']);
    Route::patch('{id}/update',['as'=>'host_param.update','uses'=>'HostParamController@update']);
});
Route::group(['prefix'=>'host_status'], function (){
    Route::get('',['as'=>'host_status','uses'=>'HostStatusController@index']);
    Route::get('crud',['as'=>'host_status.crud','uses'=>'HostStatusController@crud']);
    Route::get('create',['as'=>'host_status.create','uses'=> 'HostStatusController@create']);
    Route::post('store',['as'=>'host_status.store','uses'=> 'HostStatusController@store']);
    Route::delete('{id}/destroy',['as'=>'host_status.destroy','uses'=> 'HostStatusController@destroy']);
    Route::get('{id}/edit',['as'=>'host_status.edit','uses'=> 'HostStatusController@edit']);
    Route::patch('{id}/update',['as'=>'host_status.update','uses'=>'HostStatusController@update']);
});
Route::group(['prefix'=>'host_type'], function (){
    Route::get('',['as'=>'host_type','uses'=>'HostTypeController@index']);
    Route::get('crud',['as'=>'host_type.crud','uses'=>'HostTypeController@crud']);
    Route::get('create',['as'=>'host_type.create','uses'=> 'HostTypeController@create']);
    Route::post('store',['as'=>'host_type.store','uses'=> 'HostTypeController@store']);
    Route::delete('{id}/destroy',['as'=>'host_type.destroy','uses'=> 'HostTypeController@destroy']);
    Route::get('{id}/edit',['as'=>'host_type.edit','uses'=> 'HostTypeController@edit']);
    Route::patch('{id}/update',['as'=>'host_type.update','uses'=>'HostTypeController@update']);
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
