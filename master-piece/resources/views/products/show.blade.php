@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- صورة المنتج -->
        <div class="col-md-5 mb-4">
            <div class="product-image-container shadow-sm rounded overflow-hidden">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
        </div>

        <!-- تفاصيل المنتج -->
        <div class="col-md-7">
            <div class="product-details">
                <h2 class="mb-3">{{ $product->name }}</h2>

                <div class="product-price mb-4">
                    @if($product->sale_price)
                        <span class="text-decoration-line-through text-muted me-2">{{ number_format($product->price, 2) }} د.ك</span>
                        <span class="fw-bold text-danger fs-4">{{ number_format($product->sale_price, 2) }} د.ك</span>
                    @else
                        <span class="fw-bold fs-4">{{ number_format($product->price, 2) }} د.ك</span>
                    @endif
                </div>

                <div class="product-stock mb-4">
                    @if($product->stock > 0)
                        <span class="badge bg-success">متوفر في المخزون ({{ $product->stock }} {{ $product->unit }})</span>
                    @else
                        <span class="badge bg-danger">غير متوفر حالياً</span>
                    @endif
                </div>

                <div class="product-description mb-4">
                    <h5 class="mb-2">الوصف</h5>
                    <p>{{ $product->description }}</p>
                </div>

                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="quantity-input">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-gold px-5 mt-3 mt-md-0">أضف للسلة</button>
                            </div>
                        </div>
                    </form>
                @endif

                <!-- بائع المنتج -->
                @if($product->seller_name)
                <div class="seller-info mt-4 p-3 bg-light rounded">
                    <h5 class="mb-2">معلومات البائع</h5>
                    <p class="mb-1"><strong>الاسم:</strong> {{ $product->seller_name }}</p>
                    @if($product->seller_phone)
                    <p class="mb-1"><strong>الهاتف:</strong> {{ $product->seller_phone }}</p>
                    @endif
                    @if($product->seller_address)
                    <p class="mb-0"><strong>العنوان:</strong> {{ $product->seller_address }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- منتجات مشابهة -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="related-products mt-5">
        <h3 class="mb-4 section-title position-relative">منتجات مشابهة</h3>
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-md-3 mb-4">
                <div class="card h-100 product-card">
                    <a href="{{ route('products.show', $relatedProduct) }}" class="text-decoration-none">
                        <img src="{{ $relatedProduct->image_url }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title text-dark">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($relatedProduct->description, 60) }}</p>
                            <p class="card-text fw-bold text-primary">{{ number_format($relatedProduct->price, 2) }} د.ك</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form[action*="cart/add"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                // تحديث عداد السلة إذا كان موجود
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement && data.cart_count !== undefined) {
                    cartCountElement.textContent = data.cart_count;
                    cartCountElement.classList.remove('hidden');
                }
                // عرض رسالة نجاح
                const toast = document.createElement('div');
                toast.className = 'toast-message show';
                toast.textContent = data.message;
                document.body.appendChild(toast);
                setTimeout(() => { toast.remove(); }, 3000);
            })
            .catch(error => {
                // عرض رسالة خطأ
                const toast = document.createElement('div');
                toast.className = 'toast-message show error';
                toast.textContent = 'حدث خطأ أثناء إضافة المنتج إلى السلة';
                document.body.appendChild(toast);
                setTimeout(() => { toast.remove(); }, 3000);
            });
        });
    });
});

</script>
@endsection

@section('styles')
<style>
    .product-image-container {
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #fff;
    }

    .product-image-container img {
        width: 100%;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-image-container:hover img {
        transform: scale(1.05);
    }

    .product-details {
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .section-title:after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 24px;
        background-color: rgba(255, 191, 0, 1);
    }

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .btn-gold {
        background-color: rgba(255, 191, 0, 1);
        color: white;
        border-color: rgba(255, 191, 0, 1);
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: #e6ac00;
        border-color: #e6ac00;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection
