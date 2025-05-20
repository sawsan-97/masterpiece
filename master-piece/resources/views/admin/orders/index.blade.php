@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">الطلبات</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>المستخدم</th>
                            <th>المبلغ الإجمالي</th>
                            <th>الحالة</th>
                            <th>تاريخ الطلب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user ? $order->user->name : 'مستخدم محذوف' }}</td>
                            <td>{{ number_format($order->total, 2) }} د.أ</td>
                            <td>
                                <span class="badge-custom badge-{{ $order->status }}">
                                    @if($order->status === 'pending')
                                        قيد الانتظار
                                    @elseif($order->status === 'processing')
                                        قيد المعالجة
                                    @elseif($order->status === 'completed')
                                        مقبول
                                    @else
                                        مرفوض
                                    @endif
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">لا توجد طلبات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .badge-custom {
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
        display: inline-block;
        min-width: 80px;
        text-align: center;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-processing {
        background-color: #17a2b8;
        color: white;
    }

    .badge-completed {
        background-color: #28a745;
        color: white;
    }

    .badge-cancelled {
        background-color: #dc3545;
        color: white;
    }
</style>
@endsection
