@extends('layouts.app')

@section('title', 'Add New Expense')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1 class="mb-4">Add New Expense</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control @error('date') is-invalid @enderror"
                            id="date"
                            name="date"
                            value="{{ old('date', now()->format('Y-m-d')) }}"
                            required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select
                            class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id"
                            name="category_id"
                            required>
                            <option value="">-- Select a category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control @error('amount') is-invalid @enderror"
                                id="amount"
                                name="amount"
                                placeholder="0.00"
                                value="{{ old('amount') }}"
                                required>
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Enter expense description...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection