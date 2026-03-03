@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passportModal" id="addPassportBtn">
                        <i class="fas fa-plus"></i> Add Passport
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
                                    <th>Visa Type</th>
                                    <th>Passport No</th>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>Date</th>
                                    <th>Received By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passports as $key => $passport)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $passport->client_name }}</td>
                                    <td>{{ $passport->mobile_no }}</td>
                                    <td>{{ $passport->visa_type }}</td>
                                    <td>{{ $passport->passport_number }}</td>
                                    <td>{{ $passport->address }}</td>
                                    <td>{{ $passport->country }}</td>
                                    <td>{{ $passport->date ? $passport->date->format('d-m-Y') : '' }}</td>
                                    <td>{{ $passport->received_by }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $passport->id }}"
                                            data-client_name="{{ $passport->client_name }}"
                                            data-mobile_no="{{ $passport->mobile_no }}"
                                            data-visa_type="{{ $passport->visa_type }}"
                                            data-passport_number="{{ $passport->passport_number }}"
                                            data-address="{{ $passport->address }}"
                                            data-country="{{ $passport->country }}"
                                            data-date="{{ $passport->date ? $passport->date->format('Y-m-d') : '' }}"
                                            data-received_by="{{ $passport->received_by }}"
                                            data-bs-toggle="modal" data-bs-target="#passportModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.passport.delete', $passport->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

{{-- Passport Modal (Add/Edit) --}}
<div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="passportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="passportForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="passportModalLabel">Add Passport</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name" class="form-label">Client Name *</label>
                            <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Client Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile_no" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No" id="mobile_no">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visa_type" class="form-label">Visa Type</label>
                            <input type="text" class="form-control" name="visa_type" placeholder="Enter Visa Type"  id="visa_type">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="passport_number" class="form-label">Passport Number *</label>
                            <input type="text" class="form-control" name="passport_number" placeholder="Enter Passport Number" id="passport_number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Enter Address" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Enter Country" id="country">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date"  id="date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="received_by" class="form-label">Received By</label>
                            <input type="text" class="form-control" name="received_by" placeholder="Enter Received By" id="received_by">
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
@endsection

@push('admin')
<script>
    $(document).ready(function() {
        // Reset modal on close
        $('#passportModal').on('hidden.bs.modal', function () {
            $('#passportForm')[0].reset();
            $('#method').val('POST');
            $('#passportForm').attr('action', '{{ route("admin.passport.store") }}');
            $('#passportModalLabel').text('Add Passport');
        });

        // Edit button
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var client_name = $(this).data('client_name');
            var mobile_no = $(this).data('mobile_no');
            var visa_type = $(this).data('visa_type');
            var passport_number = $(this).data('passport_number');
            var address = $(this).data('address');
            var country = $(this).data('country');
            var date = $(this).data('date');
            var received_by = $(this).data('received_by');

            $('#client_name').val(client_name);
            $('#mobile_no').val(mobile_no);
            $('#visa_type').val(visa_type);
            $('#passport_number').val(passport_number);
            $('#address').val(address);
            $('#country').val(country);
            $('#date').val(date);
            $('#received_by').val(received_by);

            $('#method').val('POST');
            $('#passportForm').attr('action', '{{ route("admin.passport.update", "") }}/' + id);
            $('#passportModalLabel').text('Edit Passport');
        });

        // Add button
        $('#addPassportBtn').click(function() {
            $('#passportForm')[0].reset();
            $('#method').val('POST');
            $('#passportForm').attr('action', '{{ route("admin.passport.store") }}');
            $('#passportModalLabel').text('Add Passport');
        });
    });
</script>
@endpush