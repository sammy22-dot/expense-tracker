@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h1 class="mb-0">
                    <i class="bi bi-people-fill me-2"></i>About Us
                </h1>
            </div>
            <div class="card-body p-5">
                <p class="lead text-center mb-5">
                    A modern, responsive expense tracking application built using Laravel and Bootstrap 5.
                </p>

                @php
                $team = [
                [
                'name' => 'SAM LLOYD H. CHAVEZ',
                'role' => 'Lead Developer',
                'image' => 'chavez.jpg',
                'color' => 'primary',
                'icon' => 'bi-person-circle',
                'desc' => 'Developed using Laravel with AI-assisted development'
                ],
                [
                'name' => 'KESIAH DENISE DE VICENTE',
                'role' => 'UI/UX Designer',
                'image' => 'de-vicente.jpg',
                'color' => 'info',
                'icon' => 'bi-palette',
                'desc' => 'Modern responsive, user-friendly, mobile-first design'
                ],
                [
                'name' => 'JOHN MARK C. CASTILLO',
                'role' => 'Database Administrator',
                'image' => 'castillo.jpg',
                'color' => 'success',
                'icon' => 'bi-database',
                'desc' => 'Optimized schema design, migrations, and data integrity'
                ]
                ];
                @endphp

                <style>
                    /* Card */
                    .team-card {
                        padding: 1.5rem;
                        border-radius: 12px;
                        transition: all 0.3s ease;
                    }

                    .team-card:hover {
                        transform: translateY(-5px);
                    }

                    /* Avatar container */
                    .avatar {
                        width: 120px;
                        height: 120px;
                        position: relative;
                    }

                    /* Image */
                    .avatar-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border-radius: 50%;
                        display: block;
                    }

                    /* Fallback icon */
                    .avatar-fallback {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        font-size: 3rem;
                    }
                </style>

                <div class="row g-4 mb-5">
                    @foreach($team as $member)
                    <div class="col-md-4">
                        <div class="team-card text-center h-100">

                            <!-- Avatar -->
                            <div class="avatar mx-auto mb-3">
                                <img src="{{ asset('images/' . $member['image']) }}"
                                    alt="{{ $member['name'] }}"
                                    class="avatar-img"
                                    onerror="this.style.display='none'; this.nextElementSibling.classList.remove('d-none');">

                                <!-- Fallback Icon -->
                                <i class="bi {{ $member['icon'] }} avatar-fallback text-{{ $member['color'] }} d-none"></i>
                            </div>

                            <!-- Role -->
                            <h6 class="fw-bold text-{{ $member['color'] }} mb-1">
                                {{ $member['role'] }}
                            </h6>

                            <!-- Name -->
                            <p class="text-muted mb-2">{{ $member['name'] }}</p>

                            <!-- Description -->
                            <p class="small text-secondary mb-0">
                                {{ $member['desc'] }}
                            </p>

                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Objectives -->
                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h3 class="fw-bold text-center mb-4">
                            <i class="bi bi-bullseye me-3 text-primary"></i>Our Objectives
                        </h3>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-check-circle-fill display-4 text-success mb-3"></i>
                                        <h5 class="fw-bold mb-2">Simple Tracking</h5>
                                        <p class="text-muted">Easy expense categorization and monitoring for personal finance management.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-phone display-4 text-info mb-3"></i>
                                        <h5 class="fw-bold mb-2">Mobile-First</h5>
                                        <p class="text-muted">Fully responsive design optimized for smartphones and tablets.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                                        <h5 class="fw-bold mb-2">Secure & Private</h5>
                                        <p class="text-muted">Data encrypted, user authentication, no third-party tracking.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contacts -->
                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-bold text-center mb-4">
                            <i class="bi bi-telephone me-3 text-success"></i>Contact Us
                        </h3>
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-envelope display-4 text-primary mb-3"></i>
                                        <h5 class="fw-bold mb-2">Email</h5>
                                        <p class="lead mb-0">support@expensetracker.com</p>
                                        <a href="mailto:support@expensetracker.com" class="btn btn-outline-primary mt-3">
                                            Send Message
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-github display-4 text-dark mb-3"></i>
                                        <h5 class="fw-bold mb-2">GitHub</h5>
                                        <p class="lead mb-0">github.com/expense-tracker</p>
                                        <a href="https://github.com" class="btn btn-outline-dark mt-3" target="_blank">
                                            View Repository
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-chat-dots display-4 text-info mb-3"></i>
                                        <h5 class="fw-bold mb-2">Support</h5>
                                        <p class="lead mb-0">Live chat coming soon</p>
                                        <button class="btn btn-outline-info mt-3 disabled">
                                            Chat Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection