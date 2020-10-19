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
Route::group(['prefix'=>'host_connection'], function (){
    Route::get('crud',['as'=>'host_connection.crud','uses'=>'HostConnectionController@crud']);
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
Route::group(['prefix'=>'host_interface'], function (){
    Route::get('',['as'=>'host_interface','uses'=>'HostInterfaceController@index']);
    Route::get('crud',['as'=>'host_interface.crud','uses'=>'HostInterfaceController@crud']);
    Route::get('create',['as'=>'host_interface.create','uses'=> 'HostInterfaceController@create']);
    Route::post('store',['as'=>'host_interface.store','uses'=> 'HostInterfaceController@store']);
    Route::delete('{id}/destroy',['as'=>'host_interface.destroy','uses'=> 'HostInterfaceController@destroy']);
    Route::get('{id}/edit',['as'=>'host_interface.edit','uses'=> 'HostInterfaceController@edit']);
    Route::patch('{id}/update',['as'=>'host_interface.update','uses'=>'HostInterfaceController@update']);
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
Route::group(['prefix'=>'host_map'], function (){
    Route::get('',['as'=>'host_map','uses'=>'HostMapController@index']);
    Route::get('crud',['as'=>'host_map.crud','uses'=>'HostMapController@crud']);
    Route::get('create',['as'=>'host_map.create','uses'=> 'HostMapController@create']);
    Route::post('store',['as'=>'host_map.store','uses'=> 'HostMapController@store']);
    Route::delete('{id}/destroy',['as'=>'host_map.destroy','uses'=> 'HostMapController@destroy']);
    Route::get('{id}/edit',['as'=>'host_map.edit','uses'=> 'HostMapController@edit']);
    Route::patch('{id}/update',['as'=>'host_map.update','uses'=>'HostMapController@update']);
});
Route::group(['prefix'=>'service'], function (){
    Route::get('',['as'=>'service','uses'=>'ServiceController@index']);
    Route::get('crud',['as'=>'service.crud','uses'=>'ServiceController@crud']);
    Route::get('create',['as'=>'service.create','uses'=> 'ServiceController@create']);
    Route::post('store',['as'=>'service.store','uses'=> 'ServiceController@store']);
    Route::delete('{id}/destroy',['as'=>'service.destroy','uses'=> 'ServiceController@destroy']);
    Route::get('{id}/edit',['as'=>'service.edit','uses'=> 'ServiceController@edit']);
    Route::patch('{id}/update',['as'=>'service.update','uses'=>'ServiceController@update']);
});
Route::group(['prefix'=>'service_group'], function (){
    Route::get('',['as'=>'service_group','uses'=>'ServiceGroupController@index']);
    Route::get('crud',['as'=>'service_group.crud','uses'=>'ServiceGroupController@crud']);
    Route::get('create',['as'=>'service_group.create','uses'=> 'ServiceGroupController@create']);
    Route::post('store',['as'=>'service_group.store','uses'=> 'ServiceGroupController@store']);
    Route::delete('{id}/destroy',['as'=>'service_group.destroy','uses'=> 'ServiceGroupController@destroy']);
    Route::get('{id}/edit',['as'=>'service_group.edit','uses'=> 'ServiceGroupController@edit']);
    Route::patch('{id}/update',['as'=>'service_group.update','uses'=>'ServiceGroupController@update']);
});
Route::group(['prefix'=>'service_instance'], function (){
    Route::get('',['as'=>'service_instance','uses'=>'ServiceInstanceController@index']);
    Route::get('crud',['as'=>'service_instance.crud','uses'=>'ServiceInstanceController@crud']);
    Route::get('create',['as'=>'service_instance.create','uses'=> 'ServiceInstanceController@create']);
    Route::post('store',['as'=>'service_instance.store','uses'=> 'ServiceInstanceController@store']);
    Route::delete('{id}/destroy',['as'=>'service_instance.destroy','uses'=> 'ServiceInstanceController@destroy']);
    Route::get('{id}/edit',['as'=>'service_instance.edit','uses'=> 'ServiceInstanceController@edit']);
    Route::patch('{id}/update',['as'=>'service_instance.update','uses'=>'ServiceInstanceController@update']);
});
Route::group(['prefix'=>'service_instance_param'], function (){
    Route::get('',['as'=>'service_instance_param','uses'=>'ServiceInstanceParamController@index']);
    Route::get('crud',['as'=>'service_instance_param.crud','uses'=>'ServiceInstanceParamController@crud']);
    Route::get('create',['as'=>'service_instance_param.create','uses'=> 'ServiceInstanceParamController@create']);
    Route::post('store',['as'=>'service_instance_param.store','uses'=> 'ServiceInstanceParamController@store']);
    Route::delete('{id}/destroy',['as'=>'service_instance_param.destroy','uses'=> 'ServiceInstanceParamController@destroy']);
    Route::get('{id}/edit',['as'=>'service_instance_param.edit','uses'=> 'ServiceInstanceParamController@edit']);
    Route::patch('{id}/update',['as'=>'service_instance_param.update','uses'=>'ServiceInstanceParamController@update']);
});
Route::group(['prefix'=>'service_dependency'], function (){
    Route::get('',['as'=>'service_dependency','uses'=>'ServiceDependencyController@index']);
    Route::get('crud',['as'=>'service_dependency.crud','uses'=>'ServiceDependencyController@crud']);
    Route::get('create',['as'=>'service_dependency.create','uses'=> 'ServiceDependencyController@create']);
    Route::post('store',['as'=>'service_dependency.store','uses'=> 'ServiceDependencyController@store']);
    Route::delete('{id}/destroy',['as'=>'service_dependency.destroy','uses'=> 'ServiceDependencyController@destroy']);
    Route::get('{id}/edit',['as'=>'service_dependency.edit','uses'=> 'ServiceDependencyController@edit']);
    Route::patch('{id}/update',['as'=>'service_dependency.update','uses'=>'ServiceDependencyController@update']);
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','Controller@welcome')->name('/');
Route::post('/search', 'Controller@search')->name('search');


