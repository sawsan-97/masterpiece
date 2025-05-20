<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * عرض نموذج إضافة تعليق جديد
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * حفظ تعليق جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|between:1,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'الرجاء إدخال الاسم',
            'content.required' => 'الرجاء إدخال التعليق',
            'content.min' => 'يجب أن يكون التعليق على الأقل 10 أحرف',
            'rating.required' => 'الرجاء تحديد التقييم',
            'rating.between' => 'التقييم يجب أن يكون بين 1 و 5',
            'image.image' => 'يجب أن يكون الملف المرفق صورة',
            'image.mimes' => 'صيغ الصور المسموح بها: jpeg, png, jpg',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',
        ]);

        $data = $request->only(['name', 'city', 'content', 'rating']);

        // إضافة معرف المستخدم إذا كان مسجل دخول
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        // معالجة الصورة إذا تم تحميلها
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/testimonials'), $imageName);
            $data['image'] = 'images/testimonials/' . $imageName;
        }

        Testimonial::create($data);

        return redirect()->route('home')->with('success', 'شكراً لك! تم إرسال تعليقك بنجاح وسيتم مراجعته قريباً.');
    }

    /**
     * عرض صفحة تحتوي على جميع التعليقات المعتمدة
     */
    public function index()
    {
        $testimonials = Testimonial::approved()->latest()->paginate(10);
        return view('testimonials.index', compact('testimonials'));
    }
}
