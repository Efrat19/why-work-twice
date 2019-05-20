<?php

namespace App\Http\Requests\Homework;


use App\Homework;

class UpdateHomeworkRequest extends HomeworkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->user()->can('update',Homework::class,$this->request->get('id'));
    }

}
