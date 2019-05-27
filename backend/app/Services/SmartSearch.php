<?php

namespace App\Services;

use App\Homework;

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
                'options' => $related::all()->map(function ($record){
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

    public function getResults($resultModel, array $filters)
    {
        return Homework::where([
            ['school_id','LIKE',$filters['School'] ?? '%'],
            ['teacher_id','LIKE',$filters['Teacher'] ?? '%'],
            ['user_id','LIKE',$filters['User'] ?? '%'],
            ['user_id','LIKE',$filters['User'] ?? '%']
        ])->whereHas('subjects',function ($query) use ($filters){
            $query->where('id','LIKE',$filters['Subject'] ?? '%');
        })->get();

    }
}
