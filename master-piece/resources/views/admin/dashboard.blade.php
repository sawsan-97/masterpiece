@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalOrders }}</h3>
                    <p>الطلبات</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer"style="color: #000000 !important; font-weight: bold; padding: 10px 10px 20px 10px;">عرض التفاصيل <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>
                    <p>المستخدمين</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer" style="color: #000000 !important; font-weight: bold; padding: 10px 10px 20px 10px;">عرض التفاصيل <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>
                    <p>المنتجات</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer"style="color: #000000 !important; font-weight: bold; padding: 10px 10px 20px 10px;">عرض التفاصيل <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalNews }}</h3>
                    <p>الأخبار</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.news.index') }}" class="small-box-footer"style="color: #000000 !important; font-weight: bold; padding: 10px 10px 20px 10px;">عرض التفاصيل <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">آخر الطلبات</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المستخدم</th>
                                    <th>المبلغ</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge badge-warning">قيد الانتظار</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge badge-info">قيد المعالجة</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge badge-success">مكتمل</span>
                                        @else
                                            <span class="badge badge-danger">ملغي</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الإحصائيات</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-money-bill"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">إجمالي المبيعات</span>
                                    <span class="info-box-number">{{ $totalRevenue }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-user-plus"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">طلبات الانضمام</span>
                                    <span class="info-box-number">{{ $pendingJoinRequests }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-envelope"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">الرسائل الجديدة</span>
                                    <span class="info-box-number">{{ $pendingMessages }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
