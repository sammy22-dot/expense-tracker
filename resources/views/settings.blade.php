@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h1 class="mb-0">
                    <i class="bi bi-gear-fill me-2"></i>Application Settings
                </h1>
            </div>
            <div class="card-body p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-info-circle me-2 text-primary"></i>App Information
                        </h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0 border-0">
                                <strong>Version:</strong> 1.0.0
                            </div>
                            <div class="list-group-item px-0 border-0">
                                <strong>Framework:</strong> Laravel {{ app()->version() }}
                            </div>
                            <div class="list-group-item px-0 border-0">
                                <strong>PHP:</strong> {{ phpversion() }}
                            </div>
                            <div class="list-group-item px-0 border-0">
                                <strong>Database:</strong> MySQL
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-currency-php me-2 text-success"></i>Currency Settings
                        </h5>
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fs-1">₱</span>
                                    </div>
                                    <div class="col">
                                        <label class="form-label fw-bold">Philippine Peso (PHP)</label>
                                        <small class="text-muted">Primary currency for all transactions</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-5">
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-shield-check me-2 text-success"></i>Security
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>CSRF Protection Enabled</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Authentication Required</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Data Encryption</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>SQL Injection Prevention</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-phone me-2 text-info"></i>Support
                        </h5>
                        <div class="d-flex flex-column gap-3">
                            <a href="mailto:support@expensetracker.com" class="btn btn-outline-primary">
                                <i class="bi bi-envelope me-2"></i>Contact Support
                            </a>
                            <button class="btn btn-outline-secondary" onclick="window.open('https://github.com', '_blank')">
                                <i class="bi bi-github me-2"></i>View on GitHub
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5 pt-4">
                    <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

