<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class InventoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_cost',
        'quantity',
        'product_id',
    ];

    /**
     * Get the products that owns the Inventory_detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function boot()
    {
        parent::boot();
        
        static::created(function ($inventorydetail) {
            $product = $inventorydetail->product;
            $product->stock = $inventorydetail->quantity;
            $product->save();
            
        });

        static::updated(function ($inventorydetail){
            $product = $inventorydetail->product;
            $product->stock = $inventorydetail->quantity;
            $product->save();
        });

        static::deleted(function ($inventorydetail){
            $product = $inventorydetail->product;
            $product->stock = 0;
            $product->save();
        });
        


    }




}
