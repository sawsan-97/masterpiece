<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'shipping_address',
        'notes',
        'subtotal',
        'discount',
        'total',
        'coupon_code',
        'coupon_discount',
        'status',
        'payment_status',
        'payment_method'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    public static function generateOrderNumber()
    {
        $orderNumber = 'NS-' . date('Ymd') . '-' . rand(1000, 9999);

        while (self::where('order_number', $orderNumber)->exists()) {
            $orderNumber = 'NS-' . date('Ymd') . '-' . rand(1000, 9999);
        }

        return $orderNumber;
    }
}
