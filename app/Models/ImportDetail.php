<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $table = 'import_details';

    protected $fillable = [
        'import_history_id',
        'product_id',
        'quantity',
        'purchase_price',
        'sale_price',
    ];
}
