<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);//كل عنصر ينتمي إلى طلب واحد

    }

    public function product()
    {
        return $this->belongsTo(Product::class);// كل عنصر مرتبط بمنتج واحد

    }
}
