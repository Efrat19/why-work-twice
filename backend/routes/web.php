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

Route::group([
    'middleware' => ['auth','isAdmin'],
    'prefix' => '/admin'
    ],function (){

        Route::get('/','AdminController@index');
        Route::get('/search/users','AdminController@searchUsers');
        Route::get('/search/homeworks','AdminController@searchHomeworks');
        Route::get('/search/comments','AdminController@searchComments');

        Route::group(['middleware' => 'isSuperAdmin'],function () {
            Route::get('/admin-users','AdminController@adminUsers');
            Route::get('/new-admin','AdminController@newAdmin');
            Route::get('/elevate/{user}','AdminController@elevatePrivilege');
            Route::get('/degrade/{user}','AdminController@degradePrivilege');
        });
    Route::resource('/comment', 'CommentController');
    Route::resource('/user', 'UserController');
    Route::resource('/homeworks', 'HomeworkController');
});
