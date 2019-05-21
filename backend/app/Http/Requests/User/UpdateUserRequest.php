<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->user()->can('update',$this->request->get('id'));

//        $args = [
//            auth('api')->user(),
//            $this->request->get('id')
//        ];
//        return Gate::allows('update-user',$args);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required'],
            'school' => ['required'],
        ];
    }
}
