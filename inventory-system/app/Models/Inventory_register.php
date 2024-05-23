<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Inventory_register extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'total',
        'inventory_status',
    ];

    /**
     * Get the inventory_details associated with the Inventory_register
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function inventory_details(): HasOne
    // {
    //     return $this->hasOne(Inventory_detail::class);
    // }

    /**
     * Get all of the inventory_details for the Inventory_register
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventory_details(): HasMany
    {
        return $this->hasMany(Inventory_detail::class);
    }
}
