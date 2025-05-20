@extends('layouts.app')

@push('styles')
<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, div {
        font-family: 'Times New Roman', Times, serif !important;
    }

    .contact-section {
        padding: 60px 0;
        background-color: #f9f9f9;
    }

    .contact-heading {
        color: #007A3D;
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .contact-subtext {
        text-align: center;
        margin-bottom: 30px;
        color: #555;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        direction: rtl;
    }

    .contact-container {
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        padding: 20px;
        height: 100%;
    }

    .contact-info-title {
        color: #333;
        margin-bottom: 20px;
        text-align: right;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        justify-content: space-between;
        direction: rtl;
    }

    .contact-info-label {
        color: #666;
        text-align: right;
    }

    .contact-info-value {
        text-align: left;
        color: #333;
    }

    .contact-icon {
        color: #007A3D;
        margin-left: 10px;
        font-size: 18px;
        width: 24px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        width: 100%;
        direction: rtl;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #007A3D;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        text-align: right;
    }

    .btn-submit {
        background-color: #007A3D !important;
        color: white !important;
        border: none !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        width: 100% !important;
    }

    .btn-submit:hover {
        background-color: #005c2e !important;
    }

    .row.no-gutters {
        margin-right: 0;
        margin-left: 0;
    }

    .row.no-gutters > [class^="col-"],
    .row.no-gutters > [class*=" col-"] {
        padding-right: 0;
        padding-left: 0;
    }

    .contact-image {
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    .contact-wrapper {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
    }
</style>
@endpush

@section('content')
<section class="contact-section">
    <div class="container">
        <h2 class="contact-heading">تواصل معنا</h2>
        <p class="contact-subtext">نسعى للرد على جميع استفساراتكم في أسرع وقت ممكن، يرجى تعبئة النموذج أدناه أو التواصل معنا مباشرة عبر التفاصيل التالية</p>

        <div class="contact-wrapper">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="contact-container">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" name="fullname" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" placeholder="example@email.com" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="tel" class="form-control" name="phone" placeholder="+962xxxxxxxx">
                            </div>

                            <div class="form-group">
                                <label class="form-label">رسالتك</label>
                                <textarea class="form-control" name="message" rows="5" placeholder="اكتب رسالتك هنا..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit">إرسال</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 p-0">
                    <img src="{{ asset('images/login.jpg') }}" alt="" class="contact-image">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection