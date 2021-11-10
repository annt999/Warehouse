<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [

            'name' => 'required|min:10|max:50',
            'phone_number' => 'required|digits:10|unique:users,phone_number,'.$this->id,
            'role_id' => ['required', Rule::in(array_values(config('common.role')))],
            'is_active' => ['required', Rule::in([config('common.active'), config('common.not_active')])],
        ];
        if ($this->getMethod() == 'POST') {
            $rules += [
                'username' => 'required|min:6|max:20|unique:users,username,' . $this->id,
                'email' => 'required|email|unique:users,email,'.$this->id,
            ];
        }
        return $rules;
    }
}
