@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-gold text-white">
                    <h4 class="mb-0 py-2" style="color: black">شاركنا رأيك وتجربتك</h4>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user() ? auth()->user()->name : '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label fw-bold">المدينة</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                            <div class="form-text">مثال: عمان، إربد، الزرقاء</div>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">تعليقك <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                            <div class="form-text">شاركنا تجربتك مع منتجاتنا أو خدماتنا (10 أحرف على الأقل)</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">تقييمك <span class="text-danger">*</span></label>
                            <div class="rating-stars mb-2">
                                <div class="rating d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" id="rating1" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rating1">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" id="rating2" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rating2">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" id="rating3" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rating3">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" id="rating4" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rating4">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" id="rating5" value="5" {{ old('rating', 5) == 5 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rating5">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-text mb-4">
                            <p class="mb-2"><strong>ملاحظة:</strong> سيتم مراجعة تعليقك قبل نشره على الموقع. نحن نحتفظ بالحق في تعديل أو عدم نشر التعليقات غير المناسبة.</p>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gold px-5 py-2">إرسال التعليق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-gold {
        background-color: rgba(255, 191, 0, 1);
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

    .rating-stars i {
        color: rgba(255, 191, 0, 1);
    }

    .form-check-input:checked ~ .form-check-label i {
        color: rgba(255, 191, 0, 1);
    }

    .form-check-input {
        margin-top: 0.3rem;
    }

    .form-text {
        color: #6c757d;
    }
</style>
@endsection
