@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h1 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Profile
                </h1>
            </div>
            <div class="card-body p-5">
                <!-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-12 mb-4">
                        <label for="avatar" class="form-label fw-bold fs-5">Profile Avatar</label>
                        <div class="position-relative">
                            <div class="current-avatar rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; background: #f8f9fa; border: 3px dashed #dee2e6; display: flex; align-items: center; justify-content: center;">
                                @if(Auth::user()->avatar)
                                <img id="currentAvatar" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Current" class="w-100 h-100 rounded-circle object-fit-cover" style="max-width: 100%; max-height: 100%;">
                                @else
                                <i class="bi bi-person-circle display-4 text-muted"></i>
                                @endif
                            </div>
                            <input type="file" class="form-control form-control-lg @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                            @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="preview-container mt-3 d-none">
                            <small>New image preview:</small>
                            <div class="rounded-circle overflow-hidden d-inline-block ms-2" style="width: 60px; height: 60px;">
                                <img id="avatarPreview" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        <div class="form-text">Upload new profile picture (Max 2MB, JPG/PNG/GIF)</div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label fw-bold fs-5">Full Name</label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required autofocus>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label fw-bold fs-5">Email Address</label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        <div class="col-12">
                            <label for="current_password" class="form-label fw-bold fs-6">Current Password <small class="text-muted">(Required for changes)</small></label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required autocomplete="current-password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#current_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold fs-6">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Leave blank to keep current password</div>
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-bold fs-6">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-between mt-5 pt-4 border-top">
                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-check-lg me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.querySelector(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });

        // Avatar preview
        const avatarInput = document.getElementById('avatar');
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('avatarPreview');
                        preview.src = e.target.result;
                        document.querySelector('.preview-container').classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection