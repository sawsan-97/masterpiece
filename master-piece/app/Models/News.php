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
        'meta_description',
        'meta_keywords',
        'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime'
    ];

    protected $appends = ['image_url'];

    /**
     * الحصول على رابط الصورة الكامل
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * الحصول على ملخص المحتوى
     */
    public function getExcerpt($length = 150)
    {
        return Str::limit(strip_tags($this->content), $length);
    }

    /**
     * العلاقة مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * إعداد القيم الافتراضية قبل الحفظ
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            Log::info('إنشاء خبر جديد', [
                'title' => $news->title,
                'user_id' => $news->user_id
            ]);

            // إنشاء slug من العنوان إذا لم يتم تحديده
            if (!$news->slug) {
                $news->slug = Str::slug($news->title);
            }

            // تعيين user_id إذا لم يتم تحديده
            if (!$news->user_id && Auth::check()) {
                $news->user_id = Auth::id();
            }
        });

        static::created(function ($news) {
            Log::info('تم إنشاء الخبر بنجاح', [
                'news_id' => $news->id,
                'user_id' => $news->user_id
            ]);
        });
    }
}
