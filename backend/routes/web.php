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



(new \App\User)->tfunc();


Route::get('/mem',function (){

    \DB::enableQueryLog();
    dump( ini_get('memory_limit') );


    App\User::first();

    dump( memory_get_usage() /1024/1024 );
    dump( memory_get_usage(true)  /1024/1024);

    $u = [];

    for($i=0; $i < 65423; $i++) {

        $u[] = rand(10,90000);
    }

    dump( memory_get_usage() /1024/1024 );
    dump( memory_get_usage(true)  /1024/1024);


    for($i=0; $i < 1; $i++) {

        $u[] = App\User::pluck('id');
    }
dump('gc:'.
    gc_collect_cycles());
    dump( $u);
    dump( memory_get_usage() /1024/1024 );
    dump( memory_get_usage(true)  /1024/1024);



    die;




    dump( memory_get_usage() );
    dump( memory_get_usage(true) );

    App\User::all();

    dump( memory_get_usage() );
    dump( memory_get_usage(true) );


    dump('a;');

    App\User::all('id');

    dump( memory_get_usage() );
    dump( memory_get_usage(true) );


    dump('a;');
    App\User::pluck('id');

    dump( memory_get_usage() );
    dump( memory_get_usage(true) );


    dump('a;');

    dump(\DB::getQueryLog());

    dump('a;');
    $u = [];





    die;

//    `User::all('id')->random()->id` or even `User::pluck('id')->random()`

    \DB::enableQueryLog();
    $a = \App\User::pluck('id');

    dd( \DB::getQueryLog(),$a);

});

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
    Route::resource('/comment', 'AdminCommentController');
    Route::resource('/user', 'AdminUserController');
    Route::resource('/homework', 'AdminHomeworkController');
});
