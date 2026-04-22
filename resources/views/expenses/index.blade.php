@extends('layouts.app')

@section('title', 'Expenses Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
            <h1 class="mb-0">Dashboard</h1>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-lg ms-md-3">
                <i class="bi bi-plus"></i> Add New Expense
            </a>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column align-items-center text-center p-4">
                <i class="bi bi-wallet2 fs-1 text-primary mb-3"></i>
                <h6 class="card-title text-muted mb-2">Total Expenses</h6>
                <h3 class="card-text fw-bold text-primary mb-0">₱{{ number_format($totalAmount, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center text-center p-3 p-md-4">
                <i class="bi bi-list-ul fs-2 fs-md-1 text-success mb-2 mb-md-3"></i>
                <h6 class="card-title text-muted mb-1 mb-md-2 small">Total Records</h6>
                <h3 class="card-text fw-bold text-success mb-0">{{ $expenses->total() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="card h-100">
            <div class="card-body d-flex flex-column align-items-center text-center p-3 p-md-4">
                <i class="bi bi-graph-up fs-2 fs-md-1 text-info mb-2 mb-md-3"></i>
                <h6 class="card-title text-muted mb-1 mb-md-2 small">Average Expense</h6>
                <h3 class="card-text fw-bold text-info mb-0">₱{{ $expenses->total() > 0 ? number_format($totalAmount / $expenses->total(), 2) : '0.00' }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <i class="bi bi-calendar-month fs-2 text-warning mb-3"></i>
                <h6 class="card-title text-muted mb-2">This Month</h6>
                <h3 class="card-text fw-bold text-warning mb-0">₱{{ number_format($currentMonthExpenses ?? 0, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <i class="bi bi-tags fs-2 text-secondary mb-3"></i>
                <h6 class="card-title text-muted mb-2">Categories</h6>
                <h3 class="card-text fw-bold text-secondary mb-0">{{ $categories->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Category Filter -->
@if($categories->count() > 0)
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Filter by Category</h6>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel me-1"></i>{{ request('category') ? $categories->find(request('category'))?->name ?? 'Category' : 'All Categories' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item @if(!request('category')) active @endif" href="{{ route('expenses.index') }}">All Categories</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a class="dropdown-item @if(request('category') == $category->id) active @endif" href="{{ route('expenses.index', ['category' => $category->id]) }}">
                                <span class="badge me-2" style="background-color: {{ $category->color }}"></span>{{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endif

<!-- Expenses Table -->
<div class="row">
    <div class="col-md-12">
        @if($expenses->count() > 0)
        <div class="table-responsive">
            {{ $expenses->appends(request()->query()) }}
            <table class="table table-hover" aria-label="Expenses list">
                <caption class="sr-only">List of expenses with date, description, category, amount, and actions</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr class="align-middle">
                        <td>
                            <strong>{{ $expense->date->format('M d, Y') }}</strong>
                        </td>
                        <td>{{ $expense->description ?? 'N/A' }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $expense->category->color }}">
                                {{ $expense->category->name }}
                            </span>
                        </td>
                        <td>
                            ₱{{ number_format($expense->amount, 2) }}
                        </td>
                        <td>
                            <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteExpenseModal{{ $expense->id }}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteExpenseModal{{ $expense->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-4">Are you sure you want to delete "<strong>{{ $expense->description ?? 'this expense' }}</strong>"?</p>
                                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash me-2"></i>Yes, Delete
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3 p-3">
                {{ $expenses->links() }}
            </div>
        </div>
        @else
        <div class="alert alert-info text-center" role="alert">
            <i class="bi bi-inbox display-4 mb-4 opacity-75"></i>
            <h4 class="alert-heading">No expenses yet!</h4>
            <p class="mb-0">You haven't added any expenses yet. <a href="{{ route('expenses.create') }}" class="alert-link fw-bold">Create your first expense</a> to get started.</p>
        </div>
        @endif
    </div>
</div>
@endsection