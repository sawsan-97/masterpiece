@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">قائمة المفضلة</h1>

    @if($wishlistItems->count() > 0)
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <div class="product-image">
                            <img src="{{ $item->product->getFirstMediaUrl('products') ?: asset('images/placeholder.jpg') }}"
                                 class="card-img-top"
                                 alt="{{ $item->product->name }}">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="product-title">{{ $item->product->name }}</h5>
                            <p class="product-description">{{ Str::limit($item->product->description, 100) }}</p>
                            @if($item->product->price)
                                <p class="product-price mb-2">{{ number_format($item->product->price, 2) }} د.أ</p>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('cart.add', $item->product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">أضف للسلة</button>
                                </form>
                                <form action="{{ route('wishlist.remove', $item->product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            قائمة المفضلة فارغة. <a href="{{ route('products.index') }}" class="alert-link">تصفح المنتجات</a>
        </div>
    @endif
</div>

<style>
.product-card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    height: 250px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.product-description {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.product-price {
    font-size: 18px;
    font-weight: 600;
    color: var(--primary);
}

.btn-outline-danger {
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
</style>
@endsection
