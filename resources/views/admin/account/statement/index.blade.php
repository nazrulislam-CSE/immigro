@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Filter Statement</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.account.statement') }}" class="row g-3">
                    <div class="col-md-3">
                        <label>From Date</label>
                        <input type="date" name="from_date" class="form-control" value="{{ $fromDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-3">
                        <label>To Date</label>
                        <input type="date" name="to_date" class="form-control" value="{{ $toDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Account Statement Summary</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="alert alert-success">Total Income: {{ number_format($totalIncome,2) }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger">Total Expense: {{ number_format($totalExpense,2) }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-info">Net Balance: {{ number_format($netBalance,2) }}</div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Client/Details</th>
                                <th>Amount</th>
                                <th>Due</th>
                                <th>Payment Method</th>
                                <th>Reference</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $txn)
                            <tr>
                                <td>{{ $txn['date']->format('d M Y') }}</td>
                                <td>
                                    @if($txn['type'] == 'Income')
                                        <span class="badge bg-success">Income</span>
                                    @else
                                        <span class="badge bg-danger">Expense</span>
                                    @endif
                                </td>
                                <td>{{ $txn['category'] ?? 'N/A' }}</td>
                                <td>{{ $txn['client'] }}</td>
                                <td class="{{ $txn['amount'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format(abs($txn['amount']),2) }}
                                </td>
                                <td>{{ number_format($txn['due'],2) }}</td>
                                <td>{{ $txn['payment_method'] ?? 'N/A' }}</td>
                                <td>{{ $txn['reference'] }}</td>
                                <td>{{ number_format($txn['balance'],2) }}</td>
                            </tr>
                            @endforeach
                            @if($transactions->isEmpty())
                            <tr><td colspan="9" class="text-center">No transactions found</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection