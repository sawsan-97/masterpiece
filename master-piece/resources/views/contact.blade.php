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
<div class="container">
    <h2 class="text-center mt-3">اتصل بنا</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="name">الاسم الكامل</label>
            <input type="text" name="name" id="name" required class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" required class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone">رقم الهاتف</label>
            <input type="tel" name="phone" id="phone" required class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="message">الرسالة</label>
            <textarea name="message" id="message" rows="5" required class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">إرسال الرسالة</button>
    </form>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection
