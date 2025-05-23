<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نشمية الأردنية - Footer</title>
    <!-- تضمين Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- تضمين Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- تضمين Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

        .footer {
            background-color: rgb(20,28,44);
            color: #ffffff;
            padding: 2.5rem 0 1.5rem;
            border-top: 2px solid #2d3549;
            font-family: 'Tajawal', sans-serif;
        }

        .footer-section {
            margin-bottom: 1.5rem;
        }

        .footer-section h4 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-section h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 2px;
            background-color: #007A3D;
        }

        .footer-logo {
            max-height: 100px;
            width: auto;
            margin-bottom: 0.8rem;
        }

        .footer-about {
            color: #c5c5c5;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-top: 0.8rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links a {
            color: #c5c5c5;
            text-decoration: none;
            display: block;
            margin-bottom: 0.6rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            padding-right: 15px;
        }

        .footer-links a::before {
            content: '←';
            position: absolute;
            right: 0;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #007A3D;
            padding-right: 20px;
        }

        .footer-links a:hover::before {
            opacity: 1;
        }

        .contact-info .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            color: #c5c5c5;
            font-size: 0.9rem;
        }

        .contact-info i {
            width: 35px;
            height: 35px;
            background-color: rgba(0, 122, 61, 0.2);
            color: #007A3D;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .social-icons {
            margin-top: 1.2rem;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            margin-left: 10px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .social-icons i {
            font-size: 1.2rem;
            color: #ffffff;
        }

        .social-icons .bi-facebook {
            color: #ffffff;
        }

        .social-icons .bi-instagram {
            color: #ffffff;
        }

        .social-icons .bi-whatsapp {
            color: #ffffff;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .footer-bottom {
            border-top: 1px solid #2d3549;
            padding-top: 1.2rem;
            margin-top: 1.5rem;
            text-align: center;
            color: #a0a0a0;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .footer-section {
                text-align: center;
                margin-bottom: 2rem;
            }

            .footer-section h4::after {
                right: 50%;
                transform: translateX(50%);
            }

            .contact-info .contact-item {
                justify-content: center;
            }

            .social-icons {
                justify-content: center;
                display: flex;
            }
        }
    </style>
</head>
<body>
    <!-- عرض Footer فقط -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- القسم الأول: الشعار ونبذة -->
                <div class="col-lg-4 footer-section">
                    <img src="{{ asset('images/nashmia-logo.ico') }}" alt="شعار نشمية الأردنية" class="footer-logo">
                    <p class="footer-about">
                        نشمية الأردنية - منصتك الأولى للمنتجات الحرفية والغذائية المنزلية الأردنية. نربط الحرفيات المبدعات بالمستهلكين مباشرة.
                    </p>
                </div>

                <!-- القسم الثاني: روابط مهمة -->
                <div class="col-lg-4 footer-section">
                    <h4>روابط مهمة</h4>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">الرئيسية</a>
                        <a href="{{ route('products.index')}}">المنتجات</a>

                        <a href="{{ route('about') }}">من نحن</a>
                        <a href="{{ route('contact') }}">اتصل بنا</a>
                    </div>
                </div>

                <!-- القسم الثالث: معلومات الاتصال -->
                <div class="col-lg-4 footer-section">
                    <h4>تواصل معنا</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+962 78 211 3388</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@nashmeya.jo</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>عمان، الأردن</span>
                        </div>
                    </div>

                    <div class="social-icons">
                        <a href="#" aria-label="فيسبوك"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="انستغرام"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="واتساب"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- حقوق النشر -->
            <div class="footer-bottom">
                <p class="mb-0">جميع الحقوق محفوظة &copy; {{ date('Y') }} نشمية الأردنية</p>
            </div>
        </div>
    </footer>

    <!-- تضمين Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
