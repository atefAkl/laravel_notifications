<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Page Title -->
        <title>@yield('title', config('app.name', 'المدونة'))</title>

        <!-- Meta Tags -->
        <meta name="description" content="@yield('description', 'منصة لمشاركة المعرفة والخبرات في مجالات التقنية والبرمجة')">
        <meta name="keywords" content="@yield('keywords', 'تقنية, برمجة, تصميم, مدونة, مقالات')">
        <meta name="author" content="@yield('author', config('app.name', 'المدونة'))">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="@yield('title', config('app.name', 'المدونة'))">
        <meta property="og:description" content="@yield('description', 'منصة لمشاركة المعرفة والخبرات في مجالات التقنية والبرمجة')">
        <meta property="og:type" content="@yield('og-type', 'website')">
        <meta property="og:url" content="@yield('og-url', url()->current())">
        <meta property="og:image" content="@yield('og-image', asset('images/default-og.jpg'))">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', config('app.name', 'المدونة'))">
        <meta name="twitter:description" content="@yield('description', 'منصة لمشاركة المعرفة والخبرات في مجالات التقنية والبرمجة')">
        <meta name="twitter:image" content="@yield('twitter-image', asset('images/default-og.jpg'))">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Tajawal:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-color: #667eea;
                --secondary-color: #764ba2;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --danger-color: #ef4444;
                --dark-color: #1f2937;
                --light-color: #f8f9fa;
                --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
                --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                --shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
                --border-radius: 0.5rem;
                --transition: all 0.3s ease;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Tajawal', sans-serif;
                background-color: var(--light-color);
                color: var(--dark-color);
                line-height: 1.6;
                overflow-x: hidden;
            }

            /* Typography */
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-weight: 700;
                margin-bottom: 1rem;
                color: var(--dark-color);
            }

            h1 {
                font-size: 2.5rem;
            }

            h2 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.75rem;
            }

            h4 {
                font-size: 1.5rem;
            }

            h5 {
                font-size: 1.25rem;
            }

            h6 {
                font-size: 1.125rem;
            }

            /* Links */
            a {
                color: var(--primary-color);
                text-decoration: none;
                transition: var(--transition);
            }

            a:hover {
                color: var(--secondary-color);
                transform: translateY(-1px);
            }

            /* Buttons */
            .btn-primary {
                background: var(--gradient-primary);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: var(--border-radius);
                transition: var(--transition);
                box-shadow: var(--shadow-sm);
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #5a67d8 0%, #6b4199 100%);
                transform: translateY(-2px);
                box-shadow: var(--shadow-md);
                color: white;
            }

            .btn-outline-primary {
                border: 2px solid var(--primary-color);
                color: var(--primary-color);
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: var(--border-radius);
                transition: var(--transition);
            }

            .btn-outline-primary:hover {
                background: var(--gradient-primary);
                border-color: transparent;
                color: white;
                transform: translateY(-2px);
            }

            /* Cards */
            .card {
                border: none;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                transition: var(--transition);
                overflow: hidden;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-lg);
            }

            .card-header {
                background: var(--gradient-primary);
                color: white;
                font-weight: 600;
                border: none;
            }

            /* Forms */
            .form-control {
                border: 2px solid #e5e7eb;
                border-radius: var(--border-radius);
                padding: 0.75rem 1rem;
                transition: var(--transition);
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                outline: none;
            }

            /* Navigation */
            .navbar {
                background: white;
                box-shadow: var(--shadow-sm);
                padding: 1rem 0;
            }

            .navbar-brand {
                font-weight: 800;
                font-size: 1.5rem;
                color: var(--primary-color) !important;
                display: flex;
                align-items: center;
            }

            .navbar-brand:hover {
                color: var(--secondary-color) !important;
            }

            .nav-link {
                font-weight: 500;
                color: var(--dark-color) !important;
                margin: 0 0.5rem;
                transition: var(--transition);
                position: relative;
            }

            .nav-link:hover {
                color: var(--primary-color) !important;
            }

            .nav-link.active {
                color: var(--primary-color) !important;
            }

            .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--gradient-primary);
                border-radius: 2px;
            }

            /* Search Box */
            .search-box {
                position: relative;
            }

            .search-box .form-control {
                padding-left: 3rem;
                border-radius: 2rem;
            }

            .search-box .search-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #6b7280;
                z-index: 10;
            }

            /* Hero Section */
            .hero-section {
                background: var(--gradient-primary);
                color: white;
                padding: 5rem 0;
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
                background-size: cover;
            }

            /* Post Card */
            .post-card {
                border: none;
                border-radius: var(--border-radius);
                overflow: hidden;
                transition: var(--transition);
                height: 100%;
            }

            .post-card:hover {
                transform: translateY(-10px);
                box-shadow: var(--shadow-lg);
            }

            .post-card .post-image {
                height: 200px;
                object-fit: cover;
                transition: var(--transition);
            }

            .post-card:hover .post-image {
                transform: scale(1.05);
            }

            .post-card .post-meta {
                font-size: 0.875rem;
                color: #6b7280;
            }

            .post-card .post-title {
                font-size: 1.25rem;
                font-weight: 700;
                margin: 0.5rem 0;
                color: var(--dark-color);
            }

            .post-card .post-excerpt {
                color: #6b7280;
                font-size: 0.875rem;
                line-height: 1.5;
            }

            /* Tags */
            .tag {
                display: inline-block;
                background: #e5e7eb;
                color: var(--dark-color);
                padding: 0.25rem 0.75rem;
                border-radius: 1rem;
                font-size: 0.75rem;
                font-weight: 500;
                transition: var(--transition);
                text-decoration: none;
            }

            .tag:hover {
                background: var(--primary-color);
                color: white;
                transform: translateY(-1px);
            }

            /* Footer */
            footer {
                background: var(--dark-color);
                color: white;
                padding: 3rem 0 1rem;
                margin-top: 5rem;
            }

            footer h5 {
                color: white;
                margin-bottom: 1.5rem;
                font-weight: 700;
            }

            footer a {
                color: #9ca3af;
                text-decoration: none;
                transition: var(--transition);
            }

            footer a:hover {
                color: white;
            }

            .social-links a {
                display: inline-block;
                width: 40px;
                height: 40px;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                text-align: center;
                line-height: 40px;
                border-radius: 50%;
                margin: 0 0.5rem;
                transition: var(--transition);
            }

            .social-links a:hover {
                background: var(--gradient-primary);
                transform: translateY(-3px);
            }

            /* Loading Animation */
            .loading {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: white;
                animation: spin 1s ease-in-out infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* Responsive */
            @media (max-width: 768px) {
                h1 {
                    font-size: 2rem;
                }

                h2 {
                    font-size: 1.75rem;
                }

                h3 {
                    font-size: 1.5rem;
                }

                .hero-section {
                    padding: 3rem 0;
                }

                .post-card .post-image {
                    height: 150px;
                }
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--gradient-primary);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--secondary-color);
            }
        </style>

        <!-- Additional Page Specific Styles -->
        @yield('styles')
    </head>

    <body>
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 300px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 300px;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('posts.index') }}">
                    <i class="fas fa-blog me-2"></i>
                    {{ config('app.name', 'المدونة') }}
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Content -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Navigation Links -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                                <i class="fas fa-home me-1"></i>الرئيسية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-th-large me-1"></i>الأقسام
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-info-circle me-1"></i>عن المدونة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-envelope me-1"></i>اتصل بنا
                            </a>
                        </li>
                    </ul>

                    <!-- Search -->
                    <form class="d-flex search-box me-3" action="{{ route('posts.search') }}" method="GET">
                        <i class="fas fa-search search-icon"></i>
                        <input class="form-control" type="search" name="q" placeholder="البحث عن مقال...">
                    </form>

                    <!-- User Menu -->
                    @guest
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt me-1"></i>تسجيل الدخول
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>إنشاء حساب
                        </a>
                        @endif
                    </div>
                    @else
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->email }}
                                </h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i>الملف الشخصي
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                                </a>
                            </li>
                            @if(Auth::user()->canCreatePost())
                            <li>
                                <a class="dropdown-item" href="{{ route('posts.create') }}">
                                    <i class="fas fa-plus me-2"></i>مقال جديد
                                </a>
                            </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5>
                            <i class="fas fa-blog me-2"></i>{{ config('app.name', 'المدونة') }}
                        </h5>
                        <p class="text-white-50">
                            منصة لمشاركة المعرفة والخبرات في مجالات التقنية والبرمجة والتصميم والتسويق الرقمي.
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" title="فيسبوك">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" title="تويتر">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" title="انستغرام">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" title="لينكد إن">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" title="يوتيوب">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5>
                            <i class="fas fa-link me-2"></i>روابط سريعة
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('posts.index') }}">
                                    <i class="fas fa-chevron-left me-1"></i>الرئيسية
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>الأقسام
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>عن المدونة
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>اتصل بنا
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>سياسة الخصوصية
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>شروط الاستخدام
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5>
                            <i class="fas fa-th-large me-2"></i>الفئات
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>تقنية
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>برمجة
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>تصميم
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>تسويق رقمي
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>إدارة أعمال
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#">
                                    <i class="fas fa-chevron-left me-1"></i>تطوير ذاتي
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5>
                            <i class="fas fa-envelope me-2"></i>النشرة البريدية
                        </h5>
                        <p class="text-white-50 mb-3">
                            اشترك للحصول على أحدث المقالات والتحديثات مباشرة في بريدك الإلكتروني.
                        </p>
                        <form class="newsletter-form" action="#" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="بريدك الإلكتروني" required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr class="border-secondary my-4">

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="text-white-50 mb-0">
                            &copy; {{ date('Y') }} {{ config('app.name', 'المدونة') }}. جميع الحقوق محفوظة.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="text-white-50 mb-0">
                            صُمم بـ
                            <i class="fas fa-heart text-danger"></i>
                            باستخدام
                            <a href="https://laravel.com" target="_blank" class="text-white">Laravel</a> و
                            <a href="https://getbootstrap.com" target="_blank" class="text-white">Bootstrap</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
            // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Newsletter Form Handler
        document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const originalContent = button.innerHTML;
            button.innerHTML = '<span class="loading"></span> جاري الإرسال...';
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check"></i> تم الاشتراك!';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
                
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.disabled = false;
                    this.reset();
                }, 2000);
            }, 1500);
        });
        
        // Search Form Handler
        document.querySelector('form[action*="search"]')?.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="q"]');
            if (!searchInput.value.trim()) {
                e.preventDefault();
                searchInput.focus();
                searchInput.classList.add('is-invalid');
                setTimeout(() => {
                    searchInput.classList.remove('is-invalid');
                }, 2000);
            }
        });
        
        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Back to Top Button
        const backToTopBtn = document.createElement('button');
        backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        backToTopBtn.className = 'btn btn-primary back-to-top';
        backToTopBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        document.body.appendChild(backToTopBtn);
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert) {
                    alert.remove();
                }
            });
        }, 5000);
        </script>

        <!-- Additional Page Specific Scripts -->
        @yield('scripts')
    </body>

</html>