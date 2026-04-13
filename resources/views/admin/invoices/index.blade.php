@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $pageTitle }}</h4>
                        @if (auth('admin')->user()->can('create Invoices'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal"
                                id="addInvoiceBtn">
                                <i class="fas fa-plus"></i> Add Invoice
                            </button>
                        @endif
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
                                                @if (auth('admin')->user()->can('view Invoices'))
                                                    <a href="{{ route('admin.invoice.receipt', $invoice->id) }}"
                                                        target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-receipt"></i>
                                                    </a>
                                                @endif
                                                @if (auth('admin')->user()->can('edit Invoices'))
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
                                                @endif

                                                @if (auth('admin')->user()->can('delete Invoices'))
                                                    {{-- Delete Button --}}
                                                    <a href="{{ route('admin.invoice.delete', $invoice->id) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
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
@endsection

@push('admin')
    <script>
        // Pass dynamic settings from Laravel to JavaScript
        const siteLogo = '{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}';
        const siteName = '{{ get_setting('site_name')->value ?? 'Company Name' }}';
        const phone = '{{ get_setting('phone')->value ?? 'N/A' }}';
        const address = '{{ get_setting('business_address')->value ?? 'N/A' }}';

        console.log("Site Logo:", siteLogo);

        $(document).ready(function() {
            // Load client details (mobile, country, previous due)
            function loadClientDetails(clientId, excludeId = null) {
                if (clientId) {
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
                    var dueUrl = '{{ route('admin.invoice.getClientDue', '') }}/' + clientId;
                    if (excludeId) dueUrl += '?exclude_id=' + excludeId;
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

            $('#client_id').change(function() {
                var clientId = $(this).val();
                var excludeId = $('#invoice_id').val();
                loadClientDetails(clientId, excludeId);
            });

            function calculateDue() {
                var total = parseFloat($('#total_amount').val()) || 0;
                var advance = parseFloat($('#advance_pay').val()) || 0;
                var due = total - advance;
                $('#due').val(due.toFixed(2));
            }
            $('#total_amount, #advance_pay').on('input', calculateDue);

            $('#invoiceModal').on('hidden.bs.modal', function() {
                $('#invoiceForm')[0].reset();
                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.store') }}');
                $('#invoiceModalLabel').text('Add Invoice');
                $('#mobile, #country_name, #previous_due, #invoice_id').val('');
            });

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
                $('#mobile').val(mobile);
                $('#country_name').val(country);
                $('#total_amount').val(total);
                $('#advance_pay').val(advance);
                $('#due').val(due);
                $('#processing_time').val(processing);
                loadClientDetails(clientId, id);
                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.update', '') }}/' + id);
                $('#invoiceModalLabel').text('Edit Invoice');
            });

            $('#addInvoiceBtn').click(function() {
                $('#invoiceForm')[0].reset();
                $('#method').val('POST');
                $('#invoiceForm').attr('action', '{{ route('admin.invoice.store') }}');
                $('#invoiceModalLabel').text('Add Invoice');
                $('#mobile, #country_name, #previous_due, #invoice_id').val('');
            });
        });
    </script>
@endpush
