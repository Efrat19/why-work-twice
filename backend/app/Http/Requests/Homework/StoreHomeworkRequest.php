<?php

namespace App\Http\Requests\Homework;

use App\Homework;

class StoreHomeworkRequest extends HomeworkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create',Homework::class,$this->request->get('id'));
    }

}

