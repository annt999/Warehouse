<?php

namespace App\Repositories;

use App\Models\Location;
use DB;
use Log;

class LocationRepository
{
    public static function findById(?int $locationId)
    {
        try {
            return Location::query()
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->where('id', $locationId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Location::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->paginate(config('common.records_per_page'));
    }

    public static function getListLocationOptions()
    {
        return Location::query()->select('id', 'name')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->get();
    }

    public static function store(array $dataInsert)
    {
        Log::error($dataInsert);
        DB::beginTransaction();
        try {
            $location = Location::create($dataInsert);
            DB::commit();
            return $location;
        } catch (\Exception $ex) {
            DB::rollBack();
            return null;
        }
    }
    public static function update(Location $Location, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $Location->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return false;
        }
    }
}
