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

Auth::routes(['register' => false]);

Route::redirect('/','login');

Route::get('/admin','AdminController@index');
Route::get('/admin/search/users','AdminController@searchUsers');
Route::get('/admin/search/homeworks','AdminController@searchHomeworks');
Route::get('/admin/search/comments','AdminController@searchComments');
Route::get('/admin/admin-users','AdminController@adminUsers');
Route::get('/admin/new-admin','AdminController@newAdmin');
Route::get('/admin/elevate/{user}','AdminController@elevatePrivilege');
Route::get('/admin/degrade/{user}','AdminController@degradePrivilege');
//Route::get('/admin','AdminController@index');
//Route::get('/admin', function () {
//    if(auth()->user()){
//        return response()->json(['web',auth()->user()->get()]);
//    }
//    if(auth('api')->user()){
//        return response()->json(['api',auth()->user()->get()]);
//    }
//    else {
//        dd(Route::class);
////        Route::redierct()
//    }
////    if(auth('api')->user()){
////        return response()->json(['api',auth()->user()->get()]);
////    }
//});
