<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()
            ->where('is_active', true)
            ->with(['images' => function($query) {
                $query->orderBy('is_primary', 'desc')
                      ->orderBy('sort_order', 'asc');
            }])
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
