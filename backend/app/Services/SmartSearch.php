<?php

namespace App\Services;

use App\Homework;
use App\School;
use Illuminate\Support\Facades\DB;

/**
 * Class SmartSearch
 * @package App\Services\SmartSearch
 */
class SmartSearch implements ISmartSearch
{

    /**
     * @param array $relatedModels
     * @return array
     */
    public function getFilters(array $relatedModels)
    {
        $filters = [];

        foreach ($relatedModels as $related) {
            $namespace = explode('\\', $related);
            $model = end($namespace);
            $filter = [
                'label' => $model,
                'options' => $related::take(100)->get()->map(function ($record) {
                    return [
                        'value' => $record->id,
                        'text' => $record->name ?? $record->id,
                    ];
                })
            ];
            $filters[] = $filter;
        }

        $filters[] = [
            'label' => 'Rating',
            'options' => collect(range(0,5))->map(function ($rate) {
                return [
                    'value' => $rate,
                    'text' => $rate
                ];
            })
        ];

        return $filters;
    }

    public function getResults($resultModel, array $filters, int $page = 1)
    {
        $query = Homework::query();
        DB::enableQueryLog();
        if (isset($filters['School'])) {
            $query->where('school_id', '=', $filters['School']);
        }
        if (isset($filters['Teacher'])) {
            $query->where('teacher_id', '=', $filters['Teacher']);
        }
        if (isset($filters['user'])) {
            $query->where('user_id', '=', $filters['User']);
        }
        if (isset($filters['Rating'])) {
//            $query
//                ->join((DB::raw(
//                    '(select homework_id,avg(value) as avg_value from rates group by homework_id) as rates_avg')),
//                    'homeworks.id','=','rates_avg.homework_id')
//                ->join('rates', 'homeworks.id','=', 'rates.homework_id')
//                ->where('rates_avg.avg_value','>=',$filters['Rating']);
            $query->where('rates_avg','>=', $filters['Rating']);
        }

        /*


        select count(*) as aggregate from `homeworks`
            where `school_id` = ?
                and `id` < ?

                and exists (
                    select * from `subjects`
                        inner join `homework_subject`
                            on `subjects`.`id` = `homework_subject`.`subject_id`
                        where `homeworks`.`id` = `homework_subject`.`homework_id`
                        and `id` = ?
                 )


*/

//        $filters['Subject'] = 2168;

        if (isset($filters['Subject'])) {
//            $query->where('id', '=', 12886);
//            $query->whereHas('subjects', function ($query) use ($filters) {
//                $query->where('id', '=', $filters['Subject']);
//            });
            $query
                ->join('homework_subject','homeworks.id','=','homework_subject.homework_id')
//                ->join('subjects','homework_subject.subject_id','=','subjects.id')
                ->where('homework_subject.subject_id','=',$filters['Subject'] );
        }
//        $query->take(10)->get();


        return $query->select('homeworks.*')->take(50)->get();

    }
}
