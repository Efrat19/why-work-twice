<?php

namespace App\Http\Requests\Homework;

use Illuminate\Foundation\Http\FormRequest;

abstract class HomeworkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'source' => ['required', 'string', 'max:255', 'unique:homeworks,id'],
            'subject' => ['required'],
            'school' => ['required']
        ];
    }
}
