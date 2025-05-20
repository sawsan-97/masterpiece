@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">آخر الأخبار</h1>

    <div class="row">
        @forelse($latestNews as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->getExcerpt(150) }}</p>
                        <div class="mt-auto text-center">
                            <a href="{{ route('news.show', $item) }}" class="btn btn-success">اقرأ المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>لا توجد أخبار متاحة حالياً</p>
            </div>
        @endforelse
    </div>
</div>
@endsection