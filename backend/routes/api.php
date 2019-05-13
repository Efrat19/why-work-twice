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
//header('Access-Control-Allow-Origin : *');
//header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
//header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');


//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::group(['middleware' => ['json.response']], function () {
//
//    Route::middleware('auth:api')->get('/user', function (Request $request) {
//        return $request->user();
//    });

    // public routes
    Route::post('/login', 'AuthController@login')->name('login.api');
    Route::post('/register', 'AuthController@register')->name('register.api');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'AuthController@logout')->name('logout');
    });

//});

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