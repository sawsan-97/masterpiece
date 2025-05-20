@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">سلة التسوق</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($cartItems->count() > 0)
    <div class="cart-container">
        <div class="cart-items">
            @foreach($cartItems as $item)
            <div class="cart-item" data-id="{{ $item->id ?? $item->product->id }}">
                <div class="item-image">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                            <i class="fas fa-image fa-2x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="item-details">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-description">{{ Str::limit($item->product->description, 100) }}</div>
                    <div class="item-single-price" style="color: #777; font-size: 0.9rem;">سعر الوحدة: {{ number_format($item->product->price, 2) }} د.أ</div>
                    <div class="item-price">{{ number_format($item->product->price * $item->quantity, 2) }} د.أ</div>
                </div>
                <div class="item-quantity">
                    <form action="{{ route('cart.update', ['id' => $item->id ?? $item->product->id]) }}"
                          method="POST"
                          class="quantity-form">
                        @csrf
                        @method('PUT')
                        <button type="button" class="quantity-btn decrease">-</button>
                        <input type="number"
                               name="quantity"
                               value="{{ $item->quantity }}"
                               min="1"
                               max="{{ $item->product->stock }}"
                               class="quantity-input"
                               data-price="{{ $item->product->price }}"
                               data-max="{{ $item->product->stock }}"
                               readonly>
                        <button type="button" class="quantity-btn increase">+</button>
                    </form>
                </div>
                <form action="{{ route('cart.remove', ['id' => $item->id ?? $item->product->id]) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="remove-item">×</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="summary-title">ملخص الطلب</div>
            <div class="summary-row">
                <span>السعر الإجمالي</span>
                <span class="cart-subtotal">{{ number_format($total, 2) }} د.أ</span>
            </div>
            <div class="summary-row">
                <span>الشحن</span>
                <span>مجاناً</span>
            </div>
            <div class="summary-row summary-total">
                <span>المجموع</span>
                <span class="total">{{ number_format($total, 2) }} د.أ</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="checkout-btn">تأكيد الشراء</a>

            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="clear-cart-btn">تفريغ السلة</button>
            </form>
        </div>
    </div>
    @else
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>سلة المشتريات فارغة</h3>
            <p>لم تقم بإضافة أي منتجات إلى سلة المشتريات بعد</p>
            <a href="{{ route('products.index') }}" class="browse-products-btn">تصفح المنتجات</a>
        </div>
    @endif
</div>

<style>
:root {
    --primary-color: #0f8a42;
    --secondary-color: #f0f0f0;
    --text-color: #333;
    --border-color: #ddd;
}

body {
    background-color: #f9f9f9;
    color: var(--text-color);
    direction: rtl;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-title {
    text-align: right;
    margin-bottom: 20px;
    color: var(--primary-color);
    font-size: 1.8rem;
    font-weight: bold;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
}

.cart-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
}

.cart-items {
    flex: 2;
}

