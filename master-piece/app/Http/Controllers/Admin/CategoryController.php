<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::orderBy('name')->get();
            return view('admin.categories.index', compact('categories'));
        } catch (\Exception $e) {
            Log::error('خطأ في عرض التصنيفات: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'حدث خطأ أثناء تحميل التصنيفات');
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            // إنشاء slug فريد
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;
            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $category = Category::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true),
                'is_featured' => $request->boolean('is_featured', false)
            ]);

            DB::commit();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم إضافة التصنيف بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('خطأ في إضافة تصنيف: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة التصنيف');
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            // تحديث slug إذا تم تغيير الاسم
            if ($category->name !== $request->name) {
                $slug = Str::slug($request->name);
                $originalSlug = $slug;
                $counter = 1;
                while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $category->slug = $slug;
            }

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true),
                'is_featured' => $request->boolean('is_featured', false)
            ]);

            DB::commit();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم تحديث التصنيف بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('خطأ في تحديث تصنيف: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث التصنيف');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')
                ->with('success', 'تم حذف التصنيف بنجاح');
        } catch (\Exception $e) {
            Log::error('خطأ في حذف تصنيف: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف التصنيف');
        }
    }
}
