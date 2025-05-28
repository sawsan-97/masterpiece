@extends('layouts.app')
@section('content')
<div style="padding: 40px; background: #f8f9fa;">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- قسم المعلومات الشخصية - اليمين -->
            <div class="col-lg-6">
                <div style="background: #fff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 30px; height: 100%;">
                    <h3 style="text-align: center; color: #007A3D; margin-bottom: 30px; font-weight: bold;">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                        الملف الشخصي
                    </h3>

                    @if(session('status'))
                        <div style="color: #28a745; text-align: center; margin-bottom: 25px; padding: 12px; background: #d4edda; border-radius: 8px; border: 1px solid #c3e6cb;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="name" class="form-label" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                                <i class="fas fa-user" style="margin-left: 8px; color: #007A3D;"></i>
                                الاسم
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $user->name) }}" required
                                   style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px; transition: all 0.3s ease;"
                                   onfocus="this.style.borderColor='#007A3D'"
                                   onblur="this.style.borderColor='#e9ecef'">
                            @error('name')<div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                                <i class="fas fa-envelope" style="margin-left: 8px; color: #007A3D;"></i>
                                البريد الإلكتروني
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email', $user->email) }}" required
                                   style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px; transition: all 0.3s ease;"
                                   onfocus="this.style.borderColor='#007A3D'"
                                   onblur="this.style.borderColor='#e9ecef'">
                            @error('email')<div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                                <i class="fas fa-map-marker-alt" style="margin-left: 8px; color: #007A3D;"></i>
                                العنوان
                            </label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ old('address', $user->address) }}"
                                   style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px; transition: all 0.3s ease;"
                                   onfocus="this.style.borderColor='#007A3D'"
                                   onblur="this.style.borderColor='#e9ecef'">
                            @error('address')<div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn w-100"
                                style="background: linear-gradient(135deg, #007A3D, #005a2d); color: white; border: none; padding: 15px; border-radius: 10px; font-weight: 600; font-size: 16px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,122,61,0.3);"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(0,122,61,0.4)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,122,61,0.3)'">
                            <i class="fas fa-save" style="margin-left: 8px;"></i>
                            تحديث البيانات
                        </button>
                    </form>

                    <hr style="margin: 30px 0; border-color: #e9ecef;">

                    <!-- قسم حذف الحساب -->
                    <div style="background: #fff5f5; border: 1px solid #fed7d7; border-radius: 10px; padding: 20px;">
                        <h5 style="color: #c53030; margin-bottom: 15px; text-align: center;">
                            <i class="fas fa-exclamation-triangle" style="margin-left: 8px;"></i>
                            منطقة خطر
                        </h5>
                        <form method="POST" action="{{ route('profile.destroy') }}"
                              onsubmit="return confirm('هل أنت متأكد أنك تريد حذف حسابك؟ لا يمكن التراجع عن هذه العملية.');">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password" class="form-label" style="font-weight: 600; color: #495057;">
                                    كلمة المرور للتأكيد
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required
                                       style="border-radius: 8px; border: 2px solid #fed7d7; padding: 10px;">
                                @error('password')<div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-danger w-100"
                                    style="border-radius: 8px; padding: 12px; font-weight: 600;">
                                <i class="fas fa-trash-alt" style="margin-left: 8px;"></i>
                                حذف الحساب نهائياً
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- قسم الطلبات السابقة - اليسار -->
            <div class="col-lg-6">
                <div style="background: #fff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 30px; height: 100%;">
                    <h3 style="text-align: center; color: #007A3D; margin-bottom: 30px; font-weight: bold;">
                        <i class="fas fa-shopping-bag" style="margin-left: 10px;"></i>
                        طلباتي السابقة
                    </h3>

                    <div style="max-height: 500px; overflow-y: auto;">
                        @forelse($user->orders as $order)
                            <div style="background: linear-gradient(135deg, #f8f9fa, #ffffff); border: 1px solid #e9ecef; border-radius: 12px; padding: 20px; margin-bottom: 15px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.05);"
                                 onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div style="text-align: center;">
                                            <div style="background: #007A3D; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px; font-weight: bold;">
                                                {{ $order->id }}
                                            </div>
                                            <small style="color: #6c757d;">رقم الطلب</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div style="text-align: center;">
                                            <div style="font-weight: 600; color: #495057; margin-bottom: 4px;">
                                                {{ $order->created_at->format('Y-m-d') }}
                                            </div>
                                            <small style="color: #6c757d;">
                                                <i class="fas fa-calendar-alt" style="margin-left: 4px;"></i>
                                                التاريخ
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div style="text-align: center;">
                                            <div style="font-weight: bold; color: #007A3D; font-size: 18px; margin-bottom: 4px;">
                                                {{ number_format($order->total, 2) }} د.ا
                                            </div>
                                            <small style="color: #6c757d;">
                                                <i class="fas fa-money-bill-wave" style="margin-left: 4px;"></i>
                                                د.ا
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div style="text-align: center;">
                                            @php
                                                $statusColors = [
                                                    'pending' => ['bg' => '#fff3cd', 'text' => '#856404', 'icon' => 'clock'],
                                                    'processing' => ['bg' => '#cce7ff', 'text' => '#004085', 'icon' => 'cog'],
                                                    'completed' => ['bg' => '#d4edda', 'text' => '#155724', 'icon' => 'check-circle'],
                                                    'cancelled' => ['bg' => '#f8d7da', 'text' => '#721c24', 'icon' => 'times-circle']
                                                ];
                                                $status = $statusColors[$order->status] ?? ['bg' => '#e2e3e5', 'text' => '#383d41', 'icon' => 'question'];
                                            @endphp
                                            <span style="background: {{ $status['bg'] }}; color: {{ $status['text'] }}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center;">
                                                <i class="fas fa-{{ $status['icon'] }}" style="margin-left: 4px;"></i>
                                                {{ $order->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 60px 20px; color: #6c757d;">
                                <i class="fas fa-shopping-cart" style="font-size: 60px; margin-bottom: 20px; opacity: 0.3;"></i>
                                <h5 style="margin-bottom: 10px;">لا يوجد طلبات سابقة</h5>
                                <p>لم تقم بأي طلبات حتى الآن</p>
                                <a href="{{ route('shop') }}" class="btn"
                                   style="background: #007A3D; color: white; border-radius: 20px; padding: 10px 20px; text-decoration: none; margin-top: 15px;">
                                    ابدأ التسوق الآن
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* تأثيرات إضافية للتفاعل */
.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 122, 61, 0.25) !important;
}

.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* تحسين المظهر على الأجهزة المحمولة */
@media (max-width: 991px) {
    .col-lg-6 {
        margin-bottom: 20px;
    }
}

/* تمرير سلس للطلبات */
div[style*="max-height: 500px"]::-webkit-scrollbar {
    width: 6px;
}

div[style*="max-height: 500px"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

div[style*="max-height: 500px"]::-webkit-scrollbar-thumb {
    background: #007A3D;
    border-radius: 10px;
}

div[style*="max-height: 500px"]::-webkit-scrollbar-thumb:hover {
    background: #005a2d;
}
</style>
@endsection
