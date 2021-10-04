<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

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
            'success' => __('message.create_user_successfully'),
        ];
    }
}
