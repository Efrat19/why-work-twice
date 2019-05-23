<?php

namespace App\Repositories;


use App\DTO\Homework\StoreHomeworkDto;
use App\School;
use App\Subject;
use App\Homework;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeworkRepository implements HomeworkRepositoryInterface {

    /**
     * @param StoreHomeworkDto $dto
     * @return mixed
     */
    public function create(StoreHomeworkDto $dto)
    {
        $homework = Homework::create($dto->toArray());

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
     * @param Request $request
     * @param Homework $homework
     * @return mixed
     */
    public function delete(Homework $homework)
    {
        return $homework->delete();
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

    public function getProfile(Homework $homework)
    {
        $profile = $homework->toArray();
        $profile['user']= $homework->user;
        $profile['school'] = $homework->school;
        $profile['subject'] = $homework->subject;
        $profile['rating'] = $homework->getAvgRating();
        $profile['loved'] = false;
        if(auth()->check()){
            $profile['loved'] = $homework->favorites()->where('user_id', auth()->user())->count();
        }
        $profile['canEdit'] =  auth()->check() && auth()->user()->can('update',$homework);
        $profile['canDelete'] =  auth()->check() && auth()->user()->can('delete',$homework);
        $profile['commentsNum'] = $homework->comments()->count();

        return $profile;
    }


    public function forUser(User $user, $limit)
    {
        // Return a homeworks array of the specific user
        // array length is limited by limit parameter
        // to get all homeworks, set limit to -1

        $homeworks = $user->homeworks()->limit($limit)->get();
        return $homeworks->map(function ($homework, $key) {
            return $this->getProfile($homework);
        });
    }

}
