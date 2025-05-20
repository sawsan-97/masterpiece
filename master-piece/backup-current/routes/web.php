<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\JoinRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// البحث
Route::get('/search', [HomeController::class, 'search'])->name('search');

// صفحة الـ footer
Route::get('/footer', function () {
    return view('layouts.footer');
})->name('footer');

// التسجيل والدخول
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// المنتجات
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// الفئات
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// السلة
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// الدفع
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// صفحة من نحن
Route::get('/about', function () {
    return view('about');
})->name('about');

// صفحة اتصل بنا
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function () {
    return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
})->name('contact.submit');

//طلب الانضمام
Route::get('/join-request', function () {
    return view('join-request');
})->name('join.request');

// مسارات الأخبار
Route::prefix('news')->group(function () {
    Route::get('/', [App\Http\Controllers\NewsController::class, 'frontIndex'])->name('news.index');
    Route::get('/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
});

// مسارات لوحة التحكم
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // مسارات إدارة الأخبار
    Route::resource('news', App\Http\Controllers\NewsController::class)->except(['show']);
}); // Added missing closing bracket here

Route::post('/join-request', [JoinRequestController::class, 'store'])->name('join.request.submit');

// مسارات آراء العملاء
Route::get('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonials/create', [\App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');

// مسارات إعادة تعيين كلمة المرور
Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.update');

// صفحة البروفايل للمستخدم
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', [
            'user' => request()->user(),
        ]);
    })->name('profile.edit');

    Route::patch('/profile', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $user->update($data);
        return back()->with('status', 'تم تحديث البيانات بنجاح');
    })->name('profile.update');

    Route::delete('/profile', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'تم حذف الحساب بنجاح');
    })->name('profile.destroy');
});

// مسارات التحقق من البريد الإلكتروني
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'تم إرسال رابط التحقق إلى بريدك الإلكتروني.');
    })->name('verification.send');
});

// مسارات المفضلة
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// مسارات لوحة التحكم
Route::group(['middleware' => ['web', 'auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // مسارات المنتجات
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // مسارات التصنيفات
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    // مسارات الطلبات
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

    // مسارات المستخدمين
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::patch('users/{user}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');

    // مسارات الكوبونات
    Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class);

    // مسارات الأخبار
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');

    // مسارات طلبات الانضمام
    Route::get('/join-requests', [JoinRequestController::class, 'index'])->name('join-requests.index');
    Route::patch('/join-requests/{joinRequest}/status', [JoinRequestController::class, 'updateStatus'])->name('join-requests.update-status');
});

Storage::disk('public')->exists('news/your_image.jpg');
