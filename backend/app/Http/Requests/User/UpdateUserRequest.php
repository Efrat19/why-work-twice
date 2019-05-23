<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return auth()->user()->can('update',$this->request->get('id'));

        $args = [
            auth()->user(),
            $this->request->get('id')
        ];
        return Gate::allows('update-user',$args);
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
