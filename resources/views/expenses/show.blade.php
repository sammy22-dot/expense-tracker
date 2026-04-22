@extends('layouts.app')

@section('title', 'Expense Details')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Expense Details</h1>
            <div>
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Basic Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td>{{ $expense->date->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{{ $expense->description ?? 'No description' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Category:</strong></td>
                                <td>
                                    <span class="badge fs-6" style="background-color: {{ $expense->category->color }}">
                                        {{ $expense->category->name }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td>
                                    ₱{{ number_format($expense->amount, 2) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Additional Details</h5>
                        <p class="text-muted">
                            <strong>Created:</strong> {{ $expense->created_at->format('M d, Y h:i A') }}<br>
                            <strong>Last Updated:</strong> {{ $expense->updated_at->format('M d, Y h:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body text-center">
                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="bi bi-trash"></i> Delete This Expense
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection