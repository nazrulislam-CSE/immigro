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
                <h4 class="card-title">Search Due</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.due.list') }}" class="row g-3">
                    <div class="col-md-3">
                        <label>Client Name</label>
                        <input type="text" name="client" class="form-control" placeholder="Search by client" value="{{ request('client') }}">
                    </div>
                    <div class="col-md-3">
                        <label>From Date</label>
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label>To Date</label>
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('admin.due.list') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Outstanding Dues</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-3">Total Due Amount: {{ number_format($totalDue,2) }}</div>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Category</th>
                                <th>Total Amount</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Payment Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dues as $income)
                            <tr>
                                <td>{{ $income->id }}</td>
                                <td>{{ $income->date ? $income->date->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $income->client->client_name ?? 'N/A' }}</td>
                                <td>{{ $income->income_category ?? 'N/A' }}</td>
                                <td>{{ number_format($income->total_amount,2) }}</td>
                                <td>{{ number_format($income->payment_amount,2) }}</td>
                                <td class="text-danger fw-bold">{{ number_format($income->due_amount,2) }}</td>
                                <td>{{ $income->payment_date ? $income->payment_date->format('d M Y') : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.income.show', $income->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.income.edit', $income->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                            @if($dues->isEmpty())
                            <tr><td colspan="9" class="text-center">No due records found</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection