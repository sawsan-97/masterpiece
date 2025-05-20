<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي
     */
    protected $fillable = [
        'name',
        'city',
        'content',
        'rating',
        'image',
        'user_id',
    ];

    /**
     * علاقة مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الحصول على آراء العملاء المعتمدة فقط
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * الحصول على آراء العملاء المميزة
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
