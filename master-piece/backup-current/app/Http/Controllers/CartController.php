<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItems = $cart->items()->with('product')->get();

        // حساب المجموع الكلي
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Product $product)
    {
        try {
            // الحصول على سلة المستخدم الحالي أو إنشاء سلة جديدة
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);

            // التحقق من وجود المنتج في السلة
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // زيادة الكمية إذا كان المنتج موجوداً
                $cartItem->increment('quantity');
            } else {
                // إضافة المنتج كعنصر جديد في السلة
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);
            }

            return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المنتج إلى السلة');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $cart = Cart::findOrFail($id);
            $request->validate([
                'quantity' => 'max:' . $cart->product->stock
            ]);

            $cart->update([
                'quantity' => $request->quantity
            ]);
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                $product = Product::find($id);
                $request->validate([
                    'quantity' => 'max:' . $product->stock
                ]);

                $cart[$id]['quantity'] = $request->quantity;
                $cart[$id]['price'] = $product->price;
                session(['cart' => $cart]);
            }
        }

        // إضافة هذا الشرط للتعامل مع طلبات AJAX
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
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('id', $id)
                ->delete();
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session(['cart' => $cart]);
            }
        }

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة بنجاح');
    }

    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'تم تفريغ السلة بنجاح');
    }
}
