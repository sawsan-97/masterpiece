@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="section-title">آراء عملائنا</h1>
                <a href="{{ route('testimonials.create') }}" class="btn btn-gold">أضف رأيك</a>
            </div>
            <p class="text-muted">نفخر بآراء عملائنا ونشكرهم على ثقتهم بنا ومنتجاتنا</p>
        </div>
    </div>

    <div class="row">
        @forelse($testimonials as $testimonial)
            <div class="col-lg-6 mb-4">
                <div class="testimonial-card h-100">
                    <div class="testimonial-content">
                        <div class="testimonial-rating mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                @else
                                    <i class="far fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                @endif
                            @endfor
                        </div>

                        <p class="testimonial-text">
                            {{ $testimonial->content }}
                        </p>

                        <div class="testimonial-author">
                            <div class="author-avatar">
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="صورة {{ $testimonial->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="صورة {{ $testimonial->name }}">
                                @endif
                            </div>
                            <div class="author-info">
                                <h5 class="author-name">{{ $testimonial->name }}</h5>
                                @if($testimonial->city)
                                    <p class="author-title">{{ $testimonial->city }}</p>
                                @endif
                                <p class="author-date">{{ $testimonial->created_at->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    <h4 class="mb-3">لا توجد آراء بعد</h4>
                    <p>كن أول من يشارك رأيه حول تجربته مع نشمية</p>
                    <a href="{{ route('testimonials.create') }}" class="btn btn-gold mt-2">أضف رأيك الآن</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- ترقيم الصفحات -->
    <div class="d-flex justify-content-center mt-4">
        {{ $testimonials->links() }}
    </div>

    <!-- دعوة للمشاركة -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="cta-box text-center p-5">
                <h2 class="mb-3">رأيك يهمنا</h2>
                <p class="lead mb-4">شاركنا تجربتك مع منتجاتنا وساعدنا على تحسين خدماتنا</p>
                <a href="{{ route('testimonials.create') }}" class="btn btn-gold px-5 py-2">أضف رأيك الآن</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .section-title {
        position: relative;
        padding-right: 15px;
        margin-bottom: 10px;
        color: #333;
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
        background-color: rgba(255, 191, 0, 1);
    }

    .testimonial-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .testimonial-content {
        padding: 25px;
    }

    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 20px;
        min-height: 80px;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-left: 15px;
        border: 3px solid rgba(255, 191, 0, 0.2);
    }

    .author-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 3px;
        color: #333;
    }

    .author-title {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 3px;
    }

    .author-date {
        font-size: 0.8rem;
        color: #aaa;
        margin: 0;
    }

    .cta-box {
        background-color: #fff9e6;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .btn-gold {
        background-color: rgba(255, 191, 0, 1);
        color: white;
        border-color: rgba(255, 191, 0, 1);
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: #e6ac00;
        border-color: #e6ac00;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection
