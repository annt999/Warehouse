<?php

namespace App\Http\Requests;

use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:6',
            'image' => 'required',
            'location_id' => 'required|exists:locations,id',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id|'. Rule::in(CategoryRepository::getSubCategoryIds()),
            'status' => 'required|' . Rule::in(array_values(config('common.product_status'))),
        ];

        if (\Request::route()->getName() == 'product.store') {
            $rules['extension'] = 'required|' . Rule::in(config('rules.allowed_file_extension')) ;
        }

        if ($this->sale_price != 0) {
            $rules['sale_price'] = 'nullable|regex:/^[1-9].*[0-9]/';
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
