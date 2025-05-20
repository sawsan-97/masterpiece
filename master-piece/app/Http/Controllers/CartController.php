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
            return redirect()->route('login');
        }

        try {
            DB::beginTransaction();

            // الحصول على سلة المستخدم أو إنشاء سلة جديدة
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // التحقق من وجود المنتج في السلة
            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                // زيادة الكمية إذا كان المنتج موجوداً
                $cartItem->increment('quantity');
            } else {
                // إضافة منتج جديد إلى السلة
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'تمت إضافة المنتج إلى السلة بنجاح',
                'cart_count' => $cart->items()->count()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة المنتج إلى السلة',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);
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
