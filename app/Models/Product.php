<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable =
        [
            'warehouse_id',
            'product_code',
            'name',
            'description',
            'image',
            'location_id',
            'brand_id',
            'category_id',
            'quantity_inventory',
            'purchase_price',
            'sale_price',
            'status',
            'supplier_id',
        ];
}
