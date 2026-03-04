@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <span class="badge bg-info">{{ $staffMembers->count() }} Staff</span>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Staff Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <th>Direct Permissions</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($staffMembers as $key => $staff)
                                    @php
                                        $directPermCount = $staff->admin ? $staff->admin->getDirectPermissions()->count() : 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <strong>{{ $staff->staff_name }}</strong>
                                        </td>
                                        <td>{{ $staff->admin->email ?? 'N/A' }}</td>
                                        <td>{{ $staff->mobile_number }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ ucfirst($staff->role->name ?? 'No Role') }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $directPermCount > 0 ? 'warning' : 'secondary' }}">
                                                {{ $directPermCount }} direct
                                            </span>
                                        </td>
                                        <td>
                                            @if($staff->admin && $staff->admin->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.staff.permissions.show', $staff->id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="View Permissions">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.staff.permissions.edit', $staff->id) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="Manage Permissions">
                                                    <i class="fas fa-shield-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No staff found.</td>
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
@endsection