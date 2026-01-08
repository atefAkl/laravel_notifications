<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary fs-3" href="{{ route('dashboard') }}">
            <i class="fas fa-blog me-2"></i>المدونة
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
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>لوحة التحكم
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">
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
            </ul>

            <!-- Search -->
            <form class="d-flex me-3" action="{{ route('posts.search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" type="search" name="q" placeholder="البحث عن مقال...">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
        </div>
    </div>
</nav>