@extends('layouts.app')

@section('news-section')
<div class="container-fluid py-5">
    <h1 class="text-center mb-5">آخر الأخبار</h1>

    <div class="row">
        @forelse($news as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title fs-5">{{ $item->title }}</h3>
                        <p class="card-text text-muted">{{ $item->getExcerpt(100) }}</p>
                        <div class="mt-auto text-center">
                            <a href="{{ route('news.show', $item) }}" class="btn btn-success px-4 rounded-pill">اقرأ المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    لا توجد أخبار متاحة حالياً
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection