@extends('layouts.frontend')

@section('title', 'تعديل مقال: ' . $post->title . ' - المدونة')
@section('description', 'تعديل مقال في مدونتنا')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-5 fw-bold mb-4" data-aos="fade-up">
                <i class="fas fa-edit me-3"></i>تعديل مقال
            </h1>
            <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">
                {{ Str::limit($post->title, 50) }}
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-edit me-2"></i>تعديل المقال: {{ Str::limit($post->title, 30) }}
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">
                                    <i class="fas fa-heading me-1"></i>عنوان المقال
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}"
                                    placeholder="أدخل عنوان المقال..." required>
                                @error('title')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="mb-4">
                                <label for="excerpt" class="form-label fw-semibold">
                                    <i class="fas fa-align-left me-1"></i>ملخص المقال
                                </label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3"
                                    placeholder="أدخل ملخص قصير للمقال (اختياري)">{{ old('excerpt', $post->excerpt) }}</textarea>
                                <small class="form-text text-muted">ملخص قصير يظهر في صفحة المقالات الرئيسية</small>
                                @error('excerpt')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Featured Image -->
                            <div class="mb-4">
                                <label for="featured_image" class="form-label fw-semibold">
                                    <i class="fas fa-image me-1"></i>الصورة الرئيسية
                                </label>
                                @if($post->featured_image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/featured_images/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-thumbnail"
                                        style="max-height: 200px;">
                                    <p class="form-text text-muted mt-2">الصورة الحالية</p>
                                </div>
                                @endif
                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" accept="image/*">
                                <small class="form-text text-muted">
                                    الصور المسموح بها: JPEG, PNG, JPG, GIF (الحد الأقصى: 2MB)
                                </small>
                                @error('featured_image')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-4">
                                <label for="content" class="form-label fw-semibold">
                                    <i class="fas fa-file-alt me-1"></i>محتوى المقال
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="15" placeholder="اكتب محتوى المقال هنا..."
                                    required>{{ old('content', $post->content) }}</textarea>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    يمكنك استخدام Markdown لتنسيق المحتوى
                                </small>
                                @error('content')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tags me-1"></i>الوسوم
                                </label>
                                <div class="row">
                                    @php
                                    $tags = \App\Models\Tag::all();
                                    $postTags = $post->tags->pluck('id')->toArray();
                                    @endphp
                                    @foreach($tags as $tag)
                                    <div class="col-md-6 col-lg-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', $postTags)))
                                            checked @endif
                                            id="tag_{{ $tag->id }}">
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('tags')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-eye me-1"></i>حالة المقال
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="draft" value="draft" @if(old('status', $post->status) === 'draft')
                                            checked @endif>
                                            <label class="form-check-label" for="draft">
                                                <i class="fas fa-edit me-1"></i>مسودة
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="published" value="published" @if(old('status', $post->status) ===
                                            'published') checked @endif>
                                            <label class="form-check-label" for="published">
                                                <i class="fas fa-globe me-1"></i>منشور
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="archived" value="archived" @if(old('status', $post->status) ===
                                            'archived') checked @endif>
                                            <label class="form-check-label" for="archived">
                                                <i class="fas fa-archive me-1"></i>مؤرشف
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('status')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between gap-3">
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-right me-1"></i>إلغاء
                                </a>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="save_draft" value="1" class="btn btn-outline-primary">
                                        <i class="fas fa-save me-1"></i>حفظ كمسودة
                                    </button>
                                    <button type="submit" name="update" value="1" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>تحديث المقال
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Article Stats -->
                <div class="card border-0 shadow mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>إحصائيات المقال
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $post->views ?? 0 }}</h4>
                                    <small class="text-muted">مشاهدة</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $post->likes_count ?? 0 }}</h4>
                                    <small class="text-muted">إعجاب</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-comments fa-2x text-success mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $post->comments_count ?? 0 }}</h4>
                                    <small class="text-muted">تعليق</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="bg-light rounded p-3">
                                    <i class="fas fa-share fa-2x text-info mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $post->shares ?? 0 }}</h4>
                                    <small class="text-muted">مشاركة</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card mb-4" data-aos="fade-left">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>إجراءات سريعة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>معاينة المقال
                            </a>
                            <button class="btn btn-outline-info" onclick="copyPostLink()">
                                <i class="fas fa-copy me-1"></i>نسخ الرابط
                            </button>
                            @if($post->status === 'published')
                            <form action="{{ route('posts.toggleStatus', $post) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-pause me-1"></i>إيقاف النشر
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-1"></i>حذف المقال
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Post Info -->
                <div class="card mb-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>معلومات المقال
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted">تاريخ الإنشاء</small>
                            <p class="mb-0 fw-bold">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">آخر تحديث</small>
                            <p class="mb-0 fw-bold">{{ $post->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">الحالة الحالية</small>
                            <p class="mb-0">
                                @if($post->status === 'published')
                                <span class="badge bg-success">منشور</span>
                                @elseif($post->status === 'draft')
                                <span class="badge bg-warning">مسودة</span>
                                @else
                                <span class="badge bg-secondary">مؤرشف</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <small class="text-muted">الكاتب</small>
                            <p class="mb-0 fw-bold">{{ $post->user->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- SEO Preview -->
                <div class="card mb-4" data-aos="fade-left" data-aos-delay="200">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-search me-2"></i>معاينة SEO
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="text-primary mb-1">{{ Str::limit($post->seo_title ?? $post->title, 60) }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($post->seo_description ?? $post->excerpt, 160) }}</p>
                            <p class="text-success small mb-0 mt-1">{{ url('/posts/' . $post->slug) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-check-input:checked+.form-check-label {
        color: var(--primary-color);
        font-weight: 600;
    }

    .card-header {
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    }
</style>

<script>
    // Character counters
document.getElementById('title')?.addEventListener('input', function() {
    const counter = document.getElementById('title-counter');
    if (!counter) {
        const counterDiv = document.createElement('small');
        counterDiv.id = 'title-counter';
        counterDiv.className = 'form-text text-muted';
        this.parentNode.appendChild(counterDiv);
    }
    document.getElementById('title-counter').textContent = `${this.value.length} حرف`;
});

document.getElementById('content')?.addEventListener('input', function() {
    const counter = document.getElementById('content-counter');
    if (!counter) {
        const counterDiv = document.createElement('small');
        counterDiv.id = 'content-counter';
        counterDiv.className = 'form-text text-muted';
        this.parentNode.appendChild(counterDiv);
    }
    document.getElementById('content-counter').textContent = `${this.value.length} حرف`;
});

// Copy post link
function copyPostLink() {
    const link = '{{ url('/posts/' . $post->slug) }}';
    navigator.clipboard.writeText(link).then(() => {
        alert('تم نسخ الرابط بنجاح!');
    });
}

// Auto-save draft
let autoSaveTimer;
function autoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        const form = document.querySelector('form');
        const formData = new FormData(form);
        formData.append('auto_save', '1');
        
        fetch('{{ route('posts.update', $post) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PUT'
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  console.log('تم الحفظ التلقائي');
              }
          });
    }, 30000); // Auto-save after 30 seconds of inactivity
}

document.getElementById('title')?.addEventListener('input', autoSave);
document.getElementById('content')?.addEventListener('input', autoSave);
</script>
@endsection