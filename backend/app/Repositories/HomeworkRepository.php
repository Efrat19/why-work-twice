<?php

namespace App\Repositories;


use App\DTO\Homework\StoreHomeworkDto;
use App\Http\Requests\Homework\HomeworkRequest;
use App\School;
use App\Subject;
use App\Homework;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class HomeworkRepository implements HomeworkRepositoryInterface {



    public function create(HomeworkRequest $request)
    {

        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);

        $homework = Homework::create([
            'description' => $request->get('description'),
            'source' => $this->storeFilesAndGetPath($request->file('source')),
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'user_id' => auth()->id()
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

    protected function storeFilesAndGetPath(UploadedFile $file)
    {
//        dd($source);
//        foreach ($source as $file){
            $fileName = time().$file->getClientOriginalName();
            Storage::put(
                'public/'.$fileName,
                file_get_contents($file->getRealPath())
            );
//        }
//
        return asset('storage/'.$fileName);
    }
}
