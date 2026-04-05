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
                <a href="{{ route('admin.income.list') }}" class="btn btn-danger">Income List</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>ID</th><td>{{ $income->id }}</td></tr>
                    <tr><th>Client</th><td>{{ $income->client->client_name ?? 'N/A' }}</td></tr>
                    <tr><th>Income Category</th><td>{{ $income->income_category ?? 'N/A' }}</td></tr>
                    <tr><th>Total Amount</th><td>{{ number_format($income->total_amount,2) }}</td></tr>
                    <tr><th>Payment Amount</th><td>{{ number_format($income->payment_amount,2) }}</td></tr>
                    <tr><th>Due Amount</th><td>{{ number_format($income->due_amount,2) }}</td></tr>
                    <tr><th>Date</th><td>{{ $income->date ? $income->date->format('d M Y') : 'N/A' }}</td></tr>
                    <tr><th>Payment Date</th><td>{{ $income->payment_date ? $income->payment_date->format('d M Y') : 'N/A' }}</td></tr>
                    <tr><th>Payment Method</th><td>{{ $income->payment_method ?? 'N/A' }}</td></tr>
                    <tr><th>Received By</th><td>{{ $income->received_by ?? 'N/A' }}</td></tr>
                    <tr><th>Comments</th><td>{{ $income->comments ?? 'N/A' }}</td></tr>
                    <tr><th>Created At</th><td>{{ $income->created_at->format('d M Y h:i A') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection