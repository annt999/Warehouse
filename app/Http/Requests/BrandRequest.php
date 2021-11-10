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
            'name' => 'required',
            'image' => 'required|string',
            'extension' => 'required|'. Rule::in(config('rules.allowed_file_extension')),
        ];
        if ($this->getMethod() == 'POST') {
            $rules += [

            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'extension.required' => 'Image is required',
            'extension.in' => 'The file is not in the correct format',
        ];
    }
}
