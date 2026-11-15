{{-- Reusable Profile Photo Modal & Upload Component --}}
@auth
<div class="profile-photo-component">
    {{-- Hidden File Input triggered by any .trigger-change-photo element --}}
    <input type="file" 
           id="global-profile-photo-input" 
           accept="image/png, image/jpeg, image/jpg, image/webp, image/gif" 
           class="d-none" 
           aria-hidden="true">

    {{-- Bootstrap 5 Modal for Preview & Confirmation --}}
    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="profilePhotoModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content" style="border-radius: 16px; border: 1px solid rgba(99, 102, 241, 0.2); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden;">
                {{-- Modal Header --}}
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%); border-bottom: 1px solid rgba(99, 102, 241, 0.15); padding: 1.25rem 1.5rem;">
                    <h5 class="modal-title d-flex align-items-center fw-bolder" id="profilePhotoModalLabel" style="color: #1f2937; font-size: 1.15rem;">
                        <span class="avatar-icon-badge me-2 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 8px; color: #fff;">
                            <i data-feather="camera" style="width: 18px; height: 18px;"></i>
                        </span>
                        Change Profile Photo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="profilePhotoCloseBtn"></button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body p-3 text-center">
                    {{-- Alert Banner for Validation or Feedback --}}
                    <div id="profilePhotoAlert" class="alert alert-danger d-none py-2 px-3 text-start small mb-2" role="alert" style="border-radius: 8px;">
                        <span id="profilePhotoAlertMsg"></span>
                    </div>

                    {{-- Circular Preview Container --}}
                    <div class="position-relative d-inline-block my-2">
                        <div class="avatar-preview-wrapper" style="width: 140px; height: 140px; margin: 0 auto; border-radius: 50%; padding: 4px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); box-shadow: 0 8px 24px rgba(99, 102, 241, 0.25);">
                            <img id="profilePhotoPreviewImg" 
                                 src="{{ Auth::user()->avatar_url }}" 
                                 alt="Profile Preview" 
                                 class="rounded-circle w-100 h-100" 
                                 style="object-fit: cover; background-color: #f8fafc;" />
                        </div>
                        <span class="badge bg-primary position-absolute bottom-0 end-0 px-2 py-1 shadow-sm" style="border-radius: 12px; font-size: 0.72rem;">
                            Preview
                        </span>
                    </div>

                    {{-- Selected File Metadata --}}
                    <div id="profilePhotoFileInfo" class="mt-2 text-muted small">
                        <div class="fw-bold text-dark text-truncate px-3" id="profilePhotoFileName" style="max-width: 320px; margin: 0 auto;"></div>
                        <div id="profilePhotoFileSize" class="text-secondary"></div>
                    </div>

                    {{-- Quick Action to Pick Another File --}}
                    <div class="mt-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="profilePhotoPickOtherBtn" style="border-radius: 8px;">
                            <i data-feather="folder" style="width: 14px; height: 14px;" class="me-25"></i> Choose Different Image
                        </button>
                    </div>

                    <div class="text-muted small mt-2" style="font-size: 0.75rem;">
                        Supported formats: JPEG, PNG, JPG, WEBP, GIF (Max: 5MB)
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer d-flex justify-content-between" style="background: #f8fafc; border-top: 1px solid rgba(0, 0, 0, 0.05); padding: 1rem 1.5rem;">
                    <div>
                        @if(Auth::user()->avatar)
                        <button type="button" class="btn btn-outline-danger btn-sm" id="profilePhotoRemoveBtn" title="Remove custom photo and reset to default" style="border-radius: 8px;">
                            <i data-feather="trash-2" style="width: 14px; height: 14px;" class="me-25"></i> Remove
                        </button>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="profilePhotoCancelBtn" style="border-radius: 8px;">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center" id="profilePhotoSaveBtn" style="border-radius: 8px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                            <i data-feather="check" style="width: 14px; height: 14px;" class="me-50"></i>
                            <span id="profilePhotoSaveBtnText">Save Photo</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Modular Reusable Profile Photo Manager
 * Handles local file selection, instant client-side preview, validation, and AJAX upload.
 */
