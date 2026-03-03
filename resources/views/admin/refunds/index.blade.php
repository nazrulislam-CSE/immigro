@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refundModal" id="addRefundBtn">
                        <i class="fas fa-plus"></i> Add Refund
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Client Name</th>
                                    <th>Mobile</th>
                                    <th>Country</th>
                                    <th>Refund Amount</th>
                                    <th>Payment Method</th>
                                    <th>Date</th>
                                    <th>Reason</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($refunds as $key => $refund)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $refund->client->client_name ?? '' }}</td>
                                    <td>{{ $refund->client->phone_number ?? '' }}</td>
                                    <td>{{ $refund->client->country_name ?? '' }}</td>
                                    <td>৳ {{ number_format($refund->refund_amount, 2) }}</td>
                                    <td>{{ $refund->payment_method }}</td>
                                    <td>{{ $refund->date ? $refund->date->format('d-m-Y') : '' }}</td>
                                    <td>{{ $refund->reason }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $refund->id }}"
                                            data-client_id="{{ $refund->client_id }}"
                                            data-refund_amount="{{ $refund->refund_amount }}"
                                            data-payment_method="{{ $refund->payment_method }}"
                                            data-date="{{ $refund->date ? $refund->date->format('Y-m-d') : '' }}"
                                            data-reason="{{ $refund->reason }}"
                                            data-bs-toggle="modal" data-bs-target="#refundModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.refund.delete', $refund->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

{{-- Refund Modal (Add/Edit) --}}
<div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="refundForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="refundModalLabel">Add Refund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client *</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name_display" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="client_name_display" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile_display" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" id="mobile_display" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country_display" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country_display" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="client_total_amount" class="form-label">Client Total Amount</label>
                            <input type="text" class="form-control" id="client_total_amount" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_total_refund" class="form-label">Total Refunded So Far</label>
                            <input type="text" class="form-control" id="client_total_refund" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="client_net_balance" class="form-label">Net Balance (Total - Refund)</label>
                            <input type="text" class="form-control" id="client_net_balance" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="refund_amount" class="form-label">Refund Amount</label>
                        <input type="number" step="0.01" class="form-control" name="refund_amount" placeholder="Enter Refund Amount" id="refund_amount">
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <input type="text" class="form-control" name="payment_method" id="payment_method" placeholder="e.g., Cash, Bank">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control" name="reason" placeholder="Enter Reason" id="reason" rows="3"></textarea>
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
        // Function to load client details and execute callback
        function loadClientDetails(clientId, callback) {
            if (clientId) {
                $.ajax({
                    url: '{{ route("admin.refund.getClient", "") }}/' + clientId,
                    type: 'GET',
                    success: function(data) {
                        $('#client_name_display').val(data.client_name);
                        $('#mobile_display').val(data.phone_number);
                        $('#country_display').val(data.country_name);
                        $('#client_total_amount').val(data.total_amount);
                        $('#client_total_refund').val(data.total_refund);
                        var net = (parseFloat(data.total_amount) || 0) - (parseFloat(data.total_refund) || 0);
                        $('#client_net_balance').val(net.toFixed(2));
                        if (callback) callback();
                    },
                    error: function() {
                        alert('Could not fetch client details.');
                        $('#client_name_display, #mobile_display, #country_display, #client_total_amount, #client_total_refund, #client_net_balance').val('');
                        if (callback) callback();
                    }
                });
            } else {
                $('#client_name_display, #mobile_display, #country_display, #client_total_amount, #client_total_refund, #client_net_balance').val('');
                if (callback) callback();
            }
        }

        // Client dropdown change
        $('#client_id').change(function() {
            var clientId = $(this).val();
            loadClientDetails(clientId);
        });

        // Reset modal on close
        $('#refundModal').on('hidden.bs.modal', function () {
            $('#refundForm')[0].reset();
            $('#method').val('POST');
            $('#refundForm').attr('action', '{{ route("admin.refund.store") }}');
            $('#refundModalLabel').text('Add Refund');
            $('#client_name_display, #mobile_display, #country_display, #client_total_amount, #client_total_refund, #client_net_balance').val('');
        });

        // Edit button
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var clientId = $(this).data('client_id');
            var refundAmount = $(this).data('refund_amount');
            var paymentMethod = $(this).data('payment_method');
            var date = $(this).data('date');
            var reason = $(this).data('reason');

            $('#client_id').val(clientId);
            // Load client details, then set refund fields
            loadClientDetails(clientId, function() {
                $('#refund_amount').val(refundAmount);
                $('#payment_method').val(paymentMethod);
                $('#date').val(date);
                $('#reason').val(reason);
            });

            $('#method').val('POST');
            $('#refundForm').attr('action', '{{ route("admin.refund.update", "") }}/' + id);
            $('#refundModalLabel').text('Edit Refund');
        });

        // Add button
        $('#addRefundBtn').click(function() {
            $('#refundForm')[0].reset();
            $('#method').val('POST');
            $('#refundForm').attr('action', '{{ route("admin.refund.store") }}');
            $('#refundModalLabel').text('Add Refund');
            $('#client_name_display, #mobile_display, #country_display, #client_total_amount, #client_total_refund, #client_net_balance').val('');
        });
    });
</script>
@endpush