<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // تحميل عناصر السلة مع علاقة المنتج
        $cartItems = $cart->items()->with('product')->get();

        // حساب المجموع الكلي
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $updated = false;
        foreach ($cart as $id => $item) {
            if (!isset($item['price'])) {
                $product = \App\Models\Product::find($item['product_id']);
                $cart[$id]['price'] = $product ? $product->price : 0;
                $updated = true;
            }
        }
        if ($updated) {
            session(['cart' => $cart]);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'shipping_address' => 'required|string',
            'notes' => 'nullable|string',
            'coupon_code' => 'nullable|string|exists:coupons,code',
        ]);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'السلة فارغة');
        }

        // حساب المجموع
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // التحقق من الكوبون
        $discount = 0;
        $coupon = null;
        if ($request->has('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if ($coupon && $coupon->isValid() && $subtotal >= $coupon->min_order_value) {
                if ($coupon->type === 'percentage') {
                    $discount = ($subtotal * $coupon->value) / 100;
                } else {
                    $discount = $coupon->value;
                }
            }
        }

        $total = $subtotal - $discount;

        // إنشاء الطلب
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'shipping_address' => $validated['shipping_address'],
            'notes' => $validated['notes'],
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'coupon_code' => $coupon ? $coupon->code : null,
            'coupon_discount' => $discount,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // إضافة عناصر الطلب
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);

            // تحديث المخزون
            $product->decrement('stock', $item['quantity']);
        }

        // تحديث عدد مرات استخدام الكوبون
        if ($coupon) {
            $coupon->increment('used_count');
        }

        // تفريغ السلة
        session()->forget('cart');

        // إعادة التوجيه لصفحة الدفع مع رسالة نجاح
        return redirect()->route('checkout.index')->with('success', 'تم تأكيد الطلب بنجاح، سيتم التواصل معك والدفع عند الاستلام.');
    }

    public function success(Order $order)
    {
        // لم نعد بحاجة لهذه الصفحة
        return redirect()->route('home');
    }
}
