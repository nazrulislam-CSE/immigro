@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $pageTitle }}</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal"
                            id="addInvoiceBtn">
                            <i class="fas fa-plus"></i> Add Invoice
                        </button>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice No</th>
                                        <th>Client Name</th>
                                        <th>Mobile</th>
                                        <th>Country</th>
                                        <th>Total</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Processing Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $key => $invoice)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $invoice->invoice_no }}</td>
                                            <td>{{ $invoice->client->client_name ?? '' }}</td>
                                            <td>{{ $invoice->mobile }}</td>
                                            <td>{{ $invoice->country_name }}</td>
                                            <td>৳ {{ number_format($invoice->total_amount, 2) }}</td>
                                            <td>৳ {{ number_format($invoice->advance_pay, 2) }}</td>
                                            <td>৳ {{ number_format($invoice->due, 2) }}</td>
                                            <td>{{ $invoice->processing_time }}</td>
                                            <td>
                                                {{-- View Receipt Button --}}
                                                <button type="button" class="btn btn-sm btn-info receipt-btn"
                                                    data-id="{{ $invoice->id }}"
                                                    data-invoice_no="{{ $invoice->invoice_no }}"
                                                    data-client="{{ $invoice->client->client_name ?? '' }}"
                                                    data-mobile="{{ $invoice->mobile }}"
                                                    data-country="{{ $invoice->country_name }}"
                                                    data-total="{{ $invoice->total_amount }}"
                                                    data-advance="{{ $invoice->advance_pay }}"
                                                    data-due="{{ $invoice->due }}"
                                                    data-processing="{{ $invoice->processing_time }}"
                                                    data-date="{{ $invoice->created_at->format('d-m-Y') }}"
                                                    data-bs-toggle="modal" data-bs-target="#receiptModal">
                                                    <i class="fas fa-receipt"></i>
                                                </button>

                                                {{-- Edit Button --}}
                                                <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                    data-id="{{ $invoice->id }}"
                                                    data-client_id="{{ $invoice->client_id }}"
                                                    data-mobile="{{ $invoice->mobile }}"
                                                    data-country="{{ $invoice->country_name }}"
                                                    data-total="{{ $invoice->total_amount }}"
                                                    data-advance="{{ $invoice->advance_pay }}"
                                                    data-due="{{ $invoice->due }}"
                                                    data-processing="{{ $invoice->processing_time }}"
                                                    data-bs-toggle="modal" data-bs-target="#invoiceModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                {{-- Delete Button --}}
                                                <a href="{{ route('admin.invoice.delete', $invoice->id) }}"
                                                    class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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

    {{-- Invoice Modal (Add/Edit) --}}
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="invoiceForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" id="invoice_id" name="invoice_id" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel">Add Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client Name *</label>
                            <select class="form-control" name="client_id" id="client_id" required>
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="country_name" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="country_name" id="country_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="previous_due" class="form-label">Previous Due (Total Outstanding)</label>
                            <input type="text" class="form-control" id="previous_due" readonly value="0.00">
                        </div>
                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" name="total_amount"
                                placeholder="Enter Total Amount" id="total_amount">
                        </div>
                        <div class="mb-3">
                            <label for="advance_pay" class="form-label">Advance Pay</label>
                            <input type="number" step="0.01" class="form-control" name="advance_pay"
                                placeholder="Enter Advance Pay" id="advance_pay">
                        </div>
                        <div class="mb-3">
                            <label for="due" class="form-label">Due</label>
                            <input type="number" step="0.01" class="form-control" name="due"
                                placeholder="Enter Due Amount" id="due" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="processing_time" class="form-label">Processing Time</label>
                            <input type="text" class="form-control" name="processing_time"
                                placeholder="Enter Processing Time" id="processing_time">
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
                    <h5 class="modal-title" id="receiptModalLabel">Money Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="receiptContent">
                    {{-- Receipt content will be injected here via JavaScript --}}
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
            // Load client details (mobile, country, previous due)
            function loadClientDetails(clientId, excludeId = null) {
                if (clientId) {
                    // Fetch mobile & country
                    $.ajax({
                        url: '{{ route('admin.invoice.getClient', '') }}/' + clientId,
                        type: 'GET',
                        success: function(data) {
                            $('#mobile').val(data.mobile);
                            $('#country_name').val(data.country_name);
                        },
                        error: function() {
                            alert('Could not fetch client details.');
                        }
                    });
                    // Fetch previous due
                    var dueUrl = '{{ route('admin.invoice.getClientDue', '') }}/' + clientId;
                    if (excludeId) {
                        dueUrl += '?exclude_id=' + excludeId;
                    }
                    $.ajax({
                        url: dueUrl,
                        type: 'GET',
                        success: function(data) {
                            $('#previous_due').val(data.previous_due);
                        },
                        error: function() {
                            $('#previous_due').val('0.00');
                        }
                    });
                } else {
                    $('#mobile, #country_name, #previous_due').val('');
                }
            }

            // Client dropdown change
            $('#client_id').change(function() {
                var clientId = $(this).val();
                var excludeId = $('#invoice_id').val(); // for edit, exclude current invoice
                loadClientDetails(clientId, excludeId);
            });

            // Calculate due on total or advance change
            function calculateDue() {
                var total = parseFloat($('#total_amount').val()) || 0;
                var advance = parseFloat($('#advance_pay').val()) || 0;
                var due = total - advance;
                $('#due').val(due.toFixed(2));
            }
            $('#total_amount, #advance_pay').on('input', calculateDue);

            // Reset modal on close
            $('#invoiceModal').on('hidden.bs.modal', function() {
                $('#invoiceForm')[0].reset();
                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.store') }}');
                $('#invoiceModalLabel').text('Add Invoice');
                $('#mobile, #country_name, #previous_due, #invoice_id').val('');
            });

            // Edit button
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var clientId = $(this).data('client_id');
                var mobile = $(this).data('mobile');
                var country = $(this).data('country');
                var total = $(this).data('total');
                var advance = $(this).data('advance');
                var due = $(this).data('due');
                var processing = $(this).data('processing');

                $('#invoice_id').val(id);
                $('#client_id').val(clientId);
                // Set fields directly (AJAX will also run, but we set to avoid delay)
                $('#mobile').val(mobile);
                $('#country_name').val(country);
                $('#total_amount').val(total);
                $('#advance_pay').val(advance);
                $('#due').val(due);
                $('#processing_time').val(processing);

                // Load previous due excluding this invoice
                loadClientDetails(clientId, id);

                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.update', '') }}/' + id);
                $('#invoiceModalLabel').text('Edit Invoice');
            });

            // Add button
            $('#addInvoiceBtn').click(function() {
                $('#invoiceForm')[0].reset();
                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.store') }}');
                $('#invoiceModalLabel').text('Add Invoice');
                $('#mobile, #country_name, #previous_due, #invoice_id').val('');
            });

            // Receipt button
            $('.receipt-btn').click(function() {
                var id = $(this).data('id');
                var invoiceNo = $(this).data('invoice_no');
                var client = $(this).data('client');
                var mobile = $(this).data('mobile');
                var country = $(this).data('country');
                var total = $(this).data('total');
                var advance = $(this).data('advance');
                var due = $(this).data('due');
                var processing = $(this).data('processing');
                var date = $(this).data('date');

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
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .client-table, .amount-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .client-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #ccc;
        }
        .client-table td:first-child {
            font-weight: bold;
            width: 150px;
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
        .amount-table .total-row {
            font-weight: bold;
            background: #f9f9f9;
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
        <h2>MONEY RECEIPT</h2>
        <div class="subtitle">Official Payment Acknowledgement</div>
        <hr>
        <div class="invoice-info">
            <div><strong>Invoice No:</strong> ${invoiceNo}</div>
            <div><strong>Date:</strong> ${date}</div>
        </div>

        <h3 style="margin:0 0 10px;">Client Information</h3>
        <table class="client-table">
            <tr><td>Client Name</td><td><strong>${client}</strong></td></tr>
            <tr><td>Mobile Number</td><td>${mobile}</td></tr>
            <tr><td>Country</td><td>${country}</td></tr>
            <tr><td>Processing Time</td><td>${processing}</td></tr>
        </table>

        <table class="amount-table">
            <thead>
                <tr><th>Description</th><th class="text-right">Amount (৳)</th></tr>
            </thead>
            <tbody>
                <tr><td>Total Amount</td><td class="text-right">৳ ${parseFloat(total).toFixed(2)}</td></tr>
                <tr><td>Advance Payment</td><td class="text-right">৳ ${parseFloat(advance).toFixed(2)}</td></tr>
                <tr class="total-row"><td>Due Amount</td><td class="text-right">৳ ${parseFloat(due).toFixed(2)}</td></tr>
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
            location.reload();
        }
    </script>
@endpush
