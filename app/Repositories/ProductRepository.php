<?php

namespace App\Repositories;

use App\Helpers\Common;
use App\Models\Product;
use DB;
use Log;

class ProductRepository
{
    public static function findById(?int $productId)
    {
        try {
            return Product::query()
                ->where('warehouse_id', auth()->user()->warehouse_id)
                ->where('id', $productId)
                ->first();
        } catch (\Exception $ex) {
            return null;
        }
    }

    public static function getList(array $dataSearch)
    {
        $query = Product::query();
        $query->select('products.*', 'categories.name as category_name', 'brands.image as brand_image',
                              'brands.name as brand_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->leftJoin('brands', 'brands.id', 'products.brand_id')
            ->where('products.warehouse_id', auth()->user()->warehouse_id);
        if (isset($dataSearch['product_code'])) {
            $query->where('products.product_code', $dataSearch['product_code']);
        };

        if (isset($dataSearch['name'])) {
            $query->where('products.name','like', '%'. $dataSearch['name'] .'%');
        }

        if (isset($dataSearch['brand_id'])) {
            $query->where('brands.id', $dataSearch['brand_id']);
        }

        if (isset($dataSearch['category_child_id'])) {
            $query->where('categories.id', $dataSearch['category_child_id']);
        }
        if (isset($dataSearch['category_father_id'])) {
            $query->where('categories.parent_id', $dataSearch['category_father_id']);
        }
        if (isset($dataSearch['status'])) {
            $query->where('products.status', $dataSearch['status']);
        }

        if (isset($dataSearch['quantity_min'])) {
            $query->where('products.quantity', '>=', $dataSearch['quantity_min']);
        }

        if (isset($dataSearch['quantity_max'])) {
            $query->where('products.quantity', '<=', $dataSearch['quantity_max']);
        }

        return $query->orderBy('created_at')->paginate(config('common.records_per_page'));
    }

    public static function store(array $dataInsert)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($dataInsert);
            DB::commit();
            return $product;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return null;
        }
    }

    public static function update(Product $product, array $dataUpdate)
    {
        DB::beginTransaction();
        try {
            $product->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return false;
        }
    }

    public static function getMaxId()
    {
        return Product::query()->max('id');
    }

    public static function getInfoById(int $id)
    {
        return Product::query()
            ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name',
                     'categories.parent_id', 'locations.name as location_name',)
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->leftJoin('locations', 'locations.id', '=', 'products.location_id')
            ->where('products.id', $id)
            ->where('products.warehouse_id', auth()->user()->warehouse_id)
            ->first();
    }
}
