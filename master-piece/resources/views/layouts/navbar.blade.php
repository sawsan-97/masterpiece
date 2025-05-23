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
            position: relative;
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
            color: #333;
            text-decoration: none;
            font-size: 17px !important;
            font-weight: 600 !important;
            transition: all 0.3s;
            position: relative;
            padding: 5px 0;
        }

        .nav-link:hover {
            color: #666;
        }

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
            background-color: #b71c1c;
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

        /* Hamburger Menu Styles */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
            z-index: 1001;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 90px;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            padding: 20px;
            border-top: 1px solid #eaeaea;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        .mobile-nav-links .nav-link {
            font-size: 18px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .mobile-dropdown {
            position: relative;
        }

        .mobile-dropdown-content {
            display: none;
            background-color: #f9f9f9;
            margin-top: 10px;
            padding: 10px 0;
            border-radius: 4px;
        }

        .mobile-dropdown-content.active {
            display: block;
        }

        .mobile-dropdown-content a {
            display: block;
            padding: 10px 20px;
            color: #666;
            text-decoration: none;
            font-size: 16px;
            font-weight: normal;
        }

        .mobile-dropdown-content a:hover {
            background-color: #e9e9e9;
        }

        .mobile-user-section {
            border-top: 1px solid #eaeaea;
            padding-top: 20px;
            margin-top: 20px;
        }

        .mobile-login-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .mobile-cart {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }

        .mobile-cart:hover {
            background-color: #e9e9e9;
        }

        @media (max-width: 992px) {
            .navbar {
                padding: 15px 30px;
            }

            .hamburger {
                display: flex;
            }

            .main-nav-links,
            .navbar-left {
                display: none;
            }

            .logo {
                margin-right: 20px;
            }

            .mobile-menu {
                top: 70px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                height: 70px;
            }

            .logo {
                margin-right: 10px;
                margin-top: 0;
            }

            .logo img {
                width: 80px;
                margin-bottom: 0;
            }

            .mobile-menu {
                top: 70px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 10px 15px;
                height: 60px;
            }

            .logo img {
                width: 70px;
            }

            .mobile-menu {
                top: 60px;
            }

            .mobile-nav-links .nav-link {
                font-size: 16px;
            }
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
                <a href="{{ route('news.index') }}" class="nav-link">المدونة</a>
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

        <!-- Hamburger Menu -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-nav-links">
            <a href="{{ route('home') }}" class="nav-link">الرئيسية</a>

            <div class="mobile-dropdown">
                <a href="#" class="nav-link" id="mobileCategories">التصنيفات <i class="fas fa-chevron-down" style="font-size: 12px; margin-right: 5px;"></i></a>
                <div class="mobile-dropdown-content" id="mobileCategoriesContent">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('news.index') }}" class="nav-link">المدونة</a>
            <a href="{{ route('about') }}" class="nav-link">من نحن</a>
            <a href="{{ route('contact') }}" class="nav-link">اتصل بنا</a>
        </div>

        <!-- Mobile User Section -->
        <div class="mobile-user-section">
            @auth
                <div class="mobile-dropdown">
                    <a href="#" class="nav-link" style="color: #2563eb;">أهلاً، {{ Auth::user()->name }} <i class="fas fa-chevron-down" style="font-size: 12px; margin-right: 5px;"></i></a>
                    <div class="mobile-dropdown-content">
                        <a href="{{ route('profile.edit') }}">الملف الشخصي</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:#b71c1c; width:100%; text-align:right; padding:10px 20px; cursor:pointer; font-size: 16px;">تسجيل خروج</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="#" class="nav-link" id="mobileLoginButton">تسجيل الدخول <i class="fas fa-chevron-down" style="font-size: 12px; margin-right: 5px;"></i></a>
                <div class="mobile-login-form" id="mobileLoginForm" style="display: none;">
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="mobile-email">البريد الإلكتروني</label>
                            <input type="email" id="mobile-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile-password">كلمة المرور</label>
                            <input type="password" id="mobile-password" name="password" required>
                        </div>
                        <div class="remember-me">
                            <input type="checkbox" id="mobile-remember" name="remember">
                            <label for="mobile-remember">تذكرني</label>
                        </div>
                        <button type="submit" class="login-btn">تسجيل الدخول</button>
                        <div class="login-footer">
                            <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                            <br>
                            ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a>
                        </div>
                    </form>
                </div>
            @endauth
        </div>

        <!-- Mobile Cart -->
        <a href="{{ route('cart.index') }}" class="mobile-cart">
            <i class="fas fa-shopping-cart" style="font-size: 18px;"></i>
            <span>السلة ({{ $cartCount }})</span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Desktop login dropdown
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

            // Hamburger menu toggle
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');

            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });

            // Mobile dropdown toggles
            const mobileCategories = document.getElementById('mobileCategories');
            const mobileCategoriesContent = document.getElementById('mobileCategoriesContent');

            if (mobileCategories) {
                mobileCategories.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileCategoriesContent.classList.toggle('active');
                });
            }

            // Mobile login toggle
            const mobileLoginButton = document.getElementById('mobileLoginButton');
            const mobileLoginForm = document.getElementById('mobileLoginForm');

            if (mobileLoginButton) {
                mobileLoginButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileLoginForm.style.display = mobileLoginForm.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Mobile user dropdown (for authenticated users)
            const mobileUserDropdowns = document.querySelectorAll('.mobile-user-section .mobile-dropdown > .nav-link');
            mobileUserDropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    const content = this.nextElementSibling;
                    if (content && content.classList.contains('mobile-dropdown-content')) {
                        content.classList.toggle('active');
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !hamburger.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });

            // Close mobile menu when clicking on a link (except dropdowns)
            const mobileLinks = document.querySelectorAll('.mobile-nav-links > .nav-link:not(#mobileCategories)');
            mobileLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html>