@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card shadow-lg border-0 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-5 position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-75"></div>
                <div class="position-relative">
                    <div class="row align-items-end">
                        <div class="col-auto ms-auto">
                            <div class="avatar rounded-circle mx-auto overflow-hidden position-relative" style="width: 120px; height: 120px; border: 4px solid rgba(255,255,255,0.5); background: rgba(255,255,255,0.2);">
                                @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                @else
                                <i class="bi bi-person-circle display-3 text-white position-absolute top-50 start-50 translate-middle"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <h1 class="display-5 fw-bold mb-1">{{ Auth::user()->name }}</h1>
                            <p class="lead mb-0 opacity-90">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-tabs mb-0" id="profileTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                            <i class="bi bi-person me-1"></i>Profile Info
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab">
                            <i class="bi bi-graph-up me-1"></i>Statistics
                        </button>
                    </li>
                </ul>

                <div class="tab-content p-4 p-xl-5">
                    <!-- Profile Info Tab -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <form>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control form-control-lg" id="name" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control form-control-lg" id="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="joined" class="form-label fw-bold">Member Since</label>
                                    <input type="text" class="form-control form-control-lg" id="joined" value="{{ Auth::user()->created_at->format('M d, Y') }} at {{ Auth::user()->created_at->format('g:i A') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Account Status</label>
                                    <span class="badge bg-success fs-6 px-3 py-2">Active</span>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-lg">
                                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                                        </a>
                                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                            <i class="bi bi-trash3 me-2"></i>Delete Account
                                        </button>
                                        <!-- Account Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteAccountModal" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">
                                                            <i class="bi bi-exclamation-octagon me-2"></i>Confirm Account Deletion
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-4 lead">This will <strong>permanently delete your account and all associated expenses</strong>.</p>
                                                        <div class="alert alert-warning">
                                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                                            <strong>Warning:</strong> All your expense data will be lost forever.
                                                        </div>
                                                        <p>Type your account email to confirm: <strong>{{ Auth::user()->email }}</strong></p>
                                                        <input type="email" class="form-control" id="confirmEmail" placeholder="Enter your email">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('profile.destroy') }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                                                                <i class="bi bi-trash3 me-2"></i>Delete My Account
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Statistics Tab -->
                    <div class="tab-pane fade" id="stats" role="tabpanel">
                        <div class="row g-4 text-center">
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body py-4">
                                        <i class="bi bi-wallet2 display-4 text-primary mb-3"></i>
                                        <h3 class="fw-bold text-primary">{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                                        <p class="text-muted mb-0">Total Expenses</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body py-4">
                                        <i class="bi bi-list-check display-4 text-success mb-3"></i>
                                        <h3 class="fw-bold text-success">{{ $totalRecords ?? 0 }}</h3>
                                        <p class="text-muted mb-0">Total Records</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body py-4">
                                        <i class="bi bi-clock-history display-4 text-info mb-3"></i>
                                        <h3 class="fw-bold text-info">{{ $accountAge ?? 'N/A' }}</h3>
                                        <p class="text-muted mb-0">Account Age</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light text-center py-4">
                <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth tab transitions
        const triggerTabList = document.querySelectorAll('#profileTab button');
        triggerTabList.forEach(triggerEl => {
            triggerEl.addEventListener('click', function(event) {
                const target = this.getAttribute('data-bs-target');
                const tabPane = document.querySelector(target);
                tabPane.classList.add('fade-in');
                setTimeout(() => tabPane.classList.remove('fade-in'), 300);
            });
        });
    });
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Email confirmation for delete
        const confirmEmail = document.getElementById('confirmEmail');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const userEmail = '{{ Auth::user()->email }}';

        if (confirmEmail && confirmBtn) {
            confirmEmail.addEventListener('input', function() {
                if (this.value === userEmail) {
                    confirmBtn.disabled = false;
                } else {
                    confirmBtn.disabled = true;
                }
            });
        }
    });
</script>
@endsection