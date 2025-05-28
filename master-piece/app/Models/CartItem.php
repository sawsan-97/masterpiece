<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function cart(): BelongsTo//هذا يعني أن كل عنصر ينتمي إلى عربة واحدة فقط

    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo//هذا يعني أن كل عنصر مرتبط بمنتج واحد
    {
        return $this->belongsTo(Product::class);
    }
}
