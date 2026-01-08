<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Bootstrap Css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
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
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(10px);
                background-color: rgba(255, 255, 255, 0.95);
            }

            .logo-container {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <div class="min-vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <!-- Logo -->
                        <div class="text-center mb-4 logo-container">
                            <a href="{{ route('posts.index') }}" class="text-decoration-none">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-lg" style="width: 80px; height: 80px;">
                                    <i class="fas fa-blog text-primary fs-1"></i>
                                </div>
                                <h1 class="text-white fw-bold mt-3 mb-0">المدونة</h1>
                            </a>
                        </div>

                        <!-- Form Card -->
                        <div class="card">
                            <div class="card-body p-4 p-md-5">
                                {{ $slot }}
                            </div>
                        </div>

                        <!-- Footer Links -->
                        <div class="text-center mt-4">
                            <p class="text-white-50 mb-2">
                                &copy; 2024 المدونة. جميع الحقوق محفوظة.
                            </p>
                            <div class="d-flex justify-content-center gap-3">
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
                </div>
            </div>
        </div>

        <!-- Bootstrap Js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>