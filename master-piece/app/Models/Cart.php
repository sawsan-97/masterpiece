<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);//كل سله فيها اكتر من عنصر
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);//لكل سله ينتمي مستخدم واحد
    }

    public function getTotalQuantityAttribute()
    {
        return $this->items()->sum('quantity');
    }
}
