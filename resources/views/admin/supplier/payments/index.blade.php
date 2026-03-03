@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Supplier Payment Summary --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Supplier Payment Summary</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Supplier Name</th>
                                    <th>Total Amount</th>
                                    <th>Total Paid</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplierSummary as $summary)
                                <tr>
                                    <td>{{ $summary['name'] }}</td>
                                    <td>৳ {{ number_format($summary['total_amount'], 2) }}</td>
                                    <td>৳ {{ number_format($summary['total_pay'], 2) }}</td>
                                    <td>৳ {{ number_format($summary['due'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" id="addPaymentBtn">
                        <i class="fas fa-plus"></i> Add Payment
                    </button>
                </div>
                <div class="card-body">
                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('admin.supplier-payment.index') }}" class="row g-3 mb-4">
                        <div class="col-md-2">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select class="form-control" name="supplier_id" id="filter_supplier_id">
                                <option value="">All Suppliers</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
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
                            <label for="payment_category" class="form-label">Payment Category</label>
                            <input type="text" class="form-control" name="payment_category" id="filter_payment_category" value="{{ request('payment_category') }}" placeholder="e.g., Advance">
                        </div>
                        <div class="col-md-2">
                            <label for="visa_category" class="form-label">Visa Category</label>
                            <select class="form-control" name="visa_category" id="filter_visa_category">
                                <option value="">All</option>
                                <option value="Work permit" {{ request('visa_category') == 'Work permit' ? 'selected' : '' }}>Work permit</option>
                                <option value="Student visa" {{ request('visa_category') == 'Student visa' ? 'selected' : '' }}>Student visa</option>
                                <option value="Medical visa" {{ request('visa_category') == 'Medical visa' ? 'selected' : '' }}>Medical visa</option>
                                <option value="Tourist visa" {{ request('visa_category') == 'Tourist visa' ? 'selected' : '' }}>Tourist visa</option>
                                <option value="Umrah visa" {{ request('visa_category') == 'Umrah visa' ? 'selected' : '' }}>Umrah visa</option>
                                <option value="Double entry visa" {{ request('visa_category') == 'Double entry visa' ? 'selected' : '' }}>Double entry visa</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.supplier-payment.index') }}" class="btn btn-secondary">Reset</a>
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
                                    <th>Supplier</th>
                                    <th>Payment Category</th>
                                    <th>Total Amount</th>
                                    <th>Total Pay</th>
                                    <th>Due</th>
                                    <th>Due Pay Date</th>
                                    <th>Date</th>
                                    <th>Purpose</th>
                                    <th>Applicable Fee</th>
                                    <th>Visa Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $payment->supplier->name ?? '' }}</td>
                                    <td>{{ $payment->payment_category }}</td>
                                    <td>৳ {{ number_format($payment->total_amount, 2) }}</td>
                                    <td>৳ {{ number_format($payment->total_pay, 2) }}</td>
                                    <td>৳ {{ number_format($payment->due, 2) }}</td>
                                    <td>{{ $payment->due_pay_date ? $payment->due_pay_date->format('d-m-Y') : '' }}</td>
                                    <td>{{ $payment->date ? $payment->date->format('d-m-Y') : '' }}</td>
                                    <td>{{ $payment->payment_purpose }}</td>
                                    <td>{{ $payment->applicable_fee }}</td>
                                    <td>{{ $payment->visa_category }}</td>
                                    <td>
                                        {{-- View Receipt Button --}}
                                        <button type="button" class="btn btn-sm btn-info view-receipt-btn"
                                            data-id="{{ $payment->id }}"
                                            data-supplier="{{ $payment->supplier->name ?? '' }}"
                                            data-date="{{ $payment->date ? $payment->date->format('d-m-Y') : '' }}"
                                            data-total_amount="{{ $payment->total_amount }}"
                                            data-total_pay="{{ $payment->total_pay }}"
                                            data-due="{{ $payment->due }}"
                                            data-payment_category="{{ $payment->payment_category }}"
                                            data-payment_purpose="{{ $payment->payment_purpose }}"
                                            data-applicable_fee="{{ $payment->applicable_fee }}"
                                            data-visa_category="{{ $payment->visa_category }}"
                                            data-due_pay_date="{{ $payment->due_pay_date ? $payment->due_pay_date->format('d-m-Y') : '' }}"
                                            data-bs-toggle="modal" data-bs-target="#receiptModal">
                                            <i class="fas fa-receipt"></i>
                                        </button>

                                        {{-- Edit Button --}}
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $payment->id }}"
                                            data-supplier_id="{{ $payment->supplier_id }}"
                                            data-payment_category="{{ $payment->payment_category }}"
                                            data-total_amount="{{ $payment->total_amount }}"
                                            data-total_pay="{{ $payment->total_pay }}"
                                            data-due="{{ $payment->due }}"
                                            data-due_pay_date="{{ $payment->due_pay_date ? $payment->due_pay_date->format('Y-m-d') : '' }}"
                                            data-date="{{ $payment->date ? $payment->date->format('Y-m-d') : '' }}"
                                            data-payment_purpose="{{ $payment->payment_purpose }}"
                                            data-applicable_fee="{{ $payment->applicable_fee }}"
                                            data-visa_category="{{ $payment->visa_category }}"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Delete Button --}}
                                        <a href="{{ route('admin.supplier-payment.delete', $payment->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center">No payments found.</td>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="paymentForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add Supplier Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="supplier_id" class="form-label">Supplier Name *</label>
                            <select class="form-control" name="supplier_id" id="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_category" class="form-label">Payment Category</label>
                            <input type="text" class="form-control" name="payment_category" id="payment_category" placeholder="e.g., Advance, Documents">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" name="total_amount" id="total_amount" placeholder="0.00" value="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="total_pay" class="form-label">Total Pay</label>
                            <input type="number" step="0.01" class="form-control" name="total_pay" id="total_pay" placeholder="0.00" value="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="due" class="form-label">Due</label>
                            <input type="number" step="0.01" class="form-control" name="due" id="due" placeholder="Auto-calculated" readonly value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_pay_date" class="form-label">Due Pay Date</label>
                            <input type="date" class="form-control" name="due_pay_date" id="due_pay_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payment_purpose" class="form-label">Payment Purpose</label>
                            <textarea class="form-control" name="payment_purpose" id="payment_purpose" rows="2"></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="applicable_fee" class="form-label">Applicable Fee</label>
                            <select class="form-control" name="applicable_fee" id="applicable_fee">
                                <option value="">Select</option>
                                <option value="Advance">Advance</option>
                                <option value="Documents">Documents</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="visa_category" class="form-label">Visa Category</label>
                            <select class="form-control" name="visa_category" id="visa_category">
                                <option value="">Select Visa Category</option>
                                <option value="Work permit">Work permit</option>
                                <option value="Student visa">Student visa</option>
                                <option value="Medical visa">Medical visa</option>
                                <option value="Tourist visa">Tourist visa</option>
                                <option value="Umrah visa">Umrah visa</option>
                                <option value="Double entry visa">Double entry visa</option>
                            </select>
                        </div>
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

