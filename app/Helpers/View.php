<?php

namespace App\Helpers;

class View
{
    public static function getListActiveOptions(): array
    {
        return [
            config('common.active') => __('view.active'),
            config('common.not_active') => __('view.not_active')
        ];
    }

    public static function getListRoleOptions()
    {
        return [
            config('common.role.employee') => __('view.role.employee'),
            config('common.role.admin') => __('view.role.admin'),
        ];
    }

    public static function getListCategoryLevelOptions()
    {
        return [
            config('common.category_level.child') => __('view.category_level.child'),
            config('common.category_level.father') => __('view.category_level.father'),
        ];
    }

    public static function getFileExtension($file): ?string
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
}
