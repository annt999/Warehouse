<?php

namespace App\Repositories;

use App\Models\Brand;
use DB;
use Log;

class BrandRepository
{
    public static function findById(?int $brandId)
    {
        try {
            return Brand::query()
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->where('id', $brandId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Brand::query()->where('warehouse_id', auth()->user()->warehouse_id)->paginate(config('common.records_per_page'));
    }

    public static function getListBrandOptions()
    {
        return Brand::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->select('id', 'name')->get();
    }

    public static function store(array $dataInsert)
    {
        DB::beginTransaction();
        try {
            $brand = Brand::create($dataInsert);
            DB::commit();
            return $brand;
        } catch (\Exception $ex) {
            Log::error($ex);

            DB::rollBack();
            return null;
        }
    }
    public static function update(Brand $brand, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $brand->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return false;
        }
    }
}
