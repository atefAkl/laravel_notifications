<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>الملف الشخصي - المدونة</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet" />

        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        {{-- Bootstrap Css --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8f9fa;
            }

            .form-control:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #5a67d8 0%, #6b4199 100%);
                transform: translateY(-1px);
            }

            .card {
                border: none;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        <header class="bg-white shadow-sm sticky-top">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bold text-primary fs-3" href="{{ route('posts.index') }}">
                            <i class="fas fa-blog me-2"></i>المدونة
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('posts.index') }}">
                                        <i class="fas fa-home me-1"></i>الرئيسية
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-th-large me-1"></i>الأقسام</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i>عن المدونة</a>
                                </li>
                            </ul>

                            <div class="d-flex align-items-center gap-3">
                                <!-- Search -->
                                <form class="d-flex" action="{{ route('posts.search') }}" method="GET">
                                    <div class="input-group">
                                        <input class="form-control" type="search" name="q" placeholder="البحث عن مقال...">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>

                                <!-- User Menu -->
                                @auth
                                <div class="d-flex align-items-center gap-2">
                                    @if(Auth::user()->canCreatePost())
                                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>مقال جديد
                                    </a>
                                    @endif
                                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-tachometer-alt me-1"></i>لوحة التحكم
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none">
                                            <i class="fas fa-sign-out-alt me-1"></i>تسجيل الخروج
                                        </button>
                                    </form>
                                </div>
                                @else
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
                                @endauth
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h2 class="h3 fw-bold">
                            <i class="fas fa-user me-2"></i>الملف الشخصي
                        </h2>
                    </div>

                    <!-- Profile Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>معلومات الملف الشخصي
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-lock me-2"></i>تغيير كلمة المرور
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-trash-alt me-2"></i>حذف الحساب
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5 class="fw-bold mb-3">المدونة</h5>
                        <p class="text-white-50">منصة لمشاركة المعرفة والخبرات في مجالات التقنية والبرمجة</p>
                        <div class="mt-3">
                            <h6 class="fw-bold mb-3">تابعنا</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-white-50 text-decoration-none">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-white-50 text-decoration-none">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-white-50 text-decoration-none">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="text-white-50 text-decoration-none">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5 class="fw-bold mb-3">روابط سريعة</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">الرئيسية</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">الأقسام</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">عن المدونة</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5 class="fw-bold mb-3">الفئات</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">تقنية</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">برمجة</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">تصميم</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">تسويق</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <h5 class="fw-bold mb-3">النشرة البريدية</h5>
                        <p class="text-white-50 mb-3">اشترك للحصول على أحدث المقالات والتحديثات</p>
                        <form>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="بريدك الإلكتروني">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="border-secondary my-4">
                <div class="text-center text-white-50">
                    <p class="mb-0">&copy; 2024 المدونة. جميع الحقوق محفوظة.</p>
                </div>
            </div>
        </footer>

        {{-- Bootstrap Js --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        @if(session('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
        @endif
    </body>

</html>