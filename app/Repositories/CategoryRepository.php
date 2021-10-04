<?php

namespace App\Repositories;

use App\Models\Category;
use DB;
use Log;

class CategoryRepository
{
    public static function findById(?int $categoryId)
    {
        try {
            return Category::query()->where('id', $categoryId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Category::query()->paginate(config('common.records_per_page'));
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
        return Category::query()->select('id', 'name')->where('level', '=', config('common.category_level.father'))->get();
    }
}
