@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>طلبات الانضمام</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>العنوان</th>
                            <th>صورة المنتج</th>
                            <th>الحالة</th>
                            <th>تاريخ الطلب</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->address }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $request->product_image) }}"
                                         alt="صورة المنتج"
                                         style="max-width: 100px;">
                                </td>
                                <td>
                                    @if($request->status == 'pending')
                                        <span class="badge badge-warning">قيد الانتظار</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge badge-success">تم القبول</span>
                                    @else
                                        <span class="badge badge-danger">مرفوض</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($request->status == 'pending')
                                        <form action="{{ route('admin.join-requests.update-status', $request) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> قبول
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.join-requests.update-status', $request) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> رفض
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">لا توجد طلبات انضمام</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection
