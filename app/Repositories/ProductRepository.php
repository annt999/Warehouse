<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public static function getList()
    {
        return Product::query()->paginate(config('common.records_per_page'));
    }
}
