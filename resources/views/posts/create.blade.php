@extends('layouts.frontend')

@section('title', 'إنشاء مقال جديد - المدونة')
@section('description', 'إنشاء مقال جديد في مدونتنا')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-5 fw-bold mb-4" data-aos="fade-up">
                <i class="fas fa-pen me-3"></i>إنشاء مقال جديد
            </h1>
            <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">
                شارك معرفتك وخبراتك مع المجتمع
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
                            <i class="fas fa-edit me-2"></i>معلومات المقال
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">
                                    <i class="fas fa-heading me-1"></i>عنوان المقال
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}"
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
                                    placeholder="أدخل ملخص قصير للمقال (اختياري)">{{ old('excerpt') }}</textarea>
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
                                    required>{{ old('content') }}</textarea>
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
                                    @endphp
                                    @foreach($tags as $tag)
                                    <div class="col-md-6 col-lg-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', []))) checked
                                            @endif
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
                                            <input class="form-check-input" type="radio" name="status" id="draft" value="draft" checked>
                                            <label class="form-check-label" for="draft">
                                                <i class="fas fa-edit me-1"></i>مسودة
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="published" value="published">
                                            <label class="form-check-label" for="published">
                                                <i class="fas fa-globe me-1"></i>منشور
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="scheduled" value="scheduled">
                                            <label class="form-check-label" for="scheduled">
                                                <i class="fas fa-clock me-1"></i>مجدول
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

                            <!-- SEO Settings -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-search me-2"></i>إعدادات SEO
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="seo_title" class="form-label">
                                            عنوان SEO
                                        </label>
                                        <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title') }}"
                                            placeholder="عنوان المقال لمحركات البحث">
                                        <small class="form-text text-muted">
                                            60 حرف كحد أقصى
                                        </small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="seo_description" class="form-label">
                                            وصف SEO
                                        </label>
                                        <textarea class="form-control" id="seo_description" name="seo_description" rows="2"
                                            placeholder="وصف المقال لمحركات البحث">{{ old('seo_description') }}</textarea>
                                        <small class="form-text text-muted">
                                            160 حرف كحد أقصى
                                        </small>
                                    </div>
                                </div>
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
                                    <button type="submit" name="publish" value="1" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-1"></i>نشر المقال
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Writing Tips -->
                <div class="card border-0 shadow mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-lightbulb me-2"></i>نصائح للكتابة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-check-circle me-1"></i>العنوان الجذاب
                                </h6>
                                <p class="text-muted small mb-0">
                                    استخدم عنواناً قصيراً وجذاباً يلفت انتباه القارئ
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-success">
                                    <i class="fas fa-check-circle me-1"></i>المحتوى المنظم
                                </h6>
                                <p class="text-muted small mb-0">
                                    قسّم المحتوى إلى فقرات قصيرة مع عناوين فرعية
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-warning">
                                    <i class="fas fa-check-circle me-1"></i>الصور الجذابة
                                </h6>
                                <p class="text-muted small mb-0">
                                    أضف صوراً عالية الجودة لدعم المحتوى
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-danger">
                                    <i class="fas fa-check-circle me-1"></i>الوسوم المناسبة
                                </h6>
                                <p class="text-muted small mb-0">
                                    اختر وسوماً ذات صلة بالمحتوى لزيادة الوصول
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Stats -->
                <div class="card mb-4" data-aos="fade-left">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>إحصائيات سريعة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">مقالاتك</span>
                            <span class="fw-bold">{{ Auth::user()->posts()->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">المسودات</span>
                            <span class="fw-bold">{{ Auth::user()->posts()->where('status', 'draft')->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">المنشورة</span>
                            <span class="fw-bold">{{ Auth::user()->posts()->where('status', 'published')->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">المشاهدات</span>
                            <span class="fw-bold">{{ Auth::user()->posts()->sum('views') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Drafts -->
                <div class="card mb-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-file-alt me-2"></i>المسودات الأخيرة
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                        $recentDrafts = Auth::user()->posts()->where('status', 'draft')->latest()->take(5)->get();
                        @endphp
                        @if($recentDrafts->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentDrafts as $draft)
                            <a href="{{ route('posts.edit', $draft) }}" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ Str::limit($draft->title, 30) }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $draft->updated_at->format('Y-m-d H:i') }}
                                        </small>
                                    </div>
                                    <i class="fas fa-edit text-muted"></i>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-3">
                            <i class="fas fa-file-alt fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">لا توجد مسودات</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Guidelines -->
                <div class="card" data-aos="fade-left" data-aos-delay="200">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-rules me-2"></i>قواعد النشر
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>تنبيه:</strong> يجب الالتزام بالقواعد التالية
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                المحتوى يجب أن يكون أصلياً
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                احترام حقوق الملكية الفكرية
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                تجنب المحتوى المسيء أو غير اللائق
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                استخدام لغة عربية فصحى
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>
                                التدقيق اللغوي قبل النشر
                            </li>
                        </ul>
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

// Auto-generate SEO fields
document.getElementById('title')?.addEventListener('input', function() {
    const seoTitle = document.getElementById('seo_title');
    if (!seoTitle.value) {
        seoTitle.value = this.value;
    }
});

document.getElementById('excerpt')?.addEventListener('input', function() {
    const seoDesc = document.getElementById('seo_description');
    if (!seoDesc.value) {
        seoDesc.value = this.value;
    }
});
</script>
@endsection