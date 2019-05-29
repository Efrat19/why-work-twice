<?php

namespace App\Services;

use App\Homework;
use App\School;
use Illuminate\Support\Facades\DB;

/**
 * Class SmartSearch
 * @package App\Services\SmartSearch
 */
class SmartSearch implements ISmartSearch {

    /**
     * @param array $relatedModels
     * @return array
     */
    public function getFilters(array $relatedModels)
    {
        $filters = [];

        foreach ($relatedModels as $related) {
            $namespace = explode('\\',$related);
            $model = end($namespace);
            $filter = [
                'label' => $model,
                'options' => $related::all()->random(100)->map(function ($record){
                    return [
                        'value' => $record->id,
                        'text' => $record->name ?? $record->id,
                    ];
                })
            ];
            $filters[] = $filter;
        }

        return $filters;
    }

    public function getResults($resultModel, array $filters,int $page = 1)
    {
        $query = DB::table('homeworks');
        if(isset($filters['School'])){
            $query->where('school_id','=',$filters['School']);
        }
        if(isset($filters['Teacher'])){
            $query->where('teacher_id','=',$filters['Teacher']);
        }
        if(isset($filters['user'])){
            $query->where('user_id','=',$filters['User']);
        }
        if(isset($filters['Subject'])){
//            $query->
//            $query->whereHas('subjects',function ($query) use ($filters){
//                $query->where('id', '=',  $filters['Subject']);
//            });
        }
        return $query->paginate(50,['*'],'',$page);

    }
}
