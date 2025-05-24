@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-container">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="ابحث عن منتجات..." class="search-input">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-success mt-3 d-block text-center">
                    <i class="fas fa-shopping-basket me-2"></i>
                    تسوق المنتجات
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .search-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        direction: rtl;
    }

    .search-input:focus {
        outline: none;
        border-color: #28a745;
    }

    .search-button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-button:hover {
        background-color: #218838;
    }

    .btn-success {
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-decoration: none;
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: #218838;
        color: white;
    }
</style>
@endpush
