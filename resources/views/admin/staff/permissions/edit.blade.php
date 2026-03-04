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
                    <form action="{{ route('admin.staff.permissions.update', $staff->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Staff:</strong> {{ $staff->staff_name }}
                            </div>
                            <div class="col-md-6">
                                <strong>Role:</strong> <span class="badge bg-primary">{{ ucfirst($role->name ?? 'No Role') }}</span>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            Permissions assigned via role are automatically granted. Here you can assign additional direct permissions or remove direct permissions. Role permissions cannot be changed here.
                        </div>

                        {{-- Global Select/Deselect Controls --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">Select All</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllBtn">Deselect All</button>
                            </div>
                            <div>
                                <span class="text-muted" id="selectedCount">0 / {{ $permissions->flatten()->count() }} selected</span>
                            </div>
                        </div>

                        {{-- Tabs Navigation --}}
                        <ul class="nav nav-tabs mb-3" id="permissionTabs" role="tablist">
                            @foreach($groups as $index => $group)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                            id="tab-{{ Str::slug($group) }}" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#pane-{{ Str::slug($group) }}" 
                                            type="button" 
                                            role="tab">
                                        {{ $group }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content" id="permissionTabsContent">
                            @foreach($groups as $group)
                                @php
                                    $groupPermissions = $permissions[$group] ?? collect();
                                    $groupId = Str::slug($group);
                                @endphp
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                     id="pane-{{ $groupId }}" 
                                     role="tabpanel">
                                    
                                    {{-- Group-level Select/Deselect --}}
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">{{ $group }}</h5>
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input group-select-all" 
                                                       type="checkbox" 
                                                       id="selectAll-{{ $groupId }}"
                                                       data-group="{{ $groupId }}">
                                                <label class="form-check-label" for="selectAll-{{ $groupId }}">
                                                    Select All in this Group
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Permissions Grid --}}
                                    <div class="row">
                                        @forelse($groupPermissions as $permission)
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" 
                                                        name="permissions[]" 
                                                        value="{{ $permission->name }}" 
                                                        id="perm_{{ $permission->id }}"
                                                        class="form-check-input permission-checkbox"
                                                        data-group="{{ $groupId }}"
                                                        {{ in_array($permission->name, $directPermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">No permissions in this group.</div>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-end mt-3">
                            <a href="{{ route('admin.staff.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Permissions</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
$(document).ready(function() {
    // Update selected count function
    function updateSelectedCount() {
        var total = $('.permission-checkbox').length;
        var checked = $('.permission-checkbox:checked').length;
        $('#selectedCount').text(checked + ' / ' + total + ' selected');
    }

    // Initial count
    updateSelectedCount();

    // Global Select All
    $('#selectAllBtn').click(function() {
        $('.permission-checkbox').prop('checked', true);
        updateSelectedCount();
        updateGroupSelectAllCheckboxes();
    });

    // Global Deselect All
    $('#deselectAllBtn').click(function() {
        $('.permission-checkbox').prop('checked', false);
        updateSelectedCount();
        updateGroupSelectAllCheckboxes();
    });

    // Group Select All checkbox change
    $('.group-select-all').change(function() {
        var group = $(this).data('group');
        var isChecked = $(this).prop('checked');
        $('.permission-checkbox[data-group="' + group + '"]').prop('checked', isChecked);
        updateSelectedCount();
    });

    // Individual permission checkbox change
    $(document).on('change', '.permission-checkbox', function() {
        updateSelectedCount();
        updateGroupSelectAllCheckboxes();
    });

    // Update group select-all checkboxes based on individual checkboxes
    function updateGroupSelectAllCheckboxes() {
        $('.group-select-all').each(function() {
            var group = $(this).data('group');
            var groupCheckboxes = $('.permission-checkbox[data-group="' + group + '"]');
            var allChecked = groupCheckboxes.length === groupCheckboxes.filter(':checked').length;
            var anyChecked = groupCheckboxes.filter(':checked').length > 0;

            $(this).prop('checked', allChecked);
            // Optional: set indeterminate if some but not all checked
            $(this).prop('indeterminate', !allChecked && anyChecked);
        });
    }

    // Initialize group select-all checkboxes on load
    updateGroupSelectAllCheckboxes();
});
</script>
@endpush