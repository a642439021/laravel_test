<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;


Route::any('/mobile/getStoreList','Mobile\IndexController@getStoreList')->name('getStoreList');
Route::group(['middleware' => ['web'],'prefix'=>'mobile','namespace'=>'Mobile'], function () {
    Route::get('/','IndexController@index');
    Route::get('/park','ParkController@index')->name('park');
    Route::get('/login','UserController@login')->name('login');
    Route::get('/session2','IndexController@session2');
});
Route::get('/student','Mobile\StudentController@index');
Route::get('/','Mobile\IndexController@index');
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'AdminController@index'); //后台首页
    Route::get('/adminlogin', 'AdminController@login'); //后台首页
    Route::get('/backend_login', 'AdminController@backendLogin')->name('backend_login');
    Route::get('/userInfo', 'AdminController@userInfo');
});
