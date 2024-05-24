<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'product_status'
    ];

    /**
     * Get all of the inventory_details for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     /**
      * Get the user associated with the Product
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
    //  public function user(): HasOne
    //  {
    //      return $this->hasOne(User::class, 'foreign_key', 'local_key');
    //  }

    public function inventoryDetails(): HasMany
    {
        return $this->hasMany(InventoryDetail::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($product) {
    //         $inventoryDetail = $product->inventoryDetail;
    //         $inventoryDetail->quantity = 999;
    //         $inventoryDetail->save();
    //     });
    // }

}
