<?php

use Illuminate\Http\Request;
use App\User;
use App\Homework;
use App\Comment;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * auth routes
 */
Route::group( [], function () {

    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('/logout', 'AuthController@logout');
    });
});

/**
 * comment routes
 */
Route::group([], function () {

    Route::get('homework/{homework}/comments/{limit}', 'CommentController@forHomework');
    Route::get('/comment/{comment}','CommentController@show');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::resource('/comment', 'CommentController',
            ['only' => ['store', 'update', 'destroy']]);
    });
});

/**
 * homework routes
 */
Route::group([], function() {
    Route::resource('/homework','HomeworkController',
        ['only' => ['index', 'show']]);

    Route::group(['middleware' => 'auth:api'], function() {

        Route::get('homework/{homework}/favorite/{love}','HomeworkController@toggleFavorite');

        Route::resource('/homework','HomeworkController',
            ['only' => ['store', 'update', 'destroy']]);

    });
});

/**
 * user routes
 */

Route::group([], function () {
    Route::get('/users/search','UserController@search');
    Route::resource('/user','UserController',[
        'only' => ['show']
    ]);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('/user','UserController',[
            'only' => ['store', 'update']
        ]);
    });

});

/**
 * admin routes
 */

Route::get('/admin','AdminController@index');
Route::group([
        'prefix' => '/admin',
        'middleware' => ['auth:api','isAdmin']
    ], function () {
        Route::group([
            'prefix' => '/search'
        ], function () {
            Route::get('/users','UserController@search');
            Route::get('/homeworks','HomeworkController@search');
            Route::get('/comments','CommentController@search');
        });
});









/**
 * dev routes
 */
Route::get('/insertbasic',function (){
    Artisan::call('migrate', ["--force"=> true ]);
    User::create(
        array(
            'school_id' => 1,
            'name' => 'efl',
            'subject_id' => 1,
            'permission_id' => 3,
            'email' => 'e@y.c2',
            'password' => Hash::make('11111111'),
        )
    );

    Homework::create(
        array(
            'user_id' => 1,
            'school_id' => 1,
            'source' => 'some/nginx/path',
            'subject_id' => 1,
            'description' => 'ivate function insertBas',
            'views' => 400,
            'downloads' => 40,
        )
    );
    Comment::create(
        array(
            'user_id' => 1,
            'homework_id' => 1,
            'header' => 'greate work',
            'body' => 'i just love it!',
        )
    );
    Comment::create(
        array(
            'user_id' => 1,
            'homework_id' => 1,
            'header' => 'wtf',
            'body' => 'who made this',
        )
    );
    return response()->json([],200);
});
