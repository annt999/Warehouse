<?php

namespace App\Services;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService
{
    public static function findById(?int $customerId)
    {
        return $customerId ? CustomerRepository::findById($customerId) : null;
    }
    public static function getList()
    {
        return CustomerRepository::getList();
    }
    public static function store(CustomerRequest $request)
    {
        $dataInsert = $request->only(['name', 'phone_number', 'email', 'address', 'gender', 'birthday']);
        $dataInsert['warehouse_id'] = auth()->user()->warehouse_id;
        return CustomerRepository::store($dataInsert);
    }
    public static function update(Customer $customer,CustomerRequest $request)
    {
        $dataUpdate = $request->only(['name', 'phone_number', 'email', 'address', 'gender', 'birthday']);
        if (!CustomerRepository::update($customer, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('Update customer successfully'),
            'view' => \View::make('admin.customers.table', [
                'customers' => CustomerService::getList(),
                'genderOptions' => array_flip(config('common.gender')),
            ])->render()
        ];

    }
}
