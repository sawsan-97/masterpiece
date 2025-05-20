<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlistItems = Auth::user()->wishlist()->with('product')->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Request $request, Product $product)
    {
        $wishlist = Auth::user()->wishlist()->where('product_id', $product->id)->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'تم إزالة المنتج من قائمة المفضلة';
            $status = false;
        } else {
            Auth::user()->wishlist()->create([
                'product_id' => $product->id
            ]);
            $message = 'تم إضافة المنتج إلى قائمة المفضلة';
            $status = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'status' => $status
            ]);
        }

        return back()->with('success', $message);
    }

    public function remove(Product $product)
    {
        Auth::user()->wishlist()->where('product_id', $product->id)->delete();
        return back()->with('success', 'تم إزالة المنتج من قائمة المفضلة');
    }
}
