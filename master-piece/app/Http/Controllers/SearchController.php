<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // تحقق من وجود الكلمة المفتاحية
        if (empty($query)) {
            return redirect()->route('products.index')->with('message', 'يرجى إدخال كلمة للبحث');
        }

        // البحث في المنتجات
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(12);

        // تمرير البيانات إلى الواجهة مع معالجة pagination
        $products->appends(['query' => $query]);

        return view('search.results', [
            'products' => $products,
            'query' => $query, // استخدام 'query' بدلاً من 'searchQuery'
            'searchQuery' => $query // إبقاء هذا للتوافق مع results.blade.php
        ]);
    }
}