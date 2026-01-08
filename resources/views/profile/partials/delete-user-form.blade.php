<!-- Warning Message -->
<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <strong>تحذير:</strong> بمجرد حذف حسابك، سيتم حذف جميع بياناتك ومواردك بشكل دائم. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
</div>

<!-- Delete Button -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
    <i class="fas fa-trash-alt me-1"></i>حذف الحساب
</button>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>تأكيد حذف الحساب
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-body">
                    <p class="mb-3">
                        <strong>هل أنت متأكد من أنك تريد حذف حسابك؟</strong>
                    </p>

                    <p class="text-muted">
                        بمجرد حذف حسابك، سيتم حذف جميع بياناتك ومواردك بشكل دائم. يرجى إدخال كلمة المرور لتأكيد رغبتك في حذف حسابك بشكل دائم.
                    </p>

                    <div class="mt-4">
                        <label for="delete_password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-1"></i>كلمة المرور
                        </label>
                        <input type="password" class="form-control @error('userDeletion.password') is-invalid @enderror" id="delete_password" name="password"
                            placeholder="أدخل كلمة المرور">
                        @error('userDeletion.password')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>إلغاء
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i>حذف الحساب نهائياً
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>