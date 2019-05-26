<?php

namespace App\Http\Requests\Homework;

use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
            'source' => ['required','max:10000','mimes:doc,docx,png,jpg,ico'],
            'subject' => ['required'],
            'school' => ['required']
        ];
    }
}
