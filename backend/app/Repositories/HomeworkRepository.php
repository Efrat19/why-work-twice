<?php

namespace App\Repositories;


use App\School;
use App\Subject;
use App\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class HomeworkRepository implements HomeworkRepositoryInterface {

    /**
     * all validation Rules
     *
     * @var array
     */
    protected $allRules = [
        'description' => ['required', 'string', 'max:255'],
        'source' => ['required', 'string', 'max:255', 'unique:homeworks,id'],
        'subject' => ['required'],
        'school' => ['required'],
    ];

    /**
     * @return array|mixed
     */
    public function getCreateRules()
    {
        return $this->allRules;
    }

    /**
     * @return array|mixed
     */
    public function getUpdateRules()
    {
        return $this->allRules;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $homework = Homework::create([
            'description' => $request['description'],
            'source' => $request['source'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'user_id' => auth('api')->id()
        ]);
        return $this->getProfile($homework);
    }

    /**
     * @param Request $request
     * @param Homework $homework
     * @return mixed
     */
    public function update(Request $request, Homework $homework)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $homework->update([
            'description' => $request['description'],
            'source' => $request['source'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
        ]);
        return $this->getProfile($homework);
    }

    /**
     * @param $query
     * @return array|mixed
     */
    public function search($query)
    {
        $results = new Collection();
        if ($query) {
            $results = Homework::where('description','LIKE', '%'.$query.'%')
                ->orWhereHas('school', function ($records) use ($query){
                    $records->where('name', 'like',  '%'.$query.'%');
                })->orWhereHas('subject', function ($records) use ($query) {
                    $records->where('name', 'like',  '%'.$query.'%');
                })->get();
        }
        return $results->map(function ($result) {
                return $this->getProfile($result);
            });
    }

    /**
     * @param $fields
     * @return array|mixed
     */
    public function getRulesFor($fields){

        $filteredRules = [];

        foreach (is_array($fields) ? $fields : func_get_args() as $field) {

            $value = $this->allRules[$field];

            Arr::set($filteredRules, $field, $value);
        }

        return $filteredRules;
    }

    public function getProfile(Homework $homework)
    {
        $profile = $homework->toArray();
        $profile['user']= $homework->user;
        $profile['school'] = $homework->school;
        $profile['subject'] = $homework->subject;
        $profile['rating'] = $homework->rating()->avg('value') ?: 0;
        $profile['loved'] = false;
        if(auth('api')->check()){
            $profile['loved'] = $homework->favorites()->where('user_id', auth('api')->user())->count();
        }
        $profile['canEdit'] =  auth('api')->check() && auth('api')->user()->can('update',$homework);
        $profile['canDelete'] =  auth('api')->check() && auth('api')->user()->can('delete',$homework);
        $profile['commentsNum'] = $homework->comments()->count();

        return $profile;
    }

}