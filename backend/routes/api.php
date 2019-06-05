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
        'middleware' => 'auth',
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

    Route::group(['middleware' => 'auth'], function() {

    Route::post('/comment','CommentController@store')->middleware('can:create,App\Comment');
    Route::put('/comment/{comment}','CommentController@update')->middleware('can:update,comment');
    Route::delete('/comment/{comment}','CommentController@destroy')->middleware('can:delete,comment');
    });
});

/**
 * homework routes
 */
Route::group([], function() {

    Route::get('/search/homeworks', 'HomeworkController@search');
    Route::get('user/{user}/homeworks/{limit}', 'HomeworkController@forUser');
    Route::resource('/homework','HomeworkController',
        ['only' => ['index', 'show']]);

    Route::group(['prefix' => 'smart-search'],function (){
        Route::get('/filters','HomeworkController@getSmartSearchFilters');
        Route::post('/results','HomeworkController@getSmartSearchResults');
    });

    Route::group(['middleware' => 'auth'], function() {

        Route::get('homework/{homework}/favorite/{love}','HomeworkController@toggleFavorite');

        Route::post('/homework','HomeworkController@store')->middleware('can:create,App\Homework');
        Route::put('/homework/{homework}','HomeworkController@update')->middleware('can:update,homework');
        Route::delete('/homework/{homework}', 'HomeworkController@destroy')->middleware('can:delete,homework');

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

        Route::post('/user','UserController@store')->middleware('can:create,App\User');
        Route::put('/user/{user}','UserController@update')->middleware('can:update,user');
    });

});









/**
 * dev routes
 */
Route::get('/mail/spam2',function (){
    dispatch(new \App\Jobs\SendSpamJob(User::all()));
    return 'ack';
});
Route::get('/echo',function (\App\Tasks\UpdateHomeworkRatesAvg $updateHomeworkRatesAvg){
//    return response()->json(Homework::take(50)->get());
return 34;
});
Route::get('/avg',function (\App\Tasks\UpdateHomeworkRatesAvg $updateHomeworkRatesAvg){
    $updateHomeworkRatesAvg();
//    return DB::getQueryLog();
    return response()->json(Homework::take(50)->get());
});
Route::get('/mail/{user}',function (User $user){
    \Illuminate\Support\Facades\Mail::to($user)->send(new \App\Mail\WelcomeMail($user));
    return 'ack';
});

Route::get('/slack',function (){
    dump(env('SLACK_HOOK'));
    \Notification::route('slack', env('SLACK_HOOK'))->notify(new \App\Notifications\AppearedOnSearch());
    return 'ack';
});

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
