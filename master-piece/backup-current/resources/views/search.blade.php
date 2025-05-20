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
            @else
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="text-muted">التصنيف: {{ $product->category->name }}</p>
                                    <p class="card-text">
                                        <strong>السعر: </strong>
                                        {{ number_format($product->price, 2) }} ريال
                                    </p>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">عرض التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
