@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                        <i class="fas fa-plus"></i> Add Client
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
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Visa Category</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Agent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $key => $client)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->phone_number }}</td>
                                    <td>{{ $client->country_name }}</td>
                                    <td>{{ $client->visa_category }}</td>
                                    <td>{{ $client->date ? $client->date->format('d-m-Y') : '' }}</td>
                                    <td>{{ $client->total_amount }}</td>
                                    <td>{{ $client->agent_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editClientModal{{ $client->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.client.delete', $client->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

{{-- Add Client Modal --}}
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.client.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name" class="form-label">Client Name *</label>
                            <input type="text" class="form-control" name="client_name" placeholder="Enter Client Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Enter Address"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country_name" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="country_name" placeholder="Enter Country Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="work_category" class="form-label">Work Category</label>
                            <input type="text" class="form-control" name="work_category" placeholder="Enter Work Category">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="processing_time" class="form-label">Processing Time</label>
                            <input type="text" class="form-control" name="processing_time" placeholder="Enter Processing Time">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Select Date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="visa_category" class="form-label">Visa Category</label>
                            <select class="form-control" name="visa_category">
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="transport_number" class="form-label">Transport Number</label>
                            <input type="text" class="form-control" name="transport_number" placeholder="Enter Transport Number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" name="total_amount" placeholder="Enter Total Amount">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" name="agent_name" placeholder="Enter Agent Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="agent_id" class="form-label">Agent ID</label>
                            <input type="text" class="form-control" name="agent_id" placeholder="Enter Agent ID">
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

{{-- Edit Client Modals --}}
@foreach($clients as $client)
<div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" aria-labelledby="editClientModalLabel{{ $client->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.client.update', $client->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel{{ $client->id }}">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name{{ $client->id }}" class="form-label">Client Name *</label>
                            <input type="text" class="form-control" name="client_name" id="client_name{{ $client->id }}" value="{{ $client->client_name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number{{ $client->id }}" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number{{ $client->id }}" value="{{ $client->phone_number }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address{{ $client->id }}" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address{{ $client->id }}" rows="2">{{ $client->address }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country_name{{ $client->id }}" class="form-label">Country Name</label>
                            <input type="text" class="form-control" name="country_name" id="country_name{{ $client->id }}" value="{{ $client->country_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="work_category{{ $client->id }}" class="form-label">Work Category</label>
                            <input type="text" class="form-control" name="work_category" id="work_category{{ $client->id }}" value="{{ $client->work_category }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="processing_time{{ $client->id }}" class="form-label">Processing Time</label>
                            <input type="text" class="form-control" name="processing_time" id="processing_time{{ $client->id }}" value="{{ $client->processing_time }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date{{ $client->id }}" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date{{ $client->id }}" value="{{ $client->date ? $client->date->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="visa_category{{ $client->id }}" class="form-label">Visa Category</label>
                            <select class="form-control" name="visa_category" id="visa_category{{ $client->id }}">
                                <option value="">Select Visa Category</option>
                                <option value="Work permit" {{ $client->visa_category == 'Work permit' ? 'selected' : '' }}>Work permit</option>
                                <option value="Student visa" {{ $client->visa_category == 'Student visa' ? 'selected' : '' }}>Student visa</option>
                                <option value="Medical visa" {{ $client->visa_category == 'Medical visa' ? 'selected' : '' }}>Medical visa</option>
                                <option value="Tourist visa" {{ $client->visa_category == 'Tourist visa' ? 'selected' : '' }}>Tourist visa</option>
                                <option value="Umrah visa" {{ $client->visa_category == 'Umrah visa' ? 'selected' : '' }}>Umrah visa</option>
                                <option value="Double entry visa" {{ $client->visa_category == 'Double entry visa' ? 'selected' : '' }}>Double entry visa</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="transport_number{{ $client->id }}" class="form-label">Transport Number</label>
                            <input type="text" class="form-control" name="transport_number" id="transport_number{{ $client->id }}" value="{{ $client->transport_number }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_amount{{ $client->id }}" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" name="total_amount" id="total_amount{{ $client->id }}" value="{{ $client->total_amount }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="agent_name{{ $client->id }}" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" name="agent_name" id="agent_name{{ $client->id }}" value="{{ $client->agent_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="agent_id{{ $client->id }}" class="form-label">Agent ID</label>
                            <input type="text" class="form-control" name="agent_id" id="agent_id{{ $client->id }}" value="{{ $client->agent_id }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection