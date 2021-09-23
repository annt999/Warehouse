<?php

namespace App\Http\Requests;

use App\Helpers\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
            'brand_name' => 'required',
            'image' => 'required|string',
            'extension' => 'required|'. Rule::in(config('rules.brand.allowed_file_extension')),
        ];
        if ($this->getMethod() == 'POST') {
            $rules += [

            ];
        }
        return $rules;
    }
}
