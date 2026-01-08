@extends('layouts.frontend')

@section('title', 'تعديل مقال: - المدونة')
@section('description', 'تعديل مقال في مدونتنا')

@section('content')
<!-- Featured Posts -->
@if(isset($featuredPosts) && $featuredPosts->count() > 0) <section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">المقالات المميزة</h2>
            <p class="lead text-muted">أفضل المقالات المختارة بعناية</p>
        </div>
        <div class="row g-4">
            @foreach($featuredPosts as $post)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card post-card h-100">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/featured_images/' . $post->featured_image) }}" alt="{{ $post->title }}" class="card-img-top post-image">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-primary text-white" style="height: 200px;"><i class="fas fa-image fa-3x"></i></div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="post-meta mb-2">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $post->created_at->format('Y-m-d') }}

                            <span class="mx-2">•</span><i class="fas fa-user me-1"></i> {{ $post->user->name }}

                        </div>
                        <h5 class="post-title">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none"> {{ Str::limit($post->title, 60) }}
                            </a>
                        </h5>
                        <p class="post-excerpt flex-grow-1">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="d-flex gap-2">
                                @forelse($post->tags->take(2) as $tag)
                                <a href="{{ route('posts.byTag', $tag) }}" class="tag"> {{$tag->name}} </a>
                                @empty
                                ""
                                @endforelse
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">قراءة المزيد <i class="fas fa-arrow-left ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Latest Posts -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">أحدث المقالات</h2>
            <p class="lead text-muted">آخر ما تم نشره في مدونتنا</p>
        </div>
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card post-card h-100">
                    @if($post->featured_image) <img src="{{ asset('storage/featured_images/' . $post->featured_image) }}" alt="{{ $post->title }}" class="card-img-top post-image">
                    @else <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 200px;"><i
                            class="fas fa-newspaper fa-3x"></i></div>
                    @endif <div class="card-body d-flex flex-column">
                        <div class="post-meta mb-2"><i class="fas fa-calendar-alt me-1"></i>
                            {{$post->created_at->format('Y-m-d')}}

                            <span class="mx-2">•</span><i class="fas fa-user me-1"></i>
                            {{$post->user->name}}
                            <span class="mx-2">•</span><i class="fas fa-clock me-1"></i>
                            {{$post->reading_time ?? '5'}}
                            دقيقة
                        </div>
                        <h5 class="post-title"><a href="{{ route('posts.show', $post) }}" class="text-decoration-none"> {
                                {{Str::limit($post->title, 60)}}</a></h5>
                        <p class="post-excerpt flex-grow-1">

                            {{Str::limit(strip_tags($post->content), 120)}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="d-flex gap-2">

                                @forelse($post->tags->take(2) as $tag)
                                <a href="{{ route('posts.byTag', $tag) }}" class="tag">
                                    {{$tag->name}}
                                </a>
                                @empty
                                ""
                                @endforelse
                            </div><a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">قراءة المزيد <i class="fas fa-arrow-left ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>@endforeach
        </div>
        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            {{$posts->links()}}
        </div>@endif
    </div>
</section>
<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">الفئات</h2>
            <p class="lead text-muted">تصفح المقالات حسب الفئة</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3"><i class="fas fa-laptop-code fa-3x text-primary"></i></div>
                        <h5 class="card-title">برمجة</h5>
                        <p class="card-text text-muted">أحدث التقنيات وأفضل الممارسات في عالم البرمجة</p><a href="#" class="btn btn-outline-primary">تصفح الآن</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3"><i class="fas fa-palette fa-3x text-success"></i></div>
                        <h5 class="card-title">تصميم</h5>
                        <p class="card-text text-muted">التصميم الجرافيكي وتجربة المستخدم وواجهة الاستخدام</p><a href="#" class="btn btn-outline-success">تصفح الآن</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3"><i class="fas fa-bullhorn fa-3x text-warning"></i></div>
                        <h5 class="card-title">تسويق</h5>
                        <p class="card-text text-muted">التسويق الرقمي واستراتيجيات النمو</p><a href="#" class="btn btn-outline-warning">تصفح الآن</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3"><i class="fas fa-chart-line fa-3x text-info"></i></div>
                        <h5 class="card-title">أعمال</h5>
                        <p class="card-text text-muted">إدارة الأعمال وريادة الأعمال</p><a href="#" class="btn btn-outline-info">تصفح الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
< !-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg" data-aos="fade-up">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4"><i class="fas fa-envelope-open-text fa-4x text-primary"></i></div>
                            <h3 class="card-title mb-3">اشترك في نشرتنا البريدية</h3>
                            <p class="card-text text-muted mb-4">احصل على أحدث المقالات والتحديثات مباشرة في بريدك الإلكتروني. لا نرسل رسائل مزعجة ! </p>
                            <form class="row g-3 justify-content-center">
                                <div class="col-md-8"><input type="email" class="form-control form-control-lg" placeholder="أدخل بريدك الإلكتروني" required></div>
                                <div class="col-md-4"><button type="submit" class="btn btn-primary btn-lg w-100"><i class="fas fa-paper-plane me-2"></i>اشترك الآن
                                    </button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(session('success'))
    <script>
        alert('{{ session(' success') }}');
    </script>
    @endif
    @endsection