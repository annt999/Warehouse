<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WareHouse;
use DB;
use Log;

class WarehouseRepository
{
    public static function store(array $warehouseInsert, array $userInsert)
    {
        DB::beginTransaction();
        try {
            $warehouse = WareHouse::create($warehouseInsert);
            $userInsert['warehouse_id'] = $warehouse->id;
            $user = User::create($userInsert);
            DB::commit();
            return ['user' => $user, 'warehouse' => $warehouse];
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return null;
        }
    }
}
