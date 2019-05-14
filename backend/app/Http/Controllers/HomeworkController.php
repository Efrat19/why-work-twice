<?php

namespace App\Http\Controllers;

use App\Homework;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        $profile = $homework->toArray();
        $profile['user']= $homework->user()->get();
        $profile['school'] = $homework->school()->get();
        $profile['subject'] = $homework->subject()->get();
        $profile['loved'] = false;
        if(auth('api')->check()){
            $profile['loved'] = $homework->favorites()->where('user_id', auth('api')->user())->count();
        }
        $profile['commentsNum'] = $homework->comments()->count();
        return response()->json($profile,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homework $homework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        //
    }

    public function toggleFavorite(Homework $homework, $love)
    {
        $id = auth('api')->user();
        (bool)$love ? $homework->favorites()->attach($id) : $homework->favorites()->detach($id);
        return response()->json((bool)$love);
    }

}
