@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>رسائل اتصل بنا</h1>
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
                            <th>الرسالة</th>
                            <th>الحالة</th>
                            <th>تاريخ الإرسال</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->phone }}</td>
                                <td>{{ Str::limit($message->message, 50) }}</td>
                                <td>
                                    @if($message->status == 'pending')
                                        <span class="badge badge-warning">قيد الانتظار</span>
                                    @elseif($message->status == 'read')
                                        <span class="badge badge-info">تم القراءة</span>
                                    @else
                                        <span class="badge badge-success">تم الرد</span>
                                    @endif
                                </td>
                                <td>{{ $message->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#messageModal{{ $message->id }}">
                                        <i class="fas fa-eye"></i> عرض
                                    </button>

                                    @if($message->status == 'pending')
                                        <form action="{{ route('admin.contact-messages.update-status', $message) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="read">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check"></i> تم القراءة
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">تفاصيل الرسالة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>الاسم:</strong> {{ $message->name }}</p>
                                            <p><strong>البريد الإلكتروني:</strong> {{ $message->email }}</p>
                                            <p><strong>رقم الهاتف:</strong> {{ $message->phone }}</p>
                                            <p><strong>الرسالة:</strong></p>
                                            <p>{{ $message->message }}</p>
                                            @if($message->admin_notes)
                                                <p><strong>ملاحظات الإدارة:</strong></p>
                                                <p>{{ $message->admin_notes }}</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            @if($message->status != 'replied')
                                                <form action="{{ route('admin.contact-messages.update-status', $message) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="replied">
                                                    <div class="form-group">
                                                        <label for="admin_notes">ملاحظات الإدارة</label>
                                                        <textarea name="admin_notes" class="form-control" rows="3">{{ $message->admin_notes }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">تم الرد</button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">لا توجد رسائل</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
