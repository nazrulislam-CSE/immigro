@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <p class="card-title my-0">{{ $pageTitle }}</p>
                <a href="{{ route('admin.expense.list') }}" class="btn btn-danger">Expense List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.expense.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expense Category</label>
                            <input type="text" name="expense_category" class="form-control" placeholder="e.g., Rent, Utilities, Salary" value="{{ old('expense_category') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expense Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="expense_amount" class="form-control" required value="{{ old('expense_amount') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Method</label>
                            <input type="text" name="payment_method" class="form-control" placeholder="Cash, Bank, bKash..." value="{{ old('payment_method') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Paid By</label>
                            <input type="text" name="paid_by" class="form-control" placeholder="Person name" value="{{ old('paid_by') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" rows="2">{{ old('comments') }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save Expense</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection