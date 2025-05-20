@extends('layouts.app')

@section('styles')
<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, div {
        font-family: 'Times New Roman', Times, serif !important;
    }

    :root {
        --jordan-red: rgba(183, 28, 28, 1);
        --jordan-green: #007A3D;
        --jordan-black: #000000;
        --jordan-white: #FFFFFF;
        --primary: #a83232;
        --primary-dark: #8a2828;
    }

    .cta-buttons {
        text-align: center;
        padding: 30px 0;
        background-color: #f8f9fa;
    }

    .btn {
        display: inline-block;
        padding: 12px 30px;
        margin: 0 10px;
        border-radius: 30px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: var(--jordan-green);
        color: white;
    }

    .btn-secondary {
        background-color: var(--jordan-red);
        color: white;
    }

    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #25D366;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        text-align: center;
        font-size: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        color: white;
    }

    /* نمط تسجيل الدخول المنسدل */
    .auth-menu {
        position: relative;
        display: flex;
        align-items: center;
    }

    .login-button {
        padding: 8px 15px;
        text-decoration: none;
        color: #333;
        font-weight: 500;
        cursor: pointer;
        transition: color 0.3s;
        background: none;
        border: none;
        font-size: 16px;
    }

    .login-button:hover {
        color: var(--jordan-red);
    }

    .dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 5px;
        width: 300px;
        padding: 20px;
        z-index: 9999;
        margin-top: 10px;
        display: none;
    }

    .dropdown.show {
        display: block;
    }

    .dropdown-title {
        text-align: center;
        margin-bottom: 20px;
        color: #222;
        font-size: 20px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--jordan-red);
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background-color: var(--jordan-red);
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-login:hover {
        background-color: #940000;
    }

    .dropdown-footer {
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
        color: #666;
    }

    .dropdown-footer a {
        color: var(--jordan-red);
        text-decoration: none;
    }

    .dropdown-footer a:hover {
        text-decoration: underline;
    }

    .search-form {
        position: relative;
    }

    .search-form .form-control {
        border-radius: 30px 0 0 30px;
        border: 2px solid #ddd;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .search-form .form-control:focus {
        border-color: var(--jordan-green);
        box-shadow: 0 0 0 0.2rem rgba(0, 122, 61, 0.25);
    }

    .search-form .btn {
        border-radius: 0 30px 30px 0;
        padding: 15px 30px;
        font-size: 16px;
    }

    .search-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
    }

    .search-suggestions .suggestion-item {
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-suggestions .suggestion-item:hover {
        background-color: #f8f9fa;
    }

    .about-main-section {
        background-color: #fff9e6;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .about-text h2 {
        position: relative;
        padding-right: 15px;
        color: #333;
        font-weight: 700;
    }

    .about-text h2:before {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 24px;
        background-color: rgba(183, 28, 28, 1);
    }

    .about-image-container {
        position: relative;
    }

    .about-image-container img {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 768px) {
        .about-main-section {
            padding: 20px;
        }

        .about-image-container {
            margin-top: 30px;
            order: 2;
        }

        .about-text-container {
            order: 1;
        }
    }

    /* أنماط أيقونة العين للمنتجات */
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

    /* أنماط قسم آراء العملاء */
    .testimonials-section {
        background-color: #fff9e6;
        padding: 60px 0;
    }

    .testimonial-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.3s ease;
        margin: 10px;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .testimonial-content {
        padding: 25px;
    }

    .testimonial-rating {
        margin-bottom: 15px;
        color: rgba(255, 191, 0, 1);
        font-size: 1.2rem;
    }

    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 20px;
        min-height: 120px;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .author-info {
        text-align: right;
    }

    .author-name {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 3px;
        color: #333;
    }

    .author-title {
        font-size: 0.875rem;
        color: #777;
        margin: 0;
    }

    .testimonials-section .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 40px;
        color: #333;
        font-weight: 700;
    }

    .testimonials-section .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: 50%;
        transform: translateX(50%);
        width: 80px;
        height: 3px;
        background-color: rgba(255, 191, 0, 1);
    }

    /* أنماط سلايدر Swiper */
    .testimonials-swiper-container {
        padding-bottom: 30px;
        margin: 0 40px;
    }

    /* إخفاء أزرار التنقل */
    .swiper-button-next,
    .swiper-button-prev {
        display: none !important;
    }

    /* إخفاء نقاط التنقل */
    .swiper-pagination,
    .swiper-pagination-bullet {
        display: none !important;
    }

    /* تحسين مظهر النجوم */
    .fas.fa-star, .far.fa-star, .fas.fa-star-half-alt {
        color: rgba(255, 191, 0, 1) !important;
        padding: 0 2px;
    }

    .testimonial-rating i {
        color: rgba(255, 191, 0, 1) !important;
    }

    /* تأكيد خاص للسلايدر */
    .testimonials-swiper-container .testimonial-rating i {
        color: rgba(255, 191, 0, 1) !important;
    }

    .testimonial-slider .slick-slide {
        padding: 15px;
    }

    .btn-circle-gold {
        background-color: rgba(255, 191, 0, 1);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .btn-circle-gold:hover {
        background-color: #e6ac00;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* أنماط قسم انضمي إلينا */
    .join-us-section {
        padding: 80px 0;
        background-color: #007A3D;
    }

    .join-us-section h2 {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .join-us-section p {
        color: white;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .join-us-section .btn {
        background-color: white;
        color: #007A3D;
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .join-us-section .btn:hover {
        background-color: #f5f5f5;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
@include('layouts.slider')

<!-- قسم المقدمة -->
<section style="background-color: #faf6f3; padding: 60px 0; font-family: 'Times New Roman', Times, serif;">
    <div class="container text-center">
        <h2 style="color: #8B0000; font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; font-family: 'Times New Roman', Times, serif;">بيت النشميات</h2>
        <p style="color: #333; line-height: 1.8; font-size: 1.1rem; max-width: 900px; margin: 0 auto; font-family: 'Times New Roman', Times, serif;">
            مبادرة مجتمعية تهدف إلى تمكين المرأة الأردنية من خلال توفير منصة لعرض وبيع منتجاتها اليدوية والمأكولات التقليدية. نحن نؤمن بقدرة المرأة على الإبداع والإنتاج وتحقيق الاستقلال المادي.
        </p>
    </div>
</section>

<!-- قسم المنتجات المميزة -->
<section class="featured-products py-5">
    <div class="container">
        <h2 class="section-title mb-4">منتجات مميزة</h2>
        <div class="row">
            @forelse($featuredProducts as $product)
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
                                <button type="submit" class="btn btn-gold">أضف للسلة</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        لا توجد منتجات مميزة حالياً
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@if(isset($searchResults) && $query)
    <div class="container py-5">
        @if($searchResults->count())
            @include('sections.products', [
                'title' => 'نتائج البحث عن: "' . $query . '"',
                'products' => $searchResults
            ])
        @else
            <div class="alert alert-info text-center">
                لا توجد نتائج للبحث عن "{{ $query }}"
            </div>
        @endif
    </div>
@else
    <!-- لا يتم عرض أي محتوى في الحالة الافتراضية -->
@endif
<!-- قسم انضمي إلينا -->
<section style="background-color: #007A3D; padding: 80px 0;">
    <div class="container text-center">
        <h2 style="color: white; font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">انضمي إلينا</h2>
        <p style="color: white; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem; max-width: 800px; margin-left: auto; margin-right: auto;">
            هل أنتِ حرفية موهوبة؟ انضمي إلى مجتمعنا وابدئي في عرض منتجاتك
        </p>
        <a href="{{ route('join.request') }}" style="display: inline-block; background-color: white; color: #007A3D; padding: 12px 30px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: all 0.3s;">
            سجلي الآن
        </a>
    </div>
</section>

<!-- قسم لماذا تختارينا -->
<section style="background-color: #f9f9f9; padding: 80px 0;">
    <div class="container text-center">
        <h2 style="color: #8B0000; font-size: 2rem; font-weight: 700; margin-bottom: 3rem;">لماذا تختارينا</h2>

        <div class="row">
            <div class="col-md-3 mb-5">
                <div class="text-center">
                    <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">أصالة</h3>
                    <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">منتجات يدوية أصيلة تعكس تراثنا</p>
                </div>
            </div>

            <div class="col-md-3 mb-5">
                <div class="text-center">
                    <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">استدامة</h3>
                    <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">نهتم بالبيئة ونشجع الإنتاج المستدام</p>
                </div>
            </div>

            <div class="col-md-3 mb-5">
                <div class="text-center">
                    <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">تمكين المرأة</h3>
                    <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">ندعم استقلال المرأة اقتصادياً</p>
                </div>
            </div>

            <div class="col-md-3 mb-5">
                <div class="text-center">
                    <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                        <i class="fas fa-hands-holding-circle"></i>
                    </div>
                    <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">أثر مجتمعي</h3>
                    <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">نساهم في تنمية المجتمع المحلي</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="news-section">
    <h2 class="section-title">آخر الأخبار</h2>

    @forelse($news as $item)
        <div class="news-item">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
            @endif
            <div class="news-content">
                <h3>{{ $item->title }}</h3>
                <p>{{ Str::limit($item->content, 200) }}</p>
                <div class="news-meta">
                    <span class="date">
                        @if($item->published_at)
                            {{ $item->published_at->format('Y-m-d') }}
                        @else
                            {{ $item->created_at->format('Y-m-d') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">لا توجد أخبار حالياً</p>
    @endforelse

    {{ $news->links() }}
</div>

<!-- قسم آراء العملاء -->
<div class="testimonials-section py-5 mt-4">
    <div class="container">
        <div class="testimonials-swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                            </div>
                            <p class="testimonial-text">
                                اشتريت المعمول من عند أم سارة، طعمه رائع وتسليمه كان سريع، شكراً لهذه المنصة اللي سهلت علينا الوصول للمنتجات البيتية الأصلية.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h5 class="author-name">ريم خالد</h5>
                                    <p class="author-title">عمان، الأردن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                            </div>
                            <p class="testimonial-text">
                                المخللات المشكلة كانت ممتازة، طعم بيتي أصيل، والتغليف كان مرتب ومحكم. شكراً نشمية على هذي التجربة الرائعة.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h5 class="author-name">محمد العبادي</h5>
                                    <p class="author-title">إربد، الأردن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star-half-alt" style="color: rgba(255, 191, 0, 1);"></i>
                            </div>
                            <p class="testimonial-text">
                                اشتريت هدية مصنوعة يدوياً لصديقتي، كانت رائعة وفريدة من نوعها. أحب القطع اليدوية لأنها بتحمل قصة وتعب الحرفيين.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h5 class="author-name">سميرة عمر</h5>
                                    <p class="author-title">عجلون، الأردن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                            </div>
                            <p class="testimonial-text">
                                زينة رمضان اللي اشتريتها عبر موقع نشمية كانت رائعة، والتصاميم مميزة وفريدة. البائعة كانت متعاونة وبتستجيب بسرعة للاستفسارات.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h5 class="author-name">هبة الحسن</h5>
                                    <p class="author-title">الزرقاء، الأردن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating">
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="fas fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                                <i class="far fa-star" style="color: rgba(255, 191, 0, 1);"></i>
                            </div>
                            <p class="testimonial-text">
                                الصابون العضوي بريحة اللافندر رائع للبشرة الحساسة. يا ريت لو في تنويع أكثر بالروائح. بالعموم منتج ممتاز وتعبئة جميلة جداً.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h5 class="author-name">لينا محمود</h5>
                                    <p class="author-title">البترا، الأردن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- زر إضافة رأي جديد -->
<div class="container text-center mt-4 mb-5">
    <a href="{{ route('testimonials.create') }}" class="btn btn-circle-gold">
        <i class="fas fa-plus"></i>
    </a>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- إضافة تحميل Font Awesome باستخدام طريقة بديلة -->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>

<script>
    // تنفيذ جافاسكريبت للتأكد من تحميل الأيقونات بشكل صحيح
    document.addEventListener('DOMContentLoaded', function() {
        // تطبيق الألوان مباشرة على النجوم باستخدام JavaScript
        document.querySelectorAll('.testimonial-rating i').forEach(function(star) {
            star.style.color = 'rgba(255, 191, 0, 1)';
        });

        // منطق تسجيل الدخول المنسدل
        const loginButton = document.getElementById('loginButton');
        const loginDropdown = document.getElementById('loginDropdown');

        if (loginButton && loginDropdown) {
            loginButton.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                loginDropdown.style.display = loginDropdown.style.display === 'block' ? 'none' : 'block';
            };

            document.onclick = function(event) {
                if (!loginDropdown.contains(event.target) && !loginButton.contains(event.target)) {
                    loginDropdown.style.display = 'none';
                }
            };

            loginDropdown.onclick = function(event) {
                event.stopPropagation();
            };
        }

        // تهيئة سلايدر آراء العملاء (بدون نقاط تنقل)
        const testimonialsSwiper = new Swiper('.testimonials-swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });
    });
</script>
@endsection
