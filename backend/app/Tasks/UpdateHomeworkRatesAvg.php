<?php

namespace App\Tasks;

use App\Homework;
use App\Rate;
use Illuminate\Support\Facades\DB;

class UpdateHomeworkRatesAvg {

    protected $CHUNK_SIZE = 1000;

    public function __invoke()
    {
        DB::table('homeworks')->orderBy('id')->chunk($this->CHUNK_SIZE,function ($homeworks) {
            foreach ($homeworks as $homework){
                $avgQuery = Rate::query();
                $avg = $avgQuery->where('homework_id','=', $homework->id)->avg('value');
                Homework::where('id','=',$homework->id)->update([
                    'rates_avg' => $avg
                ]);
            }
        });


    }
}
