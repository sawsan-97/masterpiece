<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_active' => true,
        'is_featured' => false,
        'stock' => 0,
        'unit' => 'قطعة'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'stock',
        'unit',
        'is_active',
        'is_featured',
        'category_id',
        'image',
        'seller_name',
        'seller_phone',
        'seller_address'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'stock' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($product) {
            Log::info('تحديث المنتج', [
                'old_stock' => $product->getOriginal('stock'),
                'new_stock' => $product->stock,
                'changes' => $product->getDirty()
            ]);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);//كل منتج مرتبط بتصنيف واحد
    }

    // إضافة accessor للحصول على المسار الكامل للصورة
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/placeholder.jpg');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');//كل منتج يمكن أن يكون لديه عدة صور
    }

    // باقي العلاقات والوظائف...
}
