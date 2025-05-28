<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي
     */
    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    /**
     * تحويل بعض الحقول لأنواع بيانات أخرى
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * علاقة مع المنتج
     */
    public function product()
    {
        return $this->belongsTo(Product::class);//كل صورة مرتبطة بمنتج واحد (
    }
}
