<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('category')->latest()->paginate(10);
            return view('admin.products.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'حدث خطأ أثناء تحميل المنتجات: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            return view('admin.products.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'حدث خطأ أثناء تحميل صفحة إضافة المنتج: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'images' => 'nullable|array', // حذف شرط max
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // كل صورة حتى 5MB
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // إنشاء slug فريد
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // احفظ صورة رئيسية إذا تم رفعها
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // صورة رئيسية أو null
            'category_id' => $request->category_id,
            'stock' => $request->stock ?? 0,
            'unit' => $request->unit ?? 'قطعة',
            'is_active' => true,
            'is_featured' => false,
            'sale_price' => $request->sale_price,
        ]);

        // أضف صورة رئيسية إلى جدول الصور إذا تم رفعها
        if ($imagePath) {
            $product->images()->create([
                'image_path' => $imagePath,
                'is_primary' => true,
                'order' => 0,
            ]);
        }

        // أضف الصور الإضافية
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => !$imagePath && $key == 0, // إذا لم يكن هناك صورة رئيسية، اجعل أول صورة إضافية رئيسية
                    'order' => $key + 1,
                ]);
                // إذا لم يكن هناك صورة رئيسية، احفظ أول صورة إضافية في عمود image
                if (!$imagePath && $key == 0) {
                    $product->image = $path;
                    $product->save();
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        try {
            $categories = Category::all();
            return view('admin.products.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'حدث خطأ أثناء تحميل صفحة تعديل المنتج: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        \Log::info('بدء تحديث المنتج', [
            'product_id' => $product->id,
            'request_data' => $request->all()
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        try {
            \DB::beginTransaction();

            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->is_active = $request->input('is_active', 0);
            $product->is_featured = $request->input('is_featured', 0);
            $product->stock = $request->stock;
            $product->unit = $request->unit;

            $product->save();

            // حذف الصور المحددة
            if ($request->has('delete_images')) {
                $deleteImageIds = $request->input('delete_images');
                $imagesToDelete = $product->images()->whereIn('id', $deleteImageIds)->get();
                foreach ($imagesToDelete as $img) {
                    // حذف من التخزين إذا كانت الصورة موجودة
                    if ($img->image_path && \Storage::disk('public')->exists($img->image_path)) {
                        \Storage::disk('public')->delete($img->image_path);
                    }
                    // إذا كانت هذه الصورة هي الرئيسية، سنحتاج لتعيين صورة رئيسية جديدة لاحقاً
                    $wasPrimary = $img->is_primary;
                    $img->delete();
                    // إذا كانت الصورة الرئيسية، حدث عمود image في المنتج
                    if ($wasPrimary) {
                        $newPrimary = $product->images()->first();
                        if ($newPrimary) {
                            $newPrimary->is_primary = true;
                            $newPrimary->save();
                            $product->image = $newPrimary->image_path;
                        } else {
                            $product->image = null;
                        }
                        $product->save();
                    }
                }
            }

            // إضافة صور جديدة إذا تم رفعها
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create([
                        'image_path' => $path,
                        'is_primary' => false, // يمكن تعديلها لاحقاً
                        'order' => $product->images()->count() + $key,
                    ]);
                    // إذا لم يكن للمنتج صورة رئيسية، اجعل أول صورة جديدة هي الرئيسية
                    if (!$product->image) {
                        $product->image = $path;
                        $product->save();
                    }
                }
            }

            \Log::info('تم تحديث المنتج بنجاح', [
                'product_id' => $product->id,
                'updated_data' => $product->toArray()
            ]);

            \DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'تم تحديث المنتج بنجاح');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('خطأ في تحديث المنتج', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث المنتج: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            // حذف الصورة
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'تم حذف المنتج بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف المنتج: ' . $e->getMessage());
        }
    }
}
