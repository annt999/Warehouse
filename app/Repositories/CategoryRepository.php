<?php

namespace App\Repositories;

use App\Models\Category;
use DB;
use Log;

class CategoryRepository
{
    public static function findById(int $categoryId)
    {
        try {
            return Category::query()
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->where('id', $categoryId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Category::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->paginate(config('common.records_per_page'));
    }

    public static function getSubCategoryIds()
    {
        return Category::query()->select('id')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->where('level', '=', config('common.category_level.child'))->get()->pluck('id');
    }

    public static function store(array $dataInsert)
    {
        DB::beginTransaction();
        try {
            $category = Category::create($dataInsert);
            Log::error($category);
            DB::commit();
            return $category;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return null;
        }
    }
    public static function update(Category $category, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $category->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return false;
        }
    }
    public static function getCategoryFathers()
    {
        return Category::query()
            ->select('id', 'name')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->where('level', '=', config('common.category_level.father'))
            ->get();
    }

    public static function getCategoryChilds()
    {
        return Category::query()
            ->select('id', 'name', 'parent_id')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->where('level', '=', config('common.category_level.child'))
            ->get()->groupBy('parent_id');
    }

    public static function getById($id)
    {
        return Category::query()
            ->select('*')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->find($id);
    }
}
