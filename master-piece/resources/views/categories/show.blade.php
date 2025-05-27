@extends('layouts.app')

@section('styles')
<style>
    .section-title {
        position: relative;
        padding-right: 15px;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .section-title::before {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 24px;
        background-color: var(--primary);
    }

    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .card-text {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .product-image {
        position: relative;
        overflow: hidden;
    }

    .product-actions {
        position: absolute;
        top: 10px;
        left: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .product-actions {
        opacity: 1;
    }

    .product-actions .btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .product-actions .btn:hover {
        background-color: var(--gold-color, rgba(255, 191, 0, 1));
        color: white;
    }

    .btn-gold {
        background-color: rgba(255, 191, 0, 1);
        color: white;
        border-color: rgba(255, 191, 0, 1);
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: #e6ac00;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="section-title mb-4">{{ $category->name }}</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="product-image position-relative">
                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        <p class="card-text font-weight-bold">{{ number_format($product->price, 2) }} د.أ</p>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn" style="background-color: #28a745; color: white; padding: 8px 25px; border-radius: 10px; transition: all 0.3s;">أضف للسلة</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    لا توجد منتجات في هذا التصنيف حالياً
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection
