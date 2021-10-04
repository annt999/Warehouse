<?php

namespace App\Services;


use App\Http\Requests\WarehouseRequest;
use App\Repositories\WarehouseRepository;

class WarehouseService
{
    public static function store(WarehouseRequest $request)
    {
        $warehouseInsert = ['name' => $request->warehouse_name];
        $userInsert = $request->only(['user_name', 'name', 'email', 'phone_number', 'password']);
        $userInsert['password'] = \Hash::make($userInsert['password']);
        $userInsert['is_active'] = config('common.active');
        $userInsert['role'] = config('common.role.storekeeper');
        return WarehouseRepository::store($warehouseInsert, $userInsert);
    }
}
