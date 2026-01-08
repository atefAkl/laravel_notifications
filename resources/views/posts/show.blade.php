@extends('layouts.frontend')

@section('title', $post->title . ' - المدونة')
@section('description', Str::limit(strip_tags($post->content), 160))
@section('keywords', $post->tags->pluck('name')->implode(', '))
@section('og-type', 'article')
@section('og-image', $post->featured_image ? asset('storage/featured_images/' . $post->featured_image) : asset('images/default-og.jpg'))

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('posts.index') }}">
                    <i class="fas fa-home me-1"></i>الرئيسية
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        </ol>
    </div>
</nav>

<!-- Article Header -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <!-- Title -->
                        <h1 class="display-5 fw-bold mb-4">{{ $post->title }}</h1>

                        <!-- Article Meta -->
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $post->user->name }}</h6>
                                    <small class="text-muted">{{ $post->user->email }}</small>
                                </div>
                            </div>

                            <!-- Tags -->
                            @if($post->tags->count() > 0)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                <a href="{{ route('posts.byTag', $tag) }}" class="badge bg-light text-dark text-decoration-none">
                                    {{ $tag->name }}
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Featured Image -->
                        @if($post->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/featured_images/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid w-100 rounded shadow"
                                style="max-height: 500px; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Article Content -->
                        <div class="article-content mb-5">
                            {!! $post->content !!}
                        </div>

                        <!-- Article Actions -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-3">
                                    <!-- Like/Share Buttons -->
                                    @auth
                                    <form action="{{ route('likes.togglePost', $post) }}" method="POST" class="d-inline" id="like-form">
                                        @csrf
                                        <button type="submit" class="btn {{ Auth::user()->hasLikedPost($post) ? 'btn-primary' : 'btn-outline-primary' }}" id="like-btn">
                                            <i class="{{ Auth::user()->hasLikedPost($post) ? 'fas' : 'far' }} fa-heart me-1" id="like-icon"></i>
                                            <span id="like-count">{{ $post->likes->count() ?? 0 }}</span> إعجاب
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-outline-primary" disabled>
                                        <i class="far fa-heart me-1"></i>
                                        {{ $post->likes->count() ?? 0 }} إعجاب
                                    </button>
                                    @endif

                                    <button class="btn btn-outline-secondary" onclick="sharePost()">
                                        <i class="fas fa-share me-1"></i>
                                        مشاركة
                                    </button>
                                </div>
                                @auth
                                @if(Auth::user()->canEditPost($post))
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-warning">
                                        <i class="fas fa-edit me-1"></i>تعديل
                                    </a>
                                    <form action="{{ route('posts.toggleStatus', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn {{ $post->isPublished() ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                            <i class="fas {{ $post->isPublished() ? 'fa-pause' : 'fa-play' }} me-1"></i>
                                            {{ $post->isPublished() ? 'إيقاف' : 'نشر' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash me-1"></i>حذف
                                        </button>
                                    </form>
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Quick Comment Form -->
                @auth
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-comment-dots me-2"></i>أضف تعليقك السريع
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">اكتب تعليقك على هذا المقال</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control" name="content" rows="3" placeholder="شاركنا رأيك..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    التعليقات تعرض بعد الموافقة عليها
                                </small>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>نشر التعليق
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                        <h5 class="mb-3">شاركنا رأيك!</h5>
                        <p class="mb-4">يجب <a href="{{ route('login') }}" class="btn btn-primary">تسجيل الدخول</a> أو <a href="{{ route('register') }}"
                                class="btn btn-outline-primary">إنشاء حساب جديد</a> لإضافة تعليق</p>
                    </div>
                </div>
                @endif

                <!-- Comments Section -->
                @if($post->comments_enabled)
                <div class="card mt-5">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-comments me-2"></i>التعليقات ({{ $post->comments()->where('is_approved', true)->count() }})
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <!-- Add Comment Form -->
                        @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-5">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">أضف تعليقك</h5>
                                    <small class="text-muted">{{ Auth::user()->name }}</small>
                                </div>
                            </div>

                            <div class="mb-4">
                                <textarea class="form-control" name="content" rows="4" placeholder="اكتب تعليقك هنا..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>نشر التعليق
                            </button>
                        </form>
                        @else
                        <div class="alert alert-info text-center mb-5">
                            <i class="fas fa-info-circle me-2"></i>
                            يجب <a href="{{ route('login') }}" class="alert-link">تسجيل الدخول</a>
                            أو <a href="{{ route('register') }}" class="alert-link">إنشاء حساب جديد</a>
                            لإضافة تعليق
                        </div>
                        @endif

                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse($post->comments()->whereNull('parent_id')->where('is_approved', true)->orderBy('created_at', 'desc')->get() as $comment)
                            <div class="comment mb-4" id="comment-{{ $comment->id }}">
                                <div class="d-flex">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px; flex-shrink: 0;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="bg-light p-3 rounded-3">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="mb-1 fw-bold">{{ $comment->user->name }}</h6>
                                                    <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                                                </div>

                                                @auth
                                                @if($comment->canBeEditedBy(Auth::user()))
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline-primary">تعديل</button>
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                                    </form>
                                                </div>
                                                @endif
                                                @endauth
                                            </div>

                                            <div class="mb-2">{{ $comment->content }}</div>

                                            <!-- Reply Button -->
                                            @auth
                                            <button class="btn btn-sm btn-outline-secondary mt-2" onclick="toggleReplyForm({{ $comment->id }})">
                                                <i class="fas fa-reply me-1"></i>رد
                                            </button>
                                            @endif

                                            <!-- Reply Form -->
                                            <div id="reply-form-{{ $comment->id }}" class="reply-form mt-3" style="display: none;">
                                                <form action="{{ route('comments.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                                    <div class="mb-2">
                                                        <textarea class="form-control" name="content" rows="3" placeholder="اكتب ردك هنا..." required></textarea>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-paper-plane me-1"></i>نشر الرد
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="toggleReplyForm({{ $comment->id }})">
                                                            إلغاء
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Replies -->
                                            @if($comment->replies->count() > 0)
                                            <div class="replies mt-3 me-4">
                                                @foreach($comment->approvedReplies as $reply)
                                                <div class="comment mb-3">
                                                    <div class="d-flex">
                                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                            style="width: 30px; height: 30px; flex-shrink: 0;">
                                                            <i class="fas fa-user fa-sm"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="bg-light p-2 rounded-3">
                                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                                    <h6 class="mb-0 fw-bold small">{{ $reply->user->name }}</h6>
                                                                    <small class="text-muted">{{ $reply->created_at->format('Y-m-d H:i') }}</small>
                                                                </div>
                                                                <p class="mb-0 small">{{ $reply->content }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5>لا توجد تعليقات بعد</h5>
                                <p class="text-muted mb-0">كن أول من يعلق على هذا المقال!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Author Info -->
                <div class="card mb-4" data-aos="fade-left">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>عن الكاتب
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                        <h5 class="card-title">{{ $post->user->name }}</h5>
                        <p class="card-text text-muted">{{ $post->user->bio ?? 'كاتب محتوى' }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                <div class="card mb-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-newspaper me-2"></i>مقالات ذات صلة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($relatedPosts->take(5) as $relatedPost)
                            <a href="{{ route('posts.show', $relatedPost) }}" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex">
                                    @if($relatedPost->featured_image)
                                    <img src="{{ asset('storage/featured_images/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="rounded me-3"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ Str::limit($relatedPost->title, 50) }}</h6>
                                        <small class="text-muted">{{ $relatedPost->created_at->format('Y-m-d') }}</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Categories Widget -->
                <div class="card mb-4" data-aos="fade-left" data-aos-delay="200">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-th-large me-2"></i>الفئات
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-laptop-code me-2"></i>برمجة
                                <span class="badge bg-primary float-start">12</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-palette me-2"></i>تصميم
                                <span class="badge bg-primary float-start">8</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-bullhorn me-2"></i>تسويق
                                <span class="badge bg-primary float-start">6</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Widget -->
                <div class="card" data-aos="fade-left" data-aos-delay="300">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>النشرة البريدية
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">اشترك للحصول على أحدث المقالات والتحديثات.</p>
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="بريدك الإلكتروني" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-paper-plane me-2"></i>اشترك الآن
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .article-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--border-radius);
        margin: 1.5rem 0;
    }

    .article-content blockquote {
        border-right: 4px solid var(--primary-color);
        padding-right: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6b7280;
    }

    .article-content ul,
    .article-content ol {
        margin: 1.5rem 0;
        padding-right: 2rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .article-content code {
        background: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-family: 'Courier New', monospace;
    }

    .article-content pre {
        background: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: var(--border-radius);
        overflow-x: auto;
        margin: 1.5rem 0;
    }

    .comment {
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .replies {
        border-right: 2px solid #e5e7eb;
        padding-right: 1rem;
    }
</style>

<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById(`reply-form-${commentId}`);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        
        if (form.style.display === 'block') {
            form.querySelector('textarea').focus();
        }
    }

    // Handle like form submission with AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const likeForm = document.getElementById('like-form');
        if (likeForm) {
            likeForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const likeBtn = document.getElementById('like-btn');
                const likeIcon = document.getElementById('like-icon');
                const likeCount = document.getElementById('like-count');
                
                // Show loading state
                likeBtn.disabled = true;
                likeBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> جاري التحميل...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update like count
                        likeCount.textContent = data.likes_count;
                        
                        // Toggle like button state
                        if (data.liked) {
                            likeBtn.classList.remove('btn-outline-primary');
                            likeBtn.classList.add('btn-primary');
                            likeIcon.classList.remove('far');
                            likeIcon.classList.add('fas');
                        } else {
                            likeBtn.classList.remove('btn-primary');
                            likeBtn.classList.add('btn-outline-primary');
                            likeIcon.classList.remove('fas');
                            likeIcon.classList.add('far');
                        }
                    } else {
                        // Show error message
                        alert(data.message || 'حدث خطأ ما. يرجى المحاولة مرة أخرى.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.');
                })
                .finally(() => {
                    // Restore button state
                    likeBtn.disabled = false;
                    likeBtn.innerHTML = `<i class="${likeIcon.className} me-1"></i><span id="like-count">${likeCount.textContent}</span> إعجاب`;
                });
            });
        }
    });

    // Share post functionality
    function sharePost() {
        const url = window.location.href;
        const title = document.querySelector('h1').textContent;
        
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            }).catch(err => console.log('Error sharing:', err));
        } else {
            // Fallback: Copy to clipboard
            navigator.clipboard.writeText(url).then(() => {
                // Show toast notification
                showToast('تم نسخ الرابط إلى الحافظة!');
            }).catch(err => {
                // Fallback: Show modal with URL
                prompt('انسخ هذا الرابط:', url);
            });
        }
    }

    // Toast notification function
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.style.zIndex = '1050';
        toast.innerHTML = `
            <div class="toast show" role="alert">
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Smooth scroll to comments
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('scroll') === 'comments') {
            const commentsSection = document.querySelector('.comments-list');
            if (commentsSection) {
                commentsSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
</script>
@endsection