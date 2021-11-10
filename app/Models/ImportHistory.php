<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    use HasFactory;

    protected $table = 'import_history';

    protected $fillable = [
        'total',
        'supplier_id',
        'created_by',
        'warehouse_id'
    ];
}
