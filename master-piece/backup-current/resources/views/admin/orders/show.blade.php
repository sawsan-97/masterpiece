@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">تفاصيل الطلب #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> العودة للقائمة
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- قسم إجراءات الطلب السريعة -->
    <div class="card shadow mb-4">
        <div class="card-header bg-gold text-white py-3">
            <h6 class="m-0 font-weight-bold">إجراءات الطلب</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">حالة الطلب الحالية:</span>
                    <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }} mr-2 p-2">
                        {{ $order->status === 'pending' ? 'قيد الانتظار' :
                           ($order->status === 'processing' ? 'قيد المعالجة' :
                           ($order->status === 'completed' ? 'مقبول' : 'مرفوض')) }}
                    </span>
                </div>
                <div>
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-success ml-2">
                            <i class="fas fa-check ml-1"></i> قبول الطلب
                        </button>
                    </form>

                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رفض هذا الطلب؟')">
                            <i class="fas fa-times ml-1"></i> رفض الطلب
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">معلومات الطلب</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>رقم الطلب:</th>
                            <td>#{{ $order->order_number ?? $order->id }}</td>
                        </tr>
                        <tr>
                            <th>تاريخ الطلب:</th>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>حالة الطلب:</th>
                            <td>
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>قيد المعالجة</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>مقبول</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>مرفوض</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>ملاحظات:</th>
                            <td>{{ $order->notes ?? 'لا توجد ملاحظات' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">معلومات العميل</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>الاسم:</th>
                            <td>{{ $order->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>البريد الإلكتروني:</th>
                            <td>{{ $order->customer_email }}</td>
                        </tr>
                        <tr>
                            <th>رقم الهاتف:</th>
                            <td>{{ $order->customer_phone }}</td>
                        </tr>
                        <tr>
                            <th>العنوان:</th>
                            <td>{{ $order->shipping_address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">المنتجات</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ number_format($item->price, 2) }} د.أ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 2) }} د.أ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-light">
                            <th colspan="3" class="text-left">المجموع الفرعي:</th>
                            <th>{{ number_format($order->subtotal, 2) }} د.أ</th>
                        </tr>
                        @if($order->discount > 0)
                        <tr>
                            <th colspan="3" class="text-left">الخصم:</th>
                            <th class="text-success">- {{ number_format($order->discount, 2) }} د.أ</th>
                        </tr>
                        @endif
                        <tr class="bg-light">
                            <th colspan="3" class="text-left">المجموع النهائي:</th>
                            <th class="font-weight-bold">{{ number_format($order->total, 2) }} د.أ</th>
                        </tr>
                    </tfoot>
                </table>
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

    .card-header {
        font-weight: bold;
    }

    th {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 85%;
    }
</style>
@endsection
