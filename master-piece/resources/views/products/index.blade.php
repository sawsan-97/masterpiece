@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- عنوان الصفحة -->
                <div class="flex justify-center items-center mb-6">

                        <h2 class="text-2xl font-bold custom-title">منتجات بيت النشميات</h2>
                    </div>
                    <p class="text-center">استكشفوا أشهى المنتجات الغذائية وأجمل الحرف اليدوية، بإتقان وأصالة أردنية</p>


                    <!-- تصفية حسب الفئة -->
                    <div class="flex justify-center items-center mb-6">
                        <label for="category" class="text-sm font-medium text-gray-700 px-2">الفئة:</label>
                        <select id="category" name="category" onchange="window.location.href=this.value" class="rounded-md border-red-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="{{ route('products.index') }}" {{ !request('category') ? 'selected' : '' }}>جميع الفئات</option>
                            @foreach($categories as $category)
                                <option value="{{ route('products.index', ['category' => $category->id]) }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                <!-- عرض المنتجات -->
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                <div class="product-image position-relative">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                                    @endif
                                    <div class="product-actions">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-light btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">{{ $product->name }}</h5>
                                    <p class="card-text" style="color: #555; margin-bottom: 1rem;">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text font-weight-bold" style="color: #007A3D; font-size: 1.2rem; margin-bottom: 1rem;">{{ number_format($product->price, 2) }} د.ك</p>
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div class="quantity-input">
                                                        
                                                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-gold px-5 mt-3 mt-md-0">أضف للسلة</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <span class="badge bg-danger">غير متوفر حالياً</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">لا توجد منتجات</h3>
                            <p class="text-gray-500">لم يتم العثور على أي منتجات في هذه الفئة.</p>
                        </div>
                    @endforelse
                </div>

                <!-- الترقيم -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))

@endif

<style>
     .custom-title {
        color: #a83232; /* اللون الأحمر */
        text-align: center; /* توسيط النص */
       font-weight: bold;
    }
.toast-message {
    position: fixed;
    top: 30px;
    right: 30px;
    z-index: 9999;
    background: #28a745;
    color: #fff;
    padding: 16px 32px;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    font-size: 1.1em;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s;
}
.toast-message.show {
    opacity: 1;
    pointer-events: auto;
}
</style>
@section('scripts')
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

                // أطلق حدث لتحديث عداد السلة في كل الصفحات
                document.dispatchEvent(new Event('cartUpdated'));
            })
            .catch(error => {
                console.error(error);
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
@endsection
