@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Staff Payment Status Summary --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Staff Payment Status</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Gross Salary</th>
                                    <th>Total Paid</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffSummary as $summary)
                                <tr>
                                    <td>{{ $summary['name'] }}</td>
                                    <td>৳ {{ number_format($summary['gross'], 2) }}</td>
                                    <td>৳ {{ number_format($summary['total_paid'], 2) }}</td>
                                    <td>
                                        @php
                                            $badge = match($summary['status']) {
                                                'Paid' => 'success',
                                                'Partially Paid' => 'warning',
                                                'Unpaid' => 'danger',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badge }}">{{ $summary['status'] }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Payments List with Filters --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" id="addPaymentBtn">
                        <i class="fas fa-plus"></i> Add Payment
                    </button>
                </div>
                <div class="card-body">
                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('admin.staff.payment.index') }}" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="staff_id" class="form-label">Staff</label>
                            <select class="form-control" name="staff_id" id="staff_id">
                                <option value="">All Staff</option>
                                @foreach($allStaff as $staff)
                                    <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->staff_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="date_from" class="form-label">Date From</label>
                            <input type="date" class="form-control" name="date_from" id="date_from" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="date_to" class="form-label">Date To</label>
                            <input type="date" class="form-control" name="date_to" id="date_to" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select class="form-control" name="payment_type" id="payment_type">
                                <option value="">All Types</option>
                                <option value="salary" {{ request('payment_type') == 'salary' ? 'selected' : '' }}>Salary</option>
                                <option value="advance" {{ request('payment_type') == 'advance' ? 'selected' : '' }}>Advance</option>
                                <option value="bonus" {{ request('payment_type') == 'bonus' ? 'selected' : '' }}>Bonus</option>
                                <option value="overtime" {{ request('payment_type') == 'overtime' ? 'selected' : '' }}>Overtime</option>
                                <option value="other" {{ request('payment_type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.staff.payment.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Staff Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Method</th>
                                    <th>Reference</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $payment->staff->staff_name ?? '' }}</td>
                                    <td>{{ $payment->payment_date->format('d-m-Y') }}</td>
                                    <td>৳ {{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->payment_type }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->reference }}</td>
                                    <td>{{ $payment->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $payment->id }}"
                                            data-staff_id="{{ $payment->staff_id }}"
                                            data-payment_date="{{ $payment->payment_date->format('Y-m-d') }}"
                                            data-amount="{{ $payment->amount }}"
                                            data-payment_type="{{ $payment->payment_type }}"
                                            data-payment_method="{{ $payment->payment_method }}"
                                            data-reference="{{ $payment->reference }}"
                                            data-notes="{{ $payment->notes }}"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.staff.payment.delete', $payment->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No payments found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Payment Modal (Add/Edit) --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="paymentForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="staff_id" class="form-label">Staff *</label>
                        <select class="form-control" name="staff_id" id="staff_id" required>
                            <option value="">Select Staff</option>
                            @foreach($allStaff as $s)
                                <option value="{{ $s->id }}">{{ $s->staff_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date *</label>
                        <input type="date" class="form-control" name="payment_date" id="payment_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount *</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_type" class="form-label">Payment Type</label>
                        <select class="form-control" name="payment_type" id="payment_type">
                            <option value="">Select Type</option>
                            <option value="salary">Salary</option>
                            <option value="advance">Advance</option>
                            <option value="bonus">Bonus</option>
                            <option value="overtime">Overtime</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                            <option value="bkash">bKash</option>
                            <option value="nagad">Nagad</option>
                            <option value="rocket">Rocket</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reference" class="form-label">Reference (Cheque/Transaction ID)</label>
                        <input type="text" class="form-control" name="reference" id="reference" placeholder="e.g., Cheque no, TrxID">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" id="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
    $(document).ready(function() {
        // Reset modal on close
        $('#paymentModal').on('hidden.bs.modal', function () {
            $('#paymentForm')[0].reset();
            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.staff.payment.store") }}');
            $('#paymentModalLabel').text('Add Payment');
            $('#paymentModal').removeData('edit-data'); // clear stored edit data
        });

        // When modal is shown, populate if we have stored data
        $('#paymentModal').on('shown.bs.modal', function() {
            var data = $('#paymentModal').data('edit-data');
            if (data) {
                $('#staff_id').val(data.staffId).trigger('change');
                $('#payment_type').val(data.paymentType).trigger('change');
                $('#payment_method').val(data.paymentMethod).trigger('change');
                $('#payment_date').val(data.paymentDate);
                $('#amount').val(data.amount);
                $('#reference').val(data.reference);
                $('#notes').val(data.notes);
                // Clear stored data to avoid reapplying on subsequent opens
                $('#paymentModal').removeData('edit-data');
            }
        });

        // Edit button
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var staffId = $(this).data('staff_id');
            var paymentDate = $(this).data('payment_date');
            var amount = $(this).data('amount');
            var paymentType = $(this).data('payment_type');
            var paymentMethod = $(this).data('payment_method');
            var reference = $(this).data('reference');
            var notes = $(this).data('notes');

            // Store data for use in shown.bs.modal
            $('#paymentModal').data('edit-data', {
                id: id,
                staffId: staffId,
                paymentDate: paymentDate,
                amount: amount,
                paymentType: paymentType,
                paymentMethod: paymentMethod,
                reference: reference,
                notes: notes
            });

            // Update form action
            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.staff.payment.update", "") }}/' + id);
            $('#paymentModalLabel').text('Edit Payment');
        });

        // Add button
        $('#addPaymentBtn').click(function() {
            $('#paymentForm')[0].reset();
            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.staff.payment.store") }}');
            $('#paymentModalLabel').text('Add Payment');
            $('#paymentModal').removeData('edit-data');
        });
    });
</script>
@endpush