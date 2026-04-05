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
                <table class="table table-bordered">
                    <tr><th>ID</th><td>{{ $expense->id }}</td></tr>
                    <tr><th>Date</th><td>{{ $expense->date ? $expense->date->format('d M Y') : 'N/A' }}</td></tr>
                    <tr><th>Expense Category</th><td>{{ $expense->expense_category ?? 'N/A' }}</td></tr>
                    <tr><th>Expense Amount</th><td>{{ number_format($expense->expense_amount,2) }}</td></tr>
                    <tr><th>Payment Method</th><td>{{ $expense->payment_method ?? 'N/A' }}</td></tr>
                    <tr><th>Paid By</th><td>{{ $expense->paid_by ?? 'N/A' }}</td></tr>
                    <tr><th>Comments</th><td>{{ $expense->comments ?? 'N/A' }}</td></tr>
                    <tr><th>Created At</th><td>{{ $expense->created_at->format('d M Y h:i A') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection