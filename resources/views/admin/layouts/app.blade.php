<!DOCTYPE html>
<html lang="{{ session('locale', config('app.locale', 'ar')) }}" dir="{{ $dir ?? 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', 'Admin Dashboard') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-dark {
            background-color: #212b36;
        }

        .sidebar-item:hover {
            background-color: #2d3748;
        }

        .sidebar-item.active {
            background-color: #4a5568;
        }

        .card-custom {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .btn-primary-custom {
            background-color: #7c2d12;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: #92400e;
        }

        .btn-secondary-custom {
            background-color: #e5e7eb;
            color: #374151;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-secondary-custom:hover {
            background-color: #d1d5db;
        }

        .badge-offer {
            background-color: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .badge-active {
            background-color: #10b981;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .badge-inactive {
            background-color: #6b7280;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .action-btn-show {
            background-color: #3b82f6;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .action-btn-edit {
            background-color: #f59e0b;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .action-btn-delete {
            background-color: #ef4444;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div id="app" class="min-h-screen">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Left side - empty for balance -->
                    <div class="flex-1"></div>

                    <!-- Main Search Form -->
                    <div class="flex-1 max-w-lg mx-8">
                        <form class="relative">
                            <input type="text"
                                placeholder="{{ __('General search...') }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </form>
                    </div>

                    <!-- User Links -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>

                        <!-- Messages -->
                        <button class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                        </button>

                        <!-- Language Switch -->
                        <div class="relative">
                            <button onclick="toggleLanguageDropdown()" class="p-2 text-gray-600 hover:text-gray-900 transition-colors">
                                <i class="fas fa-globe text-xl"></i>
                                <span class="ml-1 text-sm">{{ strtoupper(session('locale', 'ar')) }}</span>
                            </button>
                            <div id="languageDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                <a href="{{ route('locale.switch', 'ar') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                                    <i class="fas fa-globe-asia mr-2"></i> العربية
                                </a>
                                <a href="{{ route('locale.switch', 'en') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg">
                                    <i class="fas fa-globe-americas mr-2"></i> English
                                </a>
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="relative">
                            <button onclick="toggleUserDropdown()" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>
                            <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i> {{ __('Profile') }}
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i> {{ __('Settings') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="flex pt-16">
            <!-- Sidebar -->
            <aside class="w-64 sidebar-dark h-screen fixed left-0 top-16">
                <div class="p-4">
                    <!-- Brand -->
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="bg-blue-600 text-white p-2 rounded-lg">
                            <i class="fas fa-store text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-white">{{ __('Date Palm Store') }}</span>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>{{ __('Users') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-box"></i>
                            <span>{{ __('Products') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-shopping-cart"></i>
                            <span>{{ __('Sales') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-receipt"></i>
                            <span>{{ __('Orders') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-tags"></i>
                            <span>{{ __('Offers') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-star"></i>
                            <span>{{ __('Reviews') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-chart-line"></i>
                            <span>{{ __('Financials') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-users-cog"></i>
                            <span>{{ __('Parties') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white sidebar-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>{{ __('Policies') }}</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Page Content -->
            <main class="flex-1 ml-64 p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>

        <!-- App Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 ml-64">
            <div class="px-6">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} {{ __('Date Palm Store') }}. {{ __('All rights reserved.') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Documentation') }}</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Support') }}</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">{{ __('API') }}</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const languageDropdown = document.getElementById('languageDropdown');
            languageDropdown.classList.add('hidden');
            dropdown.classList.toggle('hidden');
        }

        function toggleLanguageDropdown() {
            const dropdown = document.getElementById('languageDropdown');
            const userDropdown = document.getElementById('userDropdown');
            userDropdown.classList.add('hidden');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdown');
            const languageDropdown = document.getElementById('languageDropdown');

            if (!event.target.closest('[onclick*="toggleUserDropdown"]') && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }

            if (!event.target.closest('[onclick*="toggleLanguageDropdown"]') && !languageDropdown.contains(event.target)) {
                languageDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>