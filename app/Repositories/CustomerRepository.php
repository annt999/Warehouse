<?php

namespace App\Repositories;

use App\Models\Customer;
use DB;

class CustomerRepository
{
    public static function findById(?int $CustomerId)
    {
        try {
            return Customer::query()
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->where('id', $CustomerId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }
    public static function getList()
    {
        return Customer::query()
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->paginate(config('common.records_per_page'));
    }

    public static function getListCustomerOptions()
    {
        return Customer::query()->select('id', 'name')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->get();
    }

    public static function store(array $dataInsert)
    {
        DB::beginTransaction();
        try {
            $Customer = Customer::create($dataInsert);
            DB::commit();
            return $Customer;
        } catch (\Exception $ex) {
            \Log::error($ex);
            DB::rollBack();
            return null;
        }
    }
    public static function update(Customer $Customer, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $Customer->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            return false;
        }
    }
}
