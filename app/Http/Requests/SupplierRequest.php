<?php

namespace App\Http\Requests;

use App\Rules\UniqueSupplierWarehouseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('suppliers')->where('warehouse_id', auth()->user()->warehouse_id)->whereNot('id', $this->id)
            ],
            'phone' => 'nullable|numeric|digits:10',
        ];
    }
}
