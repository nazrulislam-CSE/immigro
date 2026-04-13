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
                        <p class="card-title my-0">{{ $pageTitle }} <span
                                class="badge bg-danger">{{ count($expenses) }}</span></p>
                        <a href="{{ route('admin.expense.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Expense
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Paid By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->id }}</td>
                                            <td>{{ $expense->date ? $expense->date->format('d M Y') : 'N/A' }}</td>
                                            <td>{{ $expense->expense_category ?? 'N/A' }}</td>
                                            <td>{{ number_format($expense->expense_amount, 2) }}</td>
                                            <td>{{ $expense->payment_method ?? 'N/A' }}</td>
                                            <td>{{ $expense->paid_by ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('admin.expense.voucher', $expense->id) }}"
                                                    target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-receipt"></i>
                                                </a>
                                                <a href="{{ route('admin.expense.show', $expense->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.expense.edit', $expense->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.expense.delete', $expense->id) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="fas fa-trash"></i></a>
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
