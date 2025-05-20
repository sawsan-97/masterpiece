@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">آخر الأخبار</h1>

    <div class="row">
        @forelse($latestNews as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">لا توجد صورة</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">
                            @if(method_exists($item, 'getExcerpt'))
                                {{ $item->getExcerpt(150) }}
                            @else
                                {{ Str::limit(strip_tags($item->content), 150) }}
                            @endif
                        </p>
                        <div class="mt-auto text-center">
                            <a href="{{ route('news.show', $item) }}" class="btn btn-success">اقرأ المزيد</a>
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

    <!-- Pagination -->
    @if($latestNews->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $latestNews->links() }}
        </div>
    @endif
</div>
@endsection