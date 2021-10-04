<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
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
        return [
            'warehouse_name' => 'required|min:6|max:50',
            'user_name' => 'required|min:6|max:20',
            'name' => 'required|min:10|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|digits:10',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|string|same:password',
        ];
    }
}
