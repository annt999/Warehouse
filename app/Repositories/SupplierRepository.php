<?php

namespace App\Repositories;

use App\Models\Supplier;
use DB;
use Log;

class SupplierRepository
{
    public static function findById(?int $supplierId)
    {
        try {
            return Supplier::query()->where('id', $supplierId)
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Supplier::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->paginate(config('common.records_per_page'));
    }

    public static function getListSupplierOptions()
    {
        return Supplier::query()->select('id', 'name')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->get();
    }

    public static function store(array $dataInsert)
    {
        DB::beginTransaction();
        try {
            $supplierId = Supplier::create($dataInsert);
            DB::commit();
            return $supplierId;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return null;
        }
    }
    public static function update(Supplier $supplierId, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $supplierId->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return false;
        }
    }
}
