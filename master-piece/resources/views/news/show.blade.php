@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- News Article Card -->
            <article class="news-article bg-white shadow-sm rounded-lg overflow-hidden">

                <!-- Featured Image -->
                @if($news->image)
                <div class="news-image">
                    <img src="{{ asset('storage/' . $news->image) }}"
                         alt="{{ $news->title }}"
                         class="w-100"
                         style="height: 400px; object-fit: cover;">
                </div>
                @endif

                <!-- Article Content -->
                <div class="news-content p-4 p-md-5">

                    <!-- Article Header -->
                    <header class="news-header mb-4">
                        <h1 class="news-title h2 mb-3 text-dark fw-bold">
                            {{ $news->title }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="news-meta d-flex flex-wrap align-items-center text-muted mb-4">
                            <span class="meta-item me-4">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                {{ $news->created_at->locale('ar')->isoFormat('dddd DD MMMM YYYY') }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                {{ $news->created_at->locale('ar')->isoFormat('h:mm a') }}
                            </span>
                        </div>
                    </header>

                    <!-- Article Body -->
                    <div class="news-body">
                        <div class="content-text">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                    </div>

                    <!-- Article Footer -->
                    <footer class="news-footer mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('news.index') }}"
                               class="btn" style="background-color: #007A3D; color: white; padding: 8px 25px; border-radius: 10px; transition: all 0.3s;">
                                <i class="fas fa-arrow-right me-2"></i>
                                العودة إلى المدونة
                            </a>

                      
                        </div>
                    </footer>
                </div>
            </article>

            <!-- Related News Section (Optional) -->
            @if(isset($relatedNews) && $relatedNews->count() > 0)
            <section class="related-news mt-5">
                <h3 class="h4 mb-4 text-dark">أخبار ذات صلة</h3>
                <div class="row">
                    @foreach($relatedNews as $related)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}"
                                 class="card-img-top"
                                 alt="{{ $related->title }}"
                                 style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('news.show', $related->id) }}"
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($related->title, 50) }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">
                                    {{ $related->created_at->locale('ar')->isoFormat('DD MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
/* General page adjustments */
body {
    padding-top: 0;
}

/* Navbar spacing fix */
.container.mt-4 {
    margin-top: 1rem !important;
}

.news-article {
    border: 1px solid #e9ecef;
}

.news-title {
    line-height: 1.4;
    color: #2c3e50;
}

.news-meta .meta-item {
    font-size: 0.9rem;
}

.content-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #495057;
}

.content-text p {
    margin-bottom: 1.5rem;
}

.social-share .btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.social-share .btn:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}

/* RTL Support */
[dir="rtl"] .news-content {
    text-align: right;
}

[dir="rtl"] .news-meta {
    direction: rtl;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .news-content {
        padding: 1.5rem;
    }

    .news-footer .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

    .social-share {
        text-align: center;
    }
}
</style>
@endsection