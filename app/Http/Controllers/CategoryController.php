<?php

namespace App\Http\Controllers;

use App\Helpers\View;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            return [
                'success' => __('message.create_user_successfully'),
                'view' => \View::make('admin.categories.table',
                                      [
                                          'categories' => CategoryService::getList(),
                                          'levelOptions' => View::getListCategoryLevelOptions(),
                                          'categoryFatherOptions' => CategoryService::getCategoryFathers()->keyBy('id')
                                      ])->render()
            ];
        }
        return view('admin.categories.index', [
            'categories' => Categoryservice::getList(),
            'levelOptions' => View::getListCategoryLevelOptions(),
            'categoryFatherOptions' => CategoryService::getCategoryFathers()->keyBy('id')
        ]);
    }

    public static function edit(string $id)
    {
        if (!($category = CategoryService::findById($id))) {
            return ['error' => __('message.category_is_not_exist')];
        }
        return ['category' => $category];
    }
    public static function store(CategoryRequest $request)
    {
        if (!CategoryService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.create_category_successfully'),
            'view' => \View::make(
                'admin.categories.table',
                [
                    'categories' => CategoryRepository::getList(),
                    'levelOptions' => View::getListCategoryLevelOptions(),
                    'categoryFatherOptions' => CategoryService::getCategoryFathers()->keyBy('id')
                ])->render(),
            'form' => \View::make(
                'admin.categories.form',
                [
                    'levelOptions' => View::getListCategoryLevelOptions(),
                    'categoryFatherOptions' => CategoryService::getCategoryFathers()->keyBy('id')
                ])->render()
        ];
    }
    public static function update(CategoryRequest $request)
    {
        \Log::error($request);
        $categoryId = $request->get('id');
        if (!($category = CategoryService::findById($categoryId))) {
            return ['error' => __('message.category_is_not_exist')];
        }
        return CategoryService::update($category, $request);
    }
}
