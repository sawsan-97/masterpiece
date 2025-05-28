<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'is_featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    public function products(): HasMany//هذا يعني أن كل تصنيف يحتوي على عدة منتجات
    {
        return $this->hasMany(Product::class);// يحدد أن slug يجب استخدامه في الروابط بدلاً من id.
        //✅ مثال: بدلاً من /categories/1 سيكون /categories/electronics.
       // 🚀 هذا يجعل الروابط أكثر قابلية للفهم ومحسنة لمحركات البحث (SEO).//



    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
