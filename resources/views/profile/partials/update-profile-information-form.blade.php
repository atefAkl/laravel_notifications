<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <!-- Name -->
    <div class="mb-4">
        <label for="name" class="form-label fw-semibold">
            <i class="fas fa-user me-1"></i>الاسم
        </label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus
            autocomplete="name">
        @error('name')
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="form-label fw-semibold">
            <i class="fas fa-envelope me-1"></i>البريد الإلكتروني
        </label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required
            autocomplete="username">
        @error('email')
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>تنبيه:</strong> بريدك الإلكتروني غير موثق.

            <button form="send-verification" class="btn btn-sm btn-outline-warning me-2">
                <i class="fas fa-paper-plane me-1"></i>إعادة إرسال رابط التحقق
            </button>
        </div>

        @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success mt-2">
            <i class="fas fa-check-circle me-2"></i>
            تم إرسال رابط تحقيق جديد إلى بريدك الإلكتروني.
        </div>
        @endif
        @endif
    </div>

    <!-- Submit Button -->
    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>حفظ التغييرات
        </button>

        @if (session('status') === 'profile-updated')
        <div class="alert alert-success mb-0 py-2 px-3">
            <i class="fas fa-check-circle me-1"></i>تم الحفظ بنجاح!
        </div>
        @endif
    </div>
</form>