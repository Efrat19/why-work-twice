<?php

namespace App\Http\Requests\Homework;

use App\Homework;

class DeleteHomeworkRequest extends HomeworkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Homework $homework)
    {
        return auth()->user()->can('update', $homework);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
