<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب الأخبار مرتبة حسب تاريخ النشر تنازلياً
        $news = News::latest()->paginate(10);

        // جلب المنتجات النشطة والمميزة
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        // جلب التصنيفات النشطة فقط
        $categories = Category::where('is_active', true)->get();

        return view('home', compact('featuredProducts', 'categories', 'news'));
    }

    private function getSearchResults($query)
    {
        if (empty($query)) return collect([]);

        return Product::where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%")
              ->orWhereHas('category', function($q) use ($query) {
                  $q->where('name', 'like', "%{$query}%");
              });
        })
        ->where('is_active', true)
        ->with('category')
        ->paginate(12);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        if (empty($query)) return redirect()->route('home');

        $products = $this->getSearchResults($query);
        return view('search', compact('products', 'query'));
    }
}