.cart-summary {
    flex: 1;
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.cart-item {
    display: flex;
    flex-direction: row;
    align-items: center;
    background-color: white;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: relative;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 4px;
    overflow: hidden;
    margin-left: 15px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-name {
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.item-description {
    color: #777;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.item-price {
    font-weight: bold;
    color: var(--primary-color);
    margin-top: 5px;
}

.quantity-form {
    display: flex;
    align-items: center;
    gap: 5px;
}

.quantity-btn {
    width: 28px;
    height: 28px;
    background-color: var(--secondary-color);
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn:hover {
    background-color: #e0e0e0;
}

.quantity-input {
    width: 40px;
    height: 28px;
    text-align: center;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    margin: 0 5px;
}

.summary-title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 15px;
    text-align: right;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.summary-total {
    font-weight: bold;
    border-top: 1px solid var(--border-color);
    padding-top: 10px;
    margin-top: 10px;
}

.checkout-btn {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 15px;
    text-align: center;
    text-decoration: none;
}

.checkout-btn:hover {
    background-color: #0a7535;
}

.clear-cart-btn {
    display: block;
    width: 100%;
    padding: 8px;
    background-color: #f8f9fa;
    color: #333;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    font-size: 0.9rem;
    cursor: pointer;
    text-align: center;
}

.clear-cart-btn:hover {
    background-color: #e2e6ea;
}

.remove-item {
    position: absolute;
    top: 10px;
    left: 10px;
    color: #d9534f;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert {
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    text-align: right;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.empty-cart {
    text-align: center;
    padding: 40px 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.empty-cart i {
    font-size: 3rem;
    color: #ccc;
    margin-bottom: 20px;
}

.empty-cart h3 {
    margin-bottom: 10px;
}

.empty-cart p {
    color: #777;
    margin-bottom: 20px;
}

.browse-products-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

.mt-3 {
    margin-top: 15px;
}

@media (max-width: 768px) {
    .cart-container {
        flex-direction: column;
    }

    .cart-item {
        flex-direction: column;
        text-align: center;
        padding-bottom: 20px;
    }

    .item-image {
        margin: 0 0 15px 0;
        width: 120px;
        height: 120px;
    }

    .quantity-form {
        margin-top: 15px;
        justify-content: center;
    }

    .remove-item {
        top: 10px;
        left: 10px;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // دالة للتحديث التلقائي للمجموع
    function updateCartTotals() {
        let subtotal = 0;

        // جمع أسعار كل المنتجات
        document.querySelectorAll('.cart-item').forEach(item => {
            const priceElement = item.querySelector('.item-price');
            if (priceElement) {
                const priceText = priceElement.textContent.replace(' د.أ', '').replace(',', '');
                const itemPrice = parseFloat(priceText);
                if (!isNaN(itemPrice)) {
                    subtotal += itemPrice;
                }
            }
        });

        // تحديث المجاميع
        const subtotalElements = document.querySelectorAll('.cart-subtotal');
        const totalElements = document.querySelectorAll('.total');

        const formattedSubtotal = subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        subtotalElements.forEach(el => {
            el.textContent = formattedSubtotal + ' د.أ';
        });

        totalElements.forEach(el => {
            el.textContent = formattedSubtotal + ' د.أ';
        });

        return subtotal;
    }

    // دالة لتحديث سعر المنتج بناءً على الكمية
    function updateItemPrice(item, quantity) {
        const input = item.querySelector('.quantity-input');
        const pricePerUnit = parseFloat(input.dataset.price);
        const priceElement = item.querySelector('.item-price');

        const totalPrice = pricePerUnit * quantity;
        const formattedPrice = totalPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        priceElement.textContent = formattedPrice + ' د.أ';
    }

    // دالة لإرسال تحديث الكمية عبر AJAX
    function updateQuantityViaAjax(itemId, quantity, form) {
        const url = form.action;
        const token = form.querySelector('input[name="_token"]').value;
        const method = form.querySelector('input[name="_method"]').value;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: new URLSearchParams({
                '_token': token,
                '_method': method,
                'quantity': quantity
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('حدث خطأ في تحديث السلة');
            }
            return response.json();
        })
        .then(data => {
            // يمكن إضافة إشعار نجاح أو رسالة هنا إذا أردت
            console.log('تم تحديث السلة بنجاح', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // إضافة مستمعي الأحداث لأزرار زيادة/إنقاص الكمية
    document.querySelectorAll('.cart-item').forEach(item => {
        const decreaseBtn = item.querySelector('.decrease');
        const increaseBtn = item.querySelector('.increase');
        const quantityInput = item.querySelector('.quantity-input');
        const itemId = item.dataset.id;
        const form = item.querySelector('.quantity-form');

        // زر النقصان
        decreaseBtn.addEventListener('click', function(e) {
            e.preventDefault();

            let currentQty = parseInt(quantityInput.value);
            if (currentQty > 1) {
                currentQty--;
                quantityInput.value = currentQty;

                // تحديث سعر المنتج
                updateItemPrice(item, currentQty);

                // تحديث المجموع الكلي
                updateCartTotals();

                // إرسال التحديث للخادم
                updateQuantityViaAjax(itemId, currentQty, form);
            }
        });

        // زر الزيادة
        increaseBtn.addEventListener('click', function(e) {
            e.preventDefault();

            let currentQty = parseInt(quantityInput.value);
            let maxQty = parseInt(quantityInput.dataset.max);

            if (currentQty < maxQty) {
                currentQty++;
                quantityInput.value = currentQty;

                // تحديث سعر المنتج
                updateItemPrice(item, currentQty);

                // تحديث المجموع الكلي
                updateCartTotals();

                // إرسال التحديث للخادم
                updateQuantityViaAjax(itemId, currentQty, form);
            }
        });
    });

    // تحديث أولي للمجاميع
    updateCartTotals();
});
</script>
@endpush
@endsection