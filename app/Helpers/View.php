<?php

namespace App\Helpers;

use App\Models\WareHouse;

class View
{
    public static function getListActiveOptions()
    {
        return [
            config('common.active') => __('view.active'),
            config('common.not_active') => __('view.not_active')
        ];
    }

    public static function getListRoleOptions()
    {
        return [
            config('common.role.storekeeper') => __('view.role.storekeeper'),
            config('common.role.employee') => __('view.role.employee'),
//            config('common.role.admin') => __('view.role.admin'),
        ];
    }

    public static function getWareHouseName()
    {
        try {
            $wareHouse = WareHouse::query()->select('name')->where('id', '=', auth()->user()->warehouse_id)->first();
            return $wareHouse->name;

        } catch (\Exception $ex) {
            return null;
        }
    }

    public static function getListCategoryLevelOptions()
    {
        return [
            config('common.category_level.child') => __('view.category_level.child'),
            config('common.category_level.father') => __('view.category_level.father'),
        ];
    }

    public static function getFileExtension($file)
    {
        if (!is_string($file)) {
            return null;
        }
        $ext = explode(':', substr($file, 0, strpos($file, ';')));
        if (!isset($ext[1])) {
            return null;
        }
        $ext = explode('/', $ext[1]);
        return $ext[1] ?? null;
    }

    public static function getProductStatus()
    {
        return [
            config('common.product_status.available') => __('view.product_status.available'),
            config('common.product_status.unavailable') => __('view.product_status.unavailable'),
            config('common.product_status.suspended') => __('view.product_status.suspended'),
        ];
    }
}
