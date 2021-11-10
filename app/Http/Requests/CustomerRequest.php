<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Rules\UniqueCustomerInWarehouseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'phone_number' => [
                'required',
                'digits:10',
                Rule::unique('customers')->where('warehouse_id', auth()->user()->warehouse_id)->whereNot('id', $this->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->where('warehouse_id', auth()->user()->warehouse_id)->whereNot('id', $this->id)
            ],
            'gender' => 'required|'. Rule::in(array_values(config('common.gender'))),
            'birthday' => 'date_format:Y-m-d|before:today|nullable',
        ];
    }
}
