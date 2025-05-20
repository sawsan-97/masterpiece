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
        // التحقق من السلة في قاعدة البيانات أولاً
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                // تحميل عناصر السلة مع علاقة المنتج
                $cartItems = $cart->items()->with('product')->get();

                if ($cartItems->isEmpty()) {
                    return redirect()->route('cart.index')->with('error', 'السلة فارغة');
                }

                // حساب المجموع الكلي
                $total = $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });

                return view('checkout.index', compact('cartItems', 'total'));
            }
        }

        // التحقق من السلة في الجلسة
        $sessionCart = session()->get('cart', []);

        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // تحويل بيانات الجلسة إلى تنسيق مناسب للعرض
        $cartItems = collect();
        $total = 0;

        foreach ($sessionCart as $id => $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $cartItem = (object) [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
                $cartItems->push($cartItem);
                $total += $product->price * $item['quantity'];
            }
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'shipping_address' => 'required|string',
            'notes' => 'nullable|string',
            'coupon_code' => 'nullable|string|exists:coupons,code',
        ]);

        // التحقق من السلة والحصول على العناصر
        $cartItems = [];
        $subtotal = 0;

        // إذا كان المستخدم مسجل دخول، تحقق من قاعدة البيانات
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $dbCartItems = $cart->items()->with('product')->get();

                foreach ($dbCartItems as $item) {
                    $cartItems[] = [
                        'product_id' => $item->product->id,
                        'product' => $item->product,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price
                    ];
                    $subtotal += $item->product->price * $item->quantity;
                }
            }
        }

        // إذا لم توجد عناصر في قاعدة البيانات، تحقق من الجلسة
        if (empty($cartItems)) {
            $sessionCart = session()->get('cart', []);

            foreach ($sessionCart as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $cartItems[] = [
                        'product_id' => $product->id,
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'price' => $product->price
                    ];
                    $subtotal += $product->price * $item['quantity'];
                }
            }
        }

        // التحقق من وجود عناصر في السلة
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'السلة فارغة');
        }

        // التحقق من الكوبون
        $discount = 0;
        $coupon = null;
        if ($request->filled('coupon_code')) {
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
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product']->name,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);

            // تحديث المخزون
            $item['product']->decrement('stock', $item['quantity']);
        }

        // تحديث عدد مرات استخدام الكوبون
        if ($coupon) {
            $coupon->increment('used_count');
        }

        // تفريغ السلة
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->items()->delete();
                $cart->delete();
            }
        }

        // تفريغ سلة الجلسة أيضاً
        session()->forget('cart');

        // إعادة التوجيه لصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('home')->with('success', 'تم تأكيد الطلب بنجاح! سيتم التواصل معك قريباً والدفع عند الاستلام.');
    }

    public function success(Order $order)
    {
        // لم نعد بحاجة لهذه الصفحة
        return redirect()->route('home');
    }
}