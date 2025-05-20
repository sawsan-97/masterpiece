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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'stock' => $request->stock ?? 0,
            'unit' => $request->unit ?? 'قطعة',
            'is_active' => true,
            'is_featured' => false,
            'sale_price' => $request->sale_price,
        ]);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            $product->is_active = $request->has('is_active');
            $product->is_featured = $request->has('is_featured');
            $product->stock = $request->stock;
            $product->unit = $request->unit;

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $request->file('image')->store('products', 'public');
            }

            $product->save();

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