{{-- Receipt Modal --}}
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Supplier Payment Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="receiptContent">
                {{-- Receipt will be injected here --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
    $(document).ready(function() {
        // Auto-calculate due
        function calculateDue() {
            var total = parseFloat($('#total_amount').val()) || 0;
            var pay = parseFloat($('#total_pay').val()) || 0;
            var due = total - pay;
            $('#due').val(due.toFixed(2));
        }
        $('#total_amount, #total_pay').on('input', calculateDue);

        // Reset payment modal on close
        $('#paymentModal').on('hidden.bs.modal', function () {
            $('#paymentForm')[0].reset();
            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.supplier-payment.store") }}');
            $('#paymentModalLabel').text('Add Supplier Payment');
            $('#paymentModal').removeData('edit-data');
        });

        // Populate payment modal on show
        $('#paymentModal').on('shown.bs.modal', function() {
            var data = $('#paymentModal').data('edit-data');
            if (data) {
                $('#supplier_id').val(data.supplierId).trigger('change');
                $('#payment_category').val(data.paymentCategory);
                $('#total_amount').val(data.totalAmount);
                $('#total_pay').val(data.totalPay);
                $('#due').val(data.due);
                $('#due_pay_date').val(data.duePayDate);
                $('#date').val(data.date);
                $('#payment_purpose').val(data.paymentPurpose);
                $('#applicable_fee').val(data.applicableFee).trigger('change');
                $('#visa_category').val(data.visaCategory).trigger('change');
                $('#paymentModal').removeData('edit-data');
            }
        });

        // Edit button
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var supplierId = $(this).data('supplier_id');
            var paymentCategory = $(this).data('payment_category');
            var totalAmount = $(this).data('total_amount');
            var totalPay = $(this).data('total_pay');
            var due = $(this).data('due');
            var duePayDate = $(this).data('due_pay_date');
            var date = $(this).data('date');
            var paymentPurpose = $(this).data('payment_purpose');
            var applicableFee = $(this).data('applicable_fee');
            var visaCategory = $(this).data('visa_category');

            $('#paymentModal').data('edit-data', {
                supplierId: supplierId,
                paymentCategory: paymentCategory,
                totalAmount: totalAmount,
                totalPay: totalPay,
                due: due,
                duePayDate: duePayDate,
                date: date,
                paymentPurpose: paymentPurpose,
                applicableFee: applicableFee,
                visaCategory: visaCategory
            });

            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.supplier-payment.update", "") }}/' + id);
            $('#paymentModalLabel').text('Edit Supplier Payment');
        });

        // Add button
        $('#addPaymentBtn').click(function() {
            $('#paymentForm')[0].reset();
            $('#method').val('POST');
            $('#paymentForm').attr('action', '{{ route("admin.supplier-payment.store") }}');
            $('#paymentModalLabel').text('Add Supplier Payment');
            $('#paymentModal').removeData('edit-data');
        });

        // View Receipt button
        $('.view-receipt-btn').click(function() {
            var id = $(this).data('id');
            var supplier = $(this).data('supplier');
            var date = $(this).data('date') || 'N/A';
            var totalAmount = parseFloat($(this).data('total_amount')).toFixed(2);
            var totalPay = parseFloat($(this).data('total_pay')).toFixed(2);
            var due = parseFloat($(this).data('due')).toFixed(2);
            var paymentCategory = $(this).data('payment_category') || 'N/A';
            var paymentPurpose = $(this).data('payment_purpose') || 'N/A';
            var applicableFee = $(this).data('applicable_fee') || 'N/A';
            var visaCategory = $(this).data('visa_category') || 'N/A';
            var duePayDate = $(this).data('due_pay_date') || 'N/A';

            var receiptHtml = `
                <style>
                    @media print {
                        body { background: #fff; }
                        .receipt-container { box-shadow: none; margin: 0; padding: 20px; }
                    }
                    .receipt-container {
                        font-family: 'Times New Roman', Times, serif;
                        max-width: 700px;
                        margin: 0 auto;
                        background: #fff;
                        padding: 30px;
                        border: 1px solid #ddd;
                    }
                    h2 {
                        text-align: center;
                        margin: 0 0 5px;
                        font-size: 28px;
                        font-weight: bold;
                    }
                    .subtitle {
                        text-align: center;
                        margin: 0 0 20px;
                        font-size: 16px;
                        color: #555;
                    }
                    hr {
                        border: none;
                        border-top: 2px solid #333;
                        margin: 15px 0;
                    }
                    .receipt-info {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 20px;
                        font-size: 16px;
                    }
                    .receipt-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 25px;
                    }
                    .receipt-table td {
                        padding: 8px 5px;
                        border-bottom: 1px solid #ccc;
                    }
                    .receipt-table td:first-child {
                        font-weight: bold;
                        width: 150px;
                    }
                    .amount-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 25px;
                    }
                    .amount-table th {
                        background: #f2f2f2;
                        padding: 10px 5px;
                        text-align: left;
                        border-bottom: 2px solid #333;
                    }
                    .amount-table td {
                        padding: 10px 5px;
                        border-bottom: 1px solid #ccc;
                    }
                    .text-right {
                        text-align: right;
                    }
                    .signature-area {
                        display: flex;
                        justify-content: space-between;
                        margin: 40px 0 20px;
                    }
                    .signature-line {
                        width: 200px;
                        border-top: 1px solid #333;
                        padding-top: 8px;
                        text-align: center;
                        font-size: 14px;
                    }
                    .footer-note {
                        text-align: center;
                        font-size: 13px;
                        color: #777;
                        margin-top: 30px;
                    }
                </style>
                <div class="receipt-container">
                    <h2>SUPPLIER PAYMENT RECEIPT</h2>
                    <div class="subtitle">Payment Acknowledgement</div>
                    <hr>
                    <div class="receipt-info">
                        <div><strong>Receipt No:</strong> SPRCP-${String(id).padStart(6, '0')}</div>
                        <div><strong>Date:</strong> ${date}</div>
                    </div>

                    <h3 style="margin:0 0 10px;">Supplier Details</h3>
                    <table class="receipt-table">
                        <tr><td>Supplier Name</td><td><strong>${supplier}</strong></td></tr>
                        <tr><td>Payment Category</td><td>${paymentCategory}</td></tr>
                        <tr><td>Payment Purpose</td><td>${paymentPurpose}</td></tr>
                        <tr><td>Applicable Fee</td><td>${applicableFee}</td></tr>
                        <tr><td>Visa Category</td><td>${visaCategory}</td></tr>
                        <tr><td>Due Pay Date</td><td>${duePayDate}</td></tr>
                    </table>

                    <table class="amount-table">
                        <thead>
                            <tr><th>Description</th><th class="text-right">Amount (৳)</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Total Amount</td><td class="text-right">৳ ${totalAmount}</td></tr>
                            <tr><td>Total Paid</td><td class="text-right">৳ ${totalPay}</td></tr>
                            <tr><td><strong>Due</strong></td><td class="text-right"><strong>৳ ${due}</strong></td></tr>
                        </tbody>
                    </table>

                    <div class="signature-area">
                        <div class="signature-line">Received By</div>
                        <div class="signature-line">Authorised Signature</div>
                    </div>

                    <div class="footer-note">This is a computer generated receipt – valid without signature.</div>
                </div>
            `;
            $('#receiptContent').html(receiptHtml);
        });
    });

    // Print receipt function
    function printReceipt() {
        var printContents = document.getElementById('receiptContent').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // optional: reload to restore page state
    }
</script>
@endpush