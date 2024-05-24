<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'product_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $product = $sale->product;
            if ($product->stock < $sale->quantity) {
                Notification::make()
                ->title('La cantidad solicitada supera el stock disponible.')
                ->danger()
                ->send();
                throw new Halt();
            }
        });
        
        static::created(function ($sale) {
            $product = $sale->product;
            $product->stock -= $sale->quantity;
            $product->save();
        });

        static::updating(function ($sale) {
            $saleOld = Sale::find($sale->id);

            $product = $sale->product;
            $total_stock = $product->stock += $saleOld->quantity;
            if ($total_stock < $sale->quantity) {
                Notification::make()
                ->title('La cantidad solicitada supera el stock disponible.')
                ->danger()
                ->send();
                throw new Halt();
            }
        });

        static::updated(function ($sale) {
            $product = $sale->product;
            $product->stock -= $sale->quantity;
            $product->save();
        });

        static::deleted(function ($sale) {
            $product = $sale->product;
            $product->stock += $sale->quantity;
            $product->save();
        });

        
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
