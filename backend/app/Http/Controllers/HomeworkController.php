<?php

namespace App\Http\Controllers;

use App\Homework;
use App\User;
use App\School;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeworkController extends Controller
{
    public $rules = [
        'description' => ['required', 'string', 'max:255'],
        'source' => ['required', 'string', 'max:255', 'unique:homeworks,id'],
        'subject' => ['required'],
        'school' => ['required'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Homework::all(),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $homework = Homework::create([
            'description' => $request['description'],
            'source' => $request['source'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'user_id' => auth('api')->id()
        ]);
        return response()->json($homework,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        $this->incrementViews($homework);
        $profile = $homework->toArray();
        $profile['user']= $homework->user()->get();
        $profile['school'] = $homework->school()->first()['name'];
        $profile['subject'] = $homework->subject()->first()['name'];
        $profile['rating'] = $homework->rating()->avg('value') ?: 0;
        $profile['loved'] = false;
        if(auth('api')->check()){
            $profile['loved'] = $homework->favorites()->where('user_id', auth('api')->user())->count();
        }
        $profile['canEdit'] =  auth('api')->check() && auth('api')->user()->can('update',$homework);
        $profile['canDelete'] =  auth('api')->check() && auth('api')->user()->can('delete',$homework);
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
        if (auth('api')->user()->can('update',$homework)) {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()->all()], 422);
            }
            $school = School::firstOrCreate(['name' => $request['school']]);
            $subject = Subject::firstOrCreate(['name' => $request['subject']]);
            $homework->update([
                'description' => $request['description'],
                'source' => $request['source'],
                'school_id' => $school->id,
                'subject_id' => $subject->id,
            ]);
            return response()->json($homework,200);
        }
        return response()->json(['errors'=>['unauthorized']],403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        if (auth('api')->user()->can('update',$homework)) {
            $homework->delete();
            return response()->json($homework, 200);
        }
        return response()->json(['errors'=>['unauthorized']],403);
    }

    public function toggleFavorite(Homework $homework, $love)
    {
        $isFavorite = (bool)$love;
        $id = auth('api')->user();
        $isFavorite ? $homework->favorites()->attach($id) : $homework->favorites()->detach($id);
        return response()->json($isFavorite);
    }

    private function incrementViews(Homework $homework){
        $homework->update([
            'views' => $homework->views++
        ]);
    }

    private function incrementDownloads(Homework $homework){
        $homework->update([
            'downloads' => $homework->downloads++
        ]);
    }
}
