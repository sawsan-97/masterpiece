@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">نتائج البحث</h1>
        <p class="text-gray-600">نتائج البحث عن: "{{ $searchQuery }}"</p>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-8">
            <div class="text-gray-500 mb-4">
                <i class="fas fa-search fa-3x"></i>
            </div>
            <h2 class="text-2xl font-semibold mb-2">لم يتم العثور على نتائج</h2>
            <p class="text-gray-600">جرب البحث باستخدام كلمات مختلفة أو تصفح جميع المنتجات</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-red-800 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                تصفح جميع المنتجات
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-red-800">{{ number_format($product->price, 2) }} د.أ</span>
                            <a href="{{ route('products.show', $product) }}" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
