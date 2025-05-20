<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شريط تنقل نشمية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
            font-size: 17px;
            font-weight: 600;
        }

        body {
            background-color: #f5f5f5;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-bottom: 1px solid #eaeaea;
            color: #000;
            font-family: 'Cairo', sans-serif;
            height: 90px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-top: -15px;
            margin-right: 40px;
        }

        .logo img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .main-nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
  margin-right: 40px;

        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;


        }

        .nav-link {
    color: #333;  /* تم تغيير اللون الأساسي */
    text-decoration: none;
    font-size: 17px !important;  /* تم زيادة حجم الخط */
    font-weight: 600 !important;
    transition: all 0.3s;
    position: relative;
    padding: 5px 0;  /* تم إضافة padding */
}

        .nav-link:hover {
            color: #666;  /* تم تغيير اللون للأفتح عند مرور المؤشر */
        }

        /* تم إزالة الكود الذي يضيف خط تحت الكلمة عند التأشير عليها */
        /*
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #000;
            left: 0;
            bottom: -4px;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }
        */

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 4px;
            right: 0;
        }

        .dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: right;
            transition: background-color 0.3s;
            font-size: 16px !important;
            font-weight: normal !important;
        }

        .dropdown-content a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .nav-link {
            color: #000;
        }

        .cart-icon {
            position: relative;
           padding: 30px;

  margin-left: 40px;
        }

        .cart-count {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #b71c1c; /* لون أحمر غامق وواضح */
            color: #fff;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 15px;
            font-weight: bold;
            min-width: 22px;
            text-align: center;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(0,0,0,0.12);
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 992px) {
            .navbar {
                flex-wrap: wrap;
                padding: 15px 20px;
            }

            .navbar-right, .navbar-left {
                margin: 10px 0;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }

            .navbar-right, .navbar-left {
                width: 100%;
                justify-content: center;
                margin: 10px 0;
            }

            .main-nav-links {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Login dropdown styles */
        .login-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            min-width: 300px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1000;
            border-radius: 4px;
            padding: 20px;
            display: none;
        }

        .login-dropdown.show {
            display: block;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 14px;
            color: #666;
        }

        .form-group input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: rgba(183, 28, 28, 1);
        }

        .login-btn {
            background-color: rgba(183, 28, 28, 1);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #940000;
        }

        .login-footer {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        .login-footer a {
            color: rgba(183, 28, 28, 1);
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .cart-icon-link {
            text-decoration: none;
            position: relative;
            display: inline-block;
            padding: 5px;
            transition: transform 0.2s ease;
        }

        .cart-icon-link:hover {
            transform: translateY(-2px);
        }

        .cart-icon {
            position: relative;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-right">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/nashmia-logo.ico') }}" alt="شعار نشمية">
                </a>
            </div>

            <div class="main-nav-links">
                <a href="{{ route('home') }}" class="nav-link">الرئيسية</a>
                <div class="dropdown">
                    <a href="#" class="nav-link">التصنيفات</a>
                    <div class="dropdown-content">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('about') }}" class="nav-link">من نحن</a>
                <a href="{{ route('contact') }}" class="nav-link">اتصل بنا</a>
            </div>
        </div>

        <div class="navbar-left">
            @auth
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: #2563eb; cursor:pointer;">
                        أهلاً، {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-content" aria-labelledby="userDropdown" style="right:0; left:auto; min-width: 160px;">
                        <a href="{{ route('profile.edit') }}">الملف الشخصي</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:#b71c1c; width:100%; text-align:right; padding:12px 16px; cursor:pointer;">تسجيل خروج</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="dropdown">
                    <a href="#" class="nav-link" id="loginButton">تسجيل الدخول</a>
                    <div class="login-dropdown" id="loginDropdown">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="remember-me">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">تذكرني</label>
                            </div>
                            <button type="submit" class="login-btn">تسجيل الدخول</button>
                            <div class="login-footer">
                                <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                                <br>
                                ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth
            @php
                $cartCount = 0;
                if (Auth::check()) {
                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                } else {
                    $cart = session('cart', []);
                    $cartCount = array_sum(array_column($cart, 'quantity'));
                }
            @endphp
            <a href="{{ route('cart.index') }}" class="cart-icon-link">
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart" style="font-size: 20px; color: #000;"></i>
                    <span class="cart-count" id="cart-count">{{ $cartCount }}</span>
                </div>
            </a>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginButton = document.getElementById('loginButton');
            const loginDropdown = document.getElementById('loginDropdown');

            if (loginButton && loginDropdown) {
                loginButton.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    loginDropdown.style.display = loginDropdown.style.display === 'block' ? 'none' : 'block';
                };

                document.onclick = function(event) {
                    if (!loginDropdown.contains(event.target) && !loginButton.contains(event.target)) {
                        loginDropdown.style.display = 'none';
                    }
                };

                loginDropdown.onclick = function(event) {
                    event.stopPropagation();
                };
            }
        });
    </script>
</body>
</html>
