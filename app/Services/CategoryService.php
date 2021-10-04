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
        $dataInsert = $request->only(['name', 'level', 'parent_id']);
        $dataInsert['ware_house_id'] = auth()->user()->ware_house_id;
        return CategoryRepository::store($dataInsert);
    }
    public static function update(Category $category,CategoryRequest $request)
    {
        if ($category->parent_id) {
            $dataUpdate = $request->only(['name', 'parent_id']);
        } else {
            $dataUpdate = $request->only(['name']);
        }
        if (!CategoryRepository::update($category, $dataUpdate)) {
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
