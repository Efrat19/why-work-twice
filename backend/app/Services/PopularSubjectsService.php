<?php

namespace App\Services;

use App\Homework;
use App\Subject;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PopularSubjectsService{

    static $TTL = 3600;
    static $CACHE_KEY = 'topSubjects';

    public function getTop($subjectsNum)
    {
        $topSubjects = Cache::get(self::$CACHE_KEY,function () use ($subjectsNum){
            $top = $this->getTopFromDB($subjectsNum);
            Cache::put(self::$CACHE_KEY,$top,self::$TTL);
            return $top;
        });
        return $topSubjects;
    }

    protected function getTopFromDB($subjectsNum)
    {
        $query = Subject::query();
        return $query->join('homework_subject','subjects.id','=','homework_subject.subject_id')
            ->select([
                DB::raw('count(*) as homeworksNum'),
                'subjects.id',
                'subjects.name',
            ])->groupBy('subjects.id')
            ->orderBy('homeworksNum','DESC')
            ->take($subjectsNum)->get();
    }
}
