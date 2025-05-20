<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::withCount('products')->latest()->paginate(10);
            return view('admin.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'حدث خطأ أثناء تحميل التصنيفات: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;
            $category->is_active = true;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/categories'), $imageName);
                $category->image = 'images/categories/' . $imageName;
            }

            $category->save();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم إضافة التصنيف بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة التصنيف: ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;

            if ($request->hasFile('image')) {
                // حذف الصورة القديمة
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/categories'), $imageName);
                $category->image = 'images/categories/' . $imageName;
            }

            $category->save();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم تحديث التصنيف بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث التصنيف: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            // حذف الصورة
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم حذف التصنيف بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف التصنيف: ' . $e->getMessage());
        }
    }
}
