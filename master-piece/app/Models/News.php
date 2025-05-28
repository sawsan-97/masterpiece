<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_active',
        'published_at',
        'user_id',
        'meta_description',//يوفر وظائف لإنشاء مقتطفات (excerpt) وتحسين البحث من خلال meta_description & meta_keywords

        'meta_keywords'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * العلاقة مع المستخدم الذي أنشأ الخبر
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * إنشاء excerpt للخبر
     */
    public function getExcerpt($length = 100)
    {
        return Str::limit(strip_tags($this->content), $length);// يتم إزالة الأكواد HTML (strip_tags()) لضمان أن الملخص لا يحتوي على عناصر غير مرغوبة.


    }

    /**
     * Scope للأخبار المفعلة فقط
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope للأخبار الأحدث
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (is_null($news->published_at)) {
                $news->published_at = now();
            }
        });
    }
}
