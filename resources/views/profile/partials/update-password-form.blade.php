<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div class="mb-4">
        <label for="update_password_current_password" class="form-label fw-semibold">
            <i class="fas fa-lock me-1"></i>كلمة المرور الحالية
        </label>
        <input type="password" class="form-control @error('updatePassword.current_password') is-invalid @enderror" id="update_password_current_password" name="current_password"
            autocomplete="current-password">
        @error('updatePassword.current_password')
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>

    <!-- New Password -->
    <div class="mb-4">
        <label for="update_password_password" class="form-label fw-semibold">
            <i class="fas fa-key me-1"></i>كلمة المرور الجديدة
        </label>
        <input type="password" class="form-control @error('updatePassword.password') is-invalid @enderror" id="update_password_password" name="password"
            autocomplete="new-password">
        <small class="form-text text-muted">تأكد من استخدام كلمة مرور قوية وآمنة</small>
        @error('updatePassword.password')
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label for="update_password_password_confirmation" class="form-label fw-semibold">
            <i class="fas fa-check me-1"></i>تأكيد كلمة المرور
        </label>
        <input type="password" class="form-control @error('updatePassword.password_confirmation') is-invalid @enderror" id="update_password_password_confirmation"
            name="password_confirmation" autocomplete="new-password">
        @error('updatePassword.password_confirmation')
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>تحديث كلمة المرور
        </button>

        @if (session('status') === 'password-updated')
        <div class="alert alert-success mb-0 py-2 px-3">
            <i class="fas fa-check-circle me-1"></i>تم تحديث كلمة المرور بنجاح!
        </div>
        @endif
    </div>
</form>