(function() {
    function initProfilePhotoManager() {
        const fileInput = document.getElementById('global-profile-photo-input');
        const modalEl = document.getElementById('profilePhotoModal');
        const previewImg = document.getElementById('profilePhotoPreviewImg');
        const fileNameEl = document.getElementById('profilePhotoFileName');
        const fileSizeEl = document.getElementById('profilePhotoFileSize');
        const alertBox = document.getElementById('profilePhotoAlert');
        const alertMsg = document.getElementById('profilePhotoAlertMsg');
        const saveBtn = document.getElementById('profilePhotoSaveBtn');
        const saveBtnText = document.getElementById('profilePhotoSaveBtnText');
        const cancelBtn = document.getElementById('profilePhotoCancelBtn');
        const closeBtn = document.getElementById('profilePhotoCloseBtn');
        const pickOtherBtn = document.getElementById('profilePhotoPickOtherBtn');
        const removeBtn = document.getElementById('profilePhotoRemoveBtn');

        if (!fileInput || !modalEl) return;

        let selectedFile = null;
        let objectUrl = null;
        const initialAvatarUrl = "{{ Auth::user()->avatar_url }}";
        const updateUrl = "{{ route('profile.photo.update') }}";
        const destroyUrl = "{{ route('profile.photo.destroy') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

        let bsModal = null;
        function getModal() {
            if (!bsModal && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
            }
            return bsModal;
        }

        function showAlert(msg) {
            if (alertBox && alertMsg) {
                alertMsg.textContent = msg;
                alertBox.classList.remove('d-none');
            }
            if (typeof toastr !== 'undefined') {
                toastr.error(msg, 'Error');
            }
        }

        function hideAlert() {
            if (alertBox) {
                alertBox.classList.add('d-none');
            }
        }

        function formatBytes(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function resetState() {
            selectedFile = null;
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }
            fileInput.value = '';
            if (previewImg) previewImg.src = initialAvatarUrl;
            if (fileNameEl) fileNameEl.textContent = '';
            if (fileSizeEl) fileSizeEl.textContent = '';
            hideAlert();
            setLoading(false);
        }

        function setLoading(isLoading) {
            if (!saveBtn) return;
            saveBtn.disabled = isLoading;
            if (cancelBtn) cancelBtn.disabled = isLoading;
            if (closeBtn) closeBtn.disabled = isLoading;
            if (pickOtherBtn) pickOtherBtn.disabled = isLoading;
            if (removeBtn) removeBtn.disabled = isLoading;

            if (isLoading) {
                saveBtnText.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Saving...';
            } else {
                saveBtnText.textContent = 'Save Photo';
            }
        }

        function updateAvatarsAcrossPage(newUrl) {
            const cacheBustedUrl = newUrl + (newUrl.indexOf('?') === -1 ? '?' : '&') + 't=' + new Date().getTime();
            document.querySelectorAll('.user-avatar-image, [data-user-avatar]').forEach(function(img) {
                img.src = cacheBustedUrl;
            });
            if (previewImg) previewImg.src = cacheBustedUrl;
        }

        function handleFileSelection(file) {
            if (!file) return;

            hideAlert();

            // Validate format
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
            if (!validTypes.includes(file.type.toLowerCase())) {
                showAlert('Please select a valid image file (JPEG, PNG, JPG, WEBP, or GIF).');
                fileInput.value = '';
                return;
            }

            // Validate size (max 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                showAlert('The selected image exceeds 5MB. Please choose a smaller image.');
                fileInput.value = '';
                return;
            }

            selectedFile = file;

            // Instant Client-side Preview
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
            }
            objectUrl = URL.createObjectURL(file);
            if (previewImg) {
                previewImg.src = objectUrl;
            }
            if (fileNameEl) {
                fileNameEl.textContent = file.name;
            }
            if (fileSizeEl) {
                fileSizeEl.textContent = formatBytes(file.size);
            }

            // Show the modal
            const modal = getModal();
            if (modal) {
                modal.show();
            } else if (typeof $ !== 'undefined') {
                $(modalEl).modal('show');
            }

            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Global trigger handler for any element with .trigger-change-photo
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.trigger-change-photo, [data-action="change-photo"]');
            if (trigger) {
                e.preventDefault();
                fileInput.click();
            }
        });

        // File input change handler
        fileInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files.length > 0) {
                handleFileSelection(e.target.files[0]);
            }
        });

        // Choose different image button
        if (pickOtherBtn) {
            pickOtherBtn.addEventListener('click', function() {
                fileInput.click();
            });
        }

        // Modal closed handler to clean up state
        modalEl.addEventListener('hidden.bs.modal', function() {
            resetState();
        });

        // Save Photo Handler
        saveBtn.addEventListener('click', function() {
            if (!selectedFile) {
                showAlert('Please select an image file first.');
                return;
            }

            setLoading(true);
            hideAlert();

            const formData = new FormData();
            formData.append('photo', selectedFile);
            formData.append('_token', csrfToken);

            fetch(updateUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(async function(response) {
                const data = await response.json();
                if (!response.ok) {
                    let errMsg = data.message || 'Failed to update profile photo.';
                    if (data.errors && data.errors.photo) {
                        errMsg = data.errors.photo[0];
                    }
                    throw new Error(errMsg);
                }
                return data;
            })
            .then(function(data) {
                setLoading(false);
                if (data.success && data.avatar_url) {
                    updateAvatarsAcrossPage(data.avatar_url);

                    const modal = getModal();
                    if (modal) {
                        modal.hide();
                    } else if (typeof $ !== 'undefined') {
                        $(modalEl).modal('hide');
                    }

                    if (typeof toastr !== 'undefined') {
                        toastr.success(data.message || 'Profile photo updated successfully!', 'Success');
                    }
                } else {
                    showAlert(data.message || 'An unexpected response was received.');
                }
            })
            .catch(function(err) {
                setLoading(false);
                showAlert(err.message || 'An error occurred while uploading your photo.');
            });
        });

        // Remove Photo Handler (if available)
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                if (!confirm('Are you sure you want to remove your profile picture and reset to default?')) {
                    return;
                }

                setLoading(true);
                hideAlert();

                fetch(destroyUrl, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(async function(response) {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to remove photo.');
                    }
                    return data;
                })
                .then(function(data) {
                    setLoading(false);
                    if (data.success && data.avatar_url) {
                        updateAvatarsAcrossPage(data.avatar_url);
                        removeBtn.style.display = 'none';

                        const modal = getModal();
                        if (modal) {
                            modal.hide();
                        } else if (typeof $ !== 'undefined') {
                            $(modalEl).modal('hide');
                        }

                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message || 'Profile photo reset to default.', 'Success');
                        }
                    } else {
                        showAlert(data.message || 'Failed to reset photo.');
                    }
                })
                .catch(function(err) {
                    setLoading(false);
                    showAlert(err.message || 'An error occurred while removing your photo.');
                });
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProfilePhotoManager);
    } else {
        initProfilePhotoManager();
    }
})();
</script>
@endauth
