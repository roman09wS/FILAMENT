<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_cost',
        'quantity',
        'inventory_id',
        'product_id',
    ];
}
