@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAgentModal">
                        <i class="fas fa-plus"></i> Add Agent
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
                                    <th>Agent Name</th>
                                    <th>Mobile</th>
                                    <th>Agent ID</th>
                                    <th>No Area</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agents as $key => $agent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $agent->agent_name }}</td>
                                    <td>{{ $agent->mobile_number }}</td>
                                    <td>{{ $agent->agent_id }}</td>
                                    <td>{{ $agent->no_area }}</td>
                                    <td>
                                        @if($agent->photo)
                                            <img src="{{ asset('storage/'.$agent->photo) }}" width="50" height="50" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editAgentModal{{ $agent->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.agent.delete', $agent->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

{{-- Add Agent Modal --}}
<div class="modal fade" id="addAgentModal" tabindex="-1" aria-labelledby="addAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.agent.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgentModalLabel">Add New Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="agent_name" class="form-label">Agent Name *</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="Enter Agent Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile Number">
                    </div>
                    <div class="mb-3">
                        <label for="agent_id" class="form-label">Agent ID *</label>
                        <input type="text" class="form-control" name="agent_id" placeholder="Enter Agent ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_area" class="form-label">No Area</label>
                        <input type="text" class="form-control" name="no_area" placeholder="Enter No Area">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" accept="image/*">
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

{{-- Edit Agent Modals --}}
@foreach($agents as $agent)
<div class="modal fade" id="editAgentModal{{ $agent->id }}" tabindex="-1" aria-labelledby="editAgentModalLabel{{ $agent->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.agent.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editAgentModalLabel{{ $agent->id }}">Edit Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="agent_name{{ $agent->id }}" class="form-label">Agent Name *</label>
                        <input type="text" class="form-control" name="agent_name" id="agent_name{{ $agent->id }}" value="{{ $agent->agent_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number{{ $agent->id }}" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" id="mobile_number{{ $agent->id }}" value="{{ $agent->mobile_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="agent_id{{ $agent->id }}" class="form-label">Agent ID *</label>
                        <input type="text" class="form-control" name="agent_id" id="agent_id{{ $agent->id }}" value="{{ $agent->agent_id }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_area{{ $agent->id }}" class="form-label">No Area</label>
                        <input type="text" class="form-control" name="no_area" id="no_area{{ $agent->id }}" value="{{ $agent->no_area }}">
                    </div>
                    <div class="mb-3">
                        <label for="photo{{ $agent->id }}" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo{{ $agent->id }}" accept="image/*">
                        @if($agent->photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$agent->photo) }}" width="80" class="img-thumbnail">
                            </div>
                        @endif
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