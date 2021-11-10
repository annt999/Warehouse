<?php

namespace App\Http\Controllers;

use App\Helpers\View;
use App\Http\Requests\WarehouseRequest;
use App\Models\WareHouse;
use App\Services\WarehouseService;

class WarehouseController extends Controller
{
    public static function create()
    {
        return view('auth.register');
    }

    public static function store(WarehouseRequest $request)
    {
        if (!WarehouseService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('Create successfully'),
        ];
    }

    public static function index()
    {
        return view('admin.warehouses.index',
            [
                'warehouses' => WareHouse::query()->paginate(10),
                'activeOptions' => View::getListActiveOptions(),
            ]);
    }

    public static function changeStatus($id)
    {
        $warehouse = WareHouse::query()->findOrFail($id);
        if (!$warehouse) {
            abort(404);
        }
        if ($warehouse->is_active == config('common.active')) {
            $warehouse->is_active = config('common.not_active');
        } else {
            $warehouse->is_active = config('common.active');
        }
        $warehouse->save();

        toastr()->success('success');
        return redirect()->route('warehouse.index');
    }
}
