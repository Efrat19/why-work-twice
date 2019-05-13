<?php

use Illuminate\Http\Request;
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
// Route::post('/register', function () {
//     dd('hi');
// });
// Route::group([

//     'middleware' => 'api',
//     // 'namespace' => 'App\Http\Controllers',
//     // 'prefix' => 'auth'

// ], function ($router) {

//     Route::post('/register', 'AuthController@register');
//     Route::post('/login', 'AuthController@login');
//     Route::post('/logout', 'AuthController@logout');
//     Route::post('/refresh', 'AuthController@refresh');
//     Route::post('/me', 'AuthController@me');

// });
    Route::post('/register', 'AuthController@register');
//     Route::post('/login', 'AuthController@login');
// Route::group([
//     'prefix' => 'restricted',
//     'middleware' => 'auth:api',
// ], function () {

//     // Authentication Routes...
//     Route::get('logout', 'AuthController@logout');

//     Route::get('/test', function () {
//         return 'authenticated';
//     });
// });
Route::post('login', 'Auth\LoginController@login');

Route::group([
    'prefix' => 'restricted',
    'middleware' => 'auth:api',
], function () {

    // Authentication Routes...
    Route::get('logout', 'Auth\LoginController@logout');

    Route::get('/test', function () {
        return 'authenticated';
    });
});
Route::resource('/homework','HomeworkController');
Route::get('/insertbasic',function (){

    Homework::create(
            array(
                'user_id' => 1,
                'school_id' => 1,
                'source' => 'some/nginx/path',
                'subject_id' => 1,
                'description' => 'ivate function insertBas',
                'views' => 400,
                'downloads' => 40,
                'rating' => 78,
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
Route::resource('/comment','CommentController');

Route::get('homework/{homework}/comments/{limit}', 'CommentController@index');

Route::get('homework/{homework}/favorite/{love}', function (Homework $homework, $love) {
    $id = auth()->guard('api')->id();
    $love ? $homework->favorites()->attach($id) : $homework->favorites()->detach($id);
    return response()->json($love);
});
