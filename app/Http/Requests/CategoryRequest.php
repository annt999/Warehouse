<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'level' => ['required', Rule::in(array_values(config('common.category_level')))],
        ];
        $categoryParentIds = Category::query()
            ->select('id')->where('level', config('common.category_level.father'))->get()->pluck('id')->toArray();
        if ($this->level == config('common.category_level.child')) {
            $rules['parent_id'] = ['required', Rule::in($categoryParentIds)];
        }
        return $rules;
    }
}
