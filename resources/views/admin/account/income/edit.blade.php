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
                <form action="{{ route('admin.income.update', $income->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Client</label>
                            <select name="client_id" class="form-control">
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $income->client_id) == $client->id ? 'selected' : '' }}>{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Income Category</label>
                            <input type="text" name="income_category" class="form-control" value="{{ old('income_category', $income->income_category) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Total Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" required value="{{ old('total_amount', $income->total_amount) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="payment_amount" id="payment_amount" class="form-control" required value="{{ old('payment_amount', $income->payment_amount) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Due Amount</label>
                            <input type="number" step="0.01" name="due_amount" id="due_amount" class="form-control" readonly value="{{ old('due_amount', $income->due_amount) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $income->date ? \Carbon\Carbon::parse($income->date)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Date</label>
                            <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $income->payment_date ? \Carbon\Carbon::parse($income->payment_date)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Method</label>
                            <input type="text" name="payment_method" class="form-control" value="{{ old('payment_method', $income->payment_method) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Received By</label>
                            <input type="text" name="received_by" class="form-control" value="{{ old('received_by', $income->received_by) }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" rows="2">{{ old('comments', $income->comments) }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update Income</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
    $(document).ready(function() {
        function calculateDue() {
            let total = parseFloat($('#total_amount').val()) || 0;
            let payment = parseFloat($('#payment_amount').val()) || 0;
            let due = total - payment;
            $('#due_amount').val(due.toFixed(2));
        }

        $('#total_amount, #payment_amount').on('keyup change', function() {
            calculateDue();
        });

        calculateDue();
    });
</script>
@endpush