@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">نتائج البحث عن: "{{ $query }}"</h2>

            @if($products->count() == 0)
                <div class="alert alert-info">
                    لم يتم العثور على نتائج للبحث عن "{{ $query }}"
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        تصفح جميع المنتجات
                    </a>
                </div>
            @else
                <div class="alert alert-success">
                    تم العثور على {{ $products->total() }} نتيجة
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                                    @if($product->category)
                                        <p class="text-muted small">التصنيف: {{ $product->category->name }}</p>
                                    @endif
                                    <div class="mt-auto">
                                        <p class="card-text mb-2">
                                            <strong class="text-primary">السعر: {{ number_format($product->price, 2) }} د.أ</strong>
                                        </p>
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <div class="quantity-input">
                                                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn" style="background-color: #007A3D; color: white; padding: 8px 25px; border-radius: 10px; transition: all 0.3s;" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                                        أضف للسلة
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        @if($product->stock == 0)
                                            <span class="badge bg-danger mt-2">غير متوفر حالياً</span>
                                        @endif
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary w-100 mt-2">عرض التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- إصلاح pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(['query' => $query])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection