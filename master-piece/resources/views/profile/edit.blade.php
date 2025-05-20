@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px #0001; padding: 40px;">
    <h2 class="mb-4" style="text-align: center; color: #2563eb;">الملف الشخصي</h2>
    @if(session('status'))
        <div style="color: green; text-align: center; margin-bottom: 20px;">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')<div style="color: red;">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')<div style="color: red;">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">العنوان</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
            @error('address')<div style="color: red;">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">تحديث البيانات</button>
    </form>
    <hr>
    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف حسابك؟ لا يمكن التراجع عن هذه العملية.');">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور للتأكيد</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')<div style="color: red;">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-danger w-100">حذف الحساب نهائياً</button>
    </form>

    <hr>
    <h4 class="mb-3" style="color: #2563eb;">طلباتي السابقة</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>رقم الطلب</th>
                    <th>تاريخ الطلب</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ number_format($order->total, 2) }} ريال</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">لا يوجد طلبات سابقة.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
