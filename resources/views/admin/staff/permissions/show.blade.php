@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Staff:</strong> {{ $staff->staff_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Role:</strong> 
                            <span class="badge bg-primary">{{ ucfirst($role->name ?? 'No Role') }}</span>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Role Permissions</strong> (automatically granted) are shown in green. 
                        <strong>Direct Permissions</strong> (additional) are shown in blue.
                    </div>

                    @foreach($groups as $group)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">{{ $group }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse($permissions[$group] ?? [] as $permission)
                                        @php
                                            $isRole = in_array($permission->name, $rolePermissions);
                                            $isDirect = in_array($permission->name, $directPermissions);
                                        @endphp
                                        <div class="col-md-3 mb-2">
                                            <span class="badge 
                                                @if($isRole) bg-success 
                                                @elseif($isDirect) bg-primary 
                                                @else bg-secondary @endif 
                                                p-2 w-100 text-start">
                                                <i class="fas 
                                                    @if($isRole) fa-check-circle 
                                                    @elseif($isDirect) fa-plus-circle 
                                                    @else fa-circle @endif 
                                                    me-1"></i>
                                                {{ $permission->name }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="col-12 text-muted">No permissions in this group.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-end">
                        <a href="{{ route('admin.staff.permissions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('admin.staff.permissions.edit', $staff->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Permissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection