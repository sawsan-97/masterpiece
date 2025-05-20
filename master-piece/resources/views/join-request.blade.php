@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-3">طلب الانضمام</h2>
    <form method="POST" action="{{ route('join.request.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">الاسم الكامل</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="address">العنوان</label>
            <input type="text" name="address" id="address" required class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="tel" name="phone" id="phone" required class="form-control">
        </div>

        <div class="form-group">
            <label for="product_image">صورة المنتج</label>
            <input type="file" name="product_image" id="product_image" required class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3 mb-5 ">إرسال الطلب</button>
    </form>
</div>
@endsection