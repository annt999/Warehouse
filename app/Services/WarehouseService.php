<?php

namespace App\Services;


use App\Http\Requests\WarehouseRequest;
use App\Repositories\WarehouseRepository;

class WarehouseService
{
    public static function store(WarehouseRequest $request)
    {
        $warehouseInsert = ['name' => $request->warehouse_name];
        $userInsert = $request->only(['username', 'name', 'email', 'phone_number', 'password']);
        $userInsert['password'] = \Hash::make($userInsert['password']);
        $userInsert['is_active'] = config('common.active');
        $userInsert['role_id'] = config('common.role.storekeeper');
        return WarehouseRepository::store($warehouseInsert, $userInsert);
    }
}
