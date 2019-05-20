<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

abstract class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'header' => ['required', 'string', 'max:255'],
            'body' => [ 'string', 'max:255'],
        ];
    }
}
