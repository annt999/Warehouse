<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public static function getList()
    {
        return ProductRepository::getList();

    }
}
