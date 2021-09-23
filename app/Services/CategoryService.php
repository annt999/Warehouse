<?php

namespace App\Services;

use App\Helpers\View;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public static function findById(?int $categoryId)
    {
        return $categoryId ? CategoryRepository::findById($categoryId) : null;
    }
    public static function getList()
    {
        return CategoryRepository::getList();
    }
    public static function store(CategoryRequest $request)
    {
        $dataInsert = $request->only(['category_name', 'level', 'category_id']);
        \Log::error($dataInsert);
        return CategoryRepository::store($dataInsert);
    }
    public static function update(Category $category,CategoryRequest $request)
    {
        $dataUpdate = $request->only(['category_name', 'level', 'category_id']);
        \Log::error($dataUpdate);
        if (!CategoryRepository::update($category, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.update_category_successfully'),
            'view' => \View::make('admin.categories.table', [
                'categories' => CategoryService::getList(),
                'levelOptions' => View::getListCategoryLevelOptions(),
                'categoryFatherOptions' => CategoryService::getCategoryFathers()->keyBy('id')
            ])->render()
        ];
    }
    public static function getCategoryFathers()
    {
        return CategoryRepository::getCategoryFathers();
    }
}
