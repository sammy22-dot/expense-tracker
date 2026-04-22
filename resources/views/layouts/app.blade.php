<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Expense Tracker')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --border-radius: 12px;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: var(--card-shadow);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: clamp(1.1rem, 4vw, 1.5rem);
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
        }

        @media (max-width: 991px) {
            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
            }
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border-radius: 10px;
            border: none;
            font-weight: 500;
            padding: 12px 24px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table th {
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .alert {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--card-shadow);
        }

        footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-top: 1px solid #e2e8f0;
        }

        /* Mobile Responsiveness */
        @media (max-width: 991px) {
            main {
                margin-top: 80px !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: clamp(1rem, 5vw, 1.25rem);
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .card-body {
                padding: 1.5rem !important;
            }

            h1 {
                font-size: 1.75rem;
                line-height: 1.2;
            }

            .btn-lg {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .row.g-0>div {
                margin-bottom: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .card-body i.fs-1 {
                font-size: 2rem !important;
            }

            .display-4 {
                font-size: 3rem !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid px-4 px-md-5">
            <a class="navbar-brand fw-bold" href="{{ route('expenses.index') }}">
                <i class="bi bi-wallet2 me-2"></i>Expense Tracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expenses.index') }}">
                            <i class="bi bi-house-door me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expenses.create') }}">
                            <i class="bi bi-plus-circle me-1"></i>Add Expense
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-2 rounded-pill bg-white bg-opacity-10" href="#" role="button" data-bs-toggle="dropdown" style="text-decoration: none; min-width: 200px;">
                            <div class="avatar rounded-circle overflow-hidden position-relative" style="width: 36px; height: 36px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.3);">
                                @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                @else
                                <i class="bi bi-person-circle fs-6 text-white position-absolute top-50 start-50 translate-middle"></i>
                                @endif
                            </div>
                            <div class="text-white flex-grow-1 d-none d-md-block">
                                <small class="d-block fw-medium">{{ Str::limit(Auth::user()->name, 15) }}</small>
                                <small class="opacity-75">{{ Str::limit(Auth::user()->email, 20) }}</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="min-width: 220px;">
                            <li><a class="dropdown-item fw-medium" href="{{ route('profile') }}"><i class="bi bi-person-circle me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <button type="button" class="dropdown-item w-100 text-start border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right me-2 text-danger"></i>Logout
                            </button>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title">
                        <i class="bi bi-box-arrow-right me-2"></i>Confirm Logout
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-shield-exclamation display-1 text-primary mb-3 opacity-75"></i>
                    <h5 class="mb-3">Are you sure you want to logout?</h5>
                    <p class="text-muted mb-4">You will need to login again to access your account.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary px-4 ms-2" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <main class="pt-5 mt-lg-5 pb-5">
        <div class="container px-3 px-md-4">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Validation Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="mt-auto py-4">
        <div class="container text-center px-4">
            <p class="text-muted mb-0">
                <i class="bi bi-shield-check me-1"></i>
                © 2026 Expense Tracker. Made with Laravel
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>