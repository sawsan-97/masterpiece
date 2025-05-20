@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success text-center my-4" style="font-size:1.2em;">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="page-title mb-4">إتمام الشراء</h1>
    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card p-4 mb-3">
                <h4 class="mb-3">معلومات العميل</h4>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name', Auth::user()->name ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                        <input type="text" name="customer_phone" class="form-control" required value="{{ old('customer_phone', Auth::user()->phone ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني (اختياري)</label>
                        <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', Auth::user()->email ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">عنوان التوصيل <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" class="form-control" required>{{ old('shipping_address', Auth::user()->address ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ملاحظات إضافية</label>
                        <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">تأكيد الطلب</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card p-4">
                <h4 class="mb-3">ملخص السلة</h4>
                <ul class="list-group mb-3">
                    @foreach($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">{{ $item->product->name }}</div>
                                <small class="text-muted">الكمية: {{ $item->quantity }}</small>
                            </div>
                            <span>{{ number_format($item->quantity * $item->product->price, 2) }} د.أ</span>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-between mb-2">
                    <span>المجموع الفرعي:</span>
                    <span>{{ number_format($total, 2) }} د.أ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>الشحن:</span>
                    <span>مجاناً</span>
                </div>
                <div class="d-flex justify-content-between fw-bold border-top pt-2">
                    <span>الإجمالي:</span>
                    <span>{{ number_format($total, 2) }} د.أ</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-title {
    color: #0f8a42;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    text-align: right;
}
.card {
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    background: #fff;
}
.btn-primary {
    background-color: #0f8a42;
    border: none;
}
.btn-primary:hover {
    background-color: #0c6b37;
}
@media (max-width: 768px) {
    .row { flex-direction: column-reverse; }
}
</style>
@endsection
