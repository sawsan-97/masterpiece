<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلايدر نشمية</title>
    <!-- تضمين Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        .slider-container {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
        }

        /* مربع البحث الثابت فوق جميع الشرائح */
        .fixed-search-container {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 700px;
            z-index: 10;
        }

        .slider {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slide.active {
            opacity: 1;
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
        }

        /* تعديل شكل مربع البحث ليشبه الصورة المرسلة */
        .search-form {
            display: flex;
            width: 100%;
            position: relative;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            background: #fff;
            transition: all 0.3s ease;
            height: 50px;
        }

        .search-form:focus-within {
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: black;
            font-size: 1.2rem;
            z-index: 2;
        }

        .search-input {
            flex: 1;
            padding: 18px 25px 18px 60px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-family: 'Cairo', sans-serif;
            color: #4A5568;
            width: 100%;
            box-sizing: border-box;
            background: transparent;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
        }

        .search-input::placeholder {
            color: #A0AEC0;
        }

        /* النقاط والأسهم */
        .slider-nav {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: #fff;
            transform: scale(1.2);
        }

        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #fff;
            font-size: 1.5rem;
        }

        .slider-arrow:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .slider-arrow.prev {
            left: 20px;
        }

        .slider-arrow.next {
            right: 20px;
        }

        @media (max-width: 768px) {
            .slider-container {
                height: 500px;
            }

            .fixed-search-container {
                width: 85%;
                top: 35%;
            }
        }
    </style>
</head>
<body>
    <div class="slider-container">
        <!-- مربع البحث الثابت فوق جميع الشرائح -->
        <div class="fixed-search-container">
            <form class="search-form" action="{{ route('search') }}" method="GET">
                <input type="text" class="search-input" placeholder="ابحث عن منتجك المفضل..." name="query" value="{{ request('query') }}">
                <button type="submit" class="search-icon">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="slider">
            <div class="slide active" style="background-image: url('{{ asset('images/slide4.jpg') }}')">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/slide5.jpg') }}')">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide" style="background-image: url('{{ asset('images/slide6.jpg') }}')">
                <div class="slide-overlay"></div>
            </div>
        </div>

        <div class="slider-nav">
            <div class="slider-dot active" data-slide="0"></div>
            <div class="slider-dot" data-slide="1"></div>
            <div class="slider-dot" data-slide="2"></div>
        </div>

        <div class="slider-arrow prev">
            <i class="fas fa-chevron-right"></i>
        </div>
        <div class="slider-arrow next">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-arrow.prev');
            const nextBtn = document.querySelector('.slider-arrow.next');
            let currentSlide = 0;
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                slides[index].classList.add('active');
                dots[index].classList.add('active');
                currentSlide = index;
            }

            function nextSlide() {
                showSlide((currentSlide + 1) % totalSlides);
            }

            function prevSlide() {
                showSlide((currentSlide - 1 + totalSlides) % totalSlides);
            }

            // التنقل التلقائي
            let slideInterval = setInterval(nextSlide, 5000);

            // أزرار التنقل
            prevBtn.addEventListener('click', () => {
                clearInterval(slideInterval);
                prevSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });

            nextBtn.addEventListener('click', () => {
                clearInterval(slideInterval);
                nextSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });

            // النقاط
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(index);
                    slideInterval = setInterval(nextSlide, 5000);
                });
            });
        });
    </script>
</body>
</html>
