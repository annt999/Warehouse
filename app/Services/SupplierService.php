<?php

namespace App\Services;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;

class SupplierService
{
    public static function findById(?int $SupplierId)
    {
        return $SupplierId ? SupplierRepository::findById($SupplierId) : null;
    }
    public static function getList()
    {
        return SupplierRepository::getList();
    }
    public static function store(SupplierRequest $request)
    {
        $dataInsert = $request->only(['name', 'description', 'phone']);
        $dataInsert['warehouse_id'] = auth()->user()->warehouse_id;
        return SupplierRepository::store($dataInsert);
    }
    public static function update(Supplier $supplier,SupplierRequest $request)
    {
        $dataUpdate = $request->only(['name', 'description', 'phone']);
        if (!SupplierRepository::update($supplier, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => 'Update supplier successfully',
            'view' => \View::make('admin.suppliers.table', [
                'suppliers' => SupplierService::getList(),
            ])->render()
        ];
    }

}
