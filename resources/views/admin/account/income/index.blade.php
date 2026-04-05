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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">{{ $pageTitle }} <span class="badge bg-danger">{{ count($incomes) }}</span></p>
                    <a href="{{ route('admin.income.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add Income
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Category</th>
                                    <th>Total Amount</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Date</th>
                                    <th>Payment Date</th>
                                    <th>Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($incomes as $income)
                                <tr>
                                    <td>{{ $income->id }}</td>
                                    <td>{{ $income->client->client_name ?? 'N/A' }}</td>
                                    <td>{{ $income->income_category ?? 'N/A' }}</td>
                                    <td>{{ number_format($income->total_amount,2) }}</td>
                                    <td>{{ number_format($income->payment_amount,2) }}</td>
                                    <td>{{ number_format($income->due_amount,2) }}</td>
                                    <td>{{ $income->date ? \Carbon\Carbon::parse($income->date)->format('d M Y') : 'N/A' }}</td>
                                    <td>{{ $income->payment_date ? \Carbon\Carbon::parse($income->payment_date)->format('d M Y') : 'N/A' }}</td>
                                    <td>{{ $income->payment_method ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.income.voucher', $income->id) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-receipt"></i> Voucher</a>
                                        <a href="{{ route('admin.income.show', $income->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.income.edit', $income->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.income.delete', $income->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection