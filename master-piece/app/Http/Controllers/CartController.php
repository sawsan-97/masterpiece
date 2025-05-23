<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItems = $cart ? $cart->items : collect();
            $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);
            return view('cart.index', compact('cart', 'cartItems', 'total'));
        }
        return redirect()->route('login');
    }

    public function add(Request $request, Product $product)
{
    if (!Auth::check()) {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'يجب تسجيل الدخول أولاً لإضافة منتجات للسلة'
            ], 401);
        }
        return redirect()->route('login');
    }

    try {
        DB::beginTransaction();

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        // التحقق من المخزون المتاح قبل الإضافة
        $currentQuantity = $cartItem ? $cartItem->quantity : 0;
        if ($currentQuantity + 1 > $product->stock) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'لا يمكن إضافة أكثر من الكمية المتوفرة في المخزون! الكمية المتاحة: ' . $product->stock
                ], 422);
            }
            return redirect()->back()->with('error', 'لا يمكن إضافة أكثر من الكمية المتوفرة في المخزون! الكمية المتاحة: ' . $product->stock);
        }

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        DB::commit();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'تمت إضافة المنتج إلى السلة بنجاح',
                'cart_count' => $cart->items()->count()
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة بنجاح');

    } catch (\Exception $e) {
        DB::rollBack();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المنتج إلى السلة'
            ], 500);
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المنتج إلى السلة');
    }
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);
        $product = $cartItem->product;

        // التحقق من الكمية المطلوبة مقابل المخزون المتاح
        if ($request->quantity > $product->stock) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'الكمية المطلوبة غير متوفرة في المخزون. الكمية المتوفرة: ' . $product->stock
                ], 422);
            }
            return redirect()->back()->with('error', 'الكمية المطلوبة غير متوفرة في المخزون. الكمية المتوفرة: ' . $product->stock);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الكمية بنجاح'
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث الكمية بنجاح');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return redirect()->back()->with('success', 'تم حذف المنتج من السلة بنجاح');
    }

    public function clear()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->items()->delete();
            }
        }
        return redirect()->back()->with('success', 'تم تفريغ السلة بنجاح');
    }

    public function count()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $count = $cart ? $cart->items()->count() : 0;
        } else {
            $count = 0;
        }
        return response()->json(['count' => $count]);
    }
}
