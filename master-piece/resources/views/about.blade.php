@extends('layouts.app')

@section('content')


</head>
<body>
<style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background-color: #fffcf5;
        }

        .about-main-section {
            background-color: #faf6f3;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .about-text h2 {
            position: relative;
            padding-right: 15px;
            color: #333;
            font-weight: 700;
        }

        .about-text h2:before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 24px;
            background-color: rgba(183, 28, 28, 1);
        }

        .about-image-container {
            position: relative;
        }

        .about-image-container img {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            max-width: 100%;
            height: auto;
        }

        .mission-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            max-width: 90%;
            margin: 0 auto;
        }

        .values-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .value-item {
            padding: 15px;
            transition: transform 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-5px);
        }

        .value-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .vision-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }

        .fa-building {
            color: rgba(255, 191, 0, 1) !important;
        }

        @media (max-width: 768px) {
            .about-main-section {
                padding: 20px;
            }

            .about-image-container {
                margin-top: 30px;
                order: 2;
            }

            .about-text-container {
                order: 1;
            }
        }
    </style>

    <div class="container py-5">
        <!-- قسم من نحن الرئيسي -->
        <div class="row about-main-section mb-5">
            <div class="col-md-6 about-image-container">
                <img src="{{ asset('images/about.png') }}" alt="صورة سيدة أردنية تعمل بالحرف اليدوية" class="img-fluid rounded">
            </div>
            <div class="col-md-6 d-flex align-items-center about-text-container">
                <div class="about-text">
                    <h2 class="mb-4">من نحن</h2>
                    <p class="mb-3">
                        نحن "بيت النشميات " – منصة إلكترونية أردنية تأسست بشغف لدعم وتمكين ستات البيوت والحِرَفيات المبدعات من مختلف أنحاء المملكة.
                        بنآمن إن كل منتج بيتصنع من قلب البيت... إله قصة، وراه ست قوية، ومليان حب وتعب.

                    </p>
                    <p class="mb-3">
                        من اللبنة المدحرجة والمقدوس، للشموع المعطّرة وتوزيعات المناسبات، منصتنا بتجمع بين الأصالة والحداثة، وبتوصّل إبداعات النشميات لبيوت الناس بطريقة سهلة، آمنة، وعصرية.
                    </p>

                </div>
            </div>
        </div>



        <!-- رؤيتنا -->
        <div class="row mb-5 py-4 bg-light rounded">
            <div class="col-12 text-center">
                <h3 class="mb-4" style="color: #a83232;">رؤيتنا</h3>
                <p>
                    نخلق مساحة عادلة، داعمة، واحترافية للسيدات يبيعوا من خلالها، ويتطوروا، ويوصلوا لأكبر عدد من الناس داخل الأردن.
                </p>
            </div>
        </div>

        <!-- قيمنا -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h3 class="mb-4" style="color: #a83232;">قيمنا</h3>
            </div>

                <div class="container text-center">

                    <div class="row">
                        <div class="col-md-3 mb-5">
                            <div class="text-center">
                                <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">أصالة</h3>
                                <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">منتجات يدوية أصيلة تعكس تراثنا</p>
                            </div>
                        </div>

                        <div class="col-md-3 mb-5">
                            <div class="text-center">
                                <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">استدامة</h3>
                                <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">نهتم بالبيئة ونشجع الإنتاج المستدام</p>
                            </div>
                        </div>

                        <div class="col-md-3 mb-5">
                            <div class="text-center">
                                <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">تمكين المرأة</h3>
                                <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">ندعم استقلال المرأة اقتصادياً</p>
                            </div>
                        </div>

                        <div class="col-md-3 mb-5">
                            <div class="text-center">
                                <div style="color: #007A3D; font-size: 3rem; margin-bottom: 1rem;">
                                    <i class="fas fa-hands-holding-circle"></i>
                                </div>
                                <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem;">أثر مجتمعي</h3>
                                <p style="color: #555; font-size: 0.95rem; line-height: 1.5;">نساهم في تنمية المجتمع المحلي</p>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

@endsection
