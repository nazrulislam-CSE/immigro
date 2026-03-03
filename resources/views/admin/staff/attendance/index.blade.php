@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attendanceModal" id="addAttendanceBtn">
                        <i class="fas fa-plus"></i> Add Attendance
                    </button>
                </div>
                <div class="card-body">
                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('admin.staff.attendance.index') }}" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="staff_id" class="form-label">Staff</label>
                            <select class="form-control" name="staff_id" id="staff_id">
                                <option value="">All Staff</option>
                                @foreach($allStaff as $staff)
                                    <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->staff_name }}</option>
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
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">All Status</option>
                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                                <option value="half-day" {{ request('status') == 'half-day' ? 'selected' : '' }}>Half Day</option>
                                <option value="holiday" {{ request('status') == 'holiday' ? 'selected' : '' }}>Holiday</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.staff.attendance.index') }}" class="btn btn-secondary">Reset</a>
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
                                    <th>Staff Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Overtime (hrs)</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $key => $att)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $att->staff->staff_name ?? '' }}</td>
                                    <td>{{ $att->attendance_date->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $badge = match($att->status) {
                                                'present' => 'success',
                                                'absent' => 'danger',
                                                'late' => 'warning',
                                                'half-day' => 'info',
                                                'holiday' => 'secondary',
                                                default => 'light'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badge }}">{{ ucfirst($att->status) }}</span>
                                    </td>
                                    <td>{{ $att->check_in }}</td>
                                    <td>{{ $att->check_out }}</td>
                                    <td>{{ $att->overtime_hours }}</td>
                                    <td>{{ $att->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary edit-btn"
                                            data-id="{{ $att->id }}"
                                            data-staff_id="{{ $att->staff_id }}"
                                            data-attendance_date="{{ $att->attendance_date->format('Y-m-d') }}"
                                            data-status="{{ $att->status }}"
                                            data-check_in="{{ $att->check_in }}"
                                            data-check_out="{{ $att->check_out }}"
                                            data-overtime_hours="{{ $att->overtime_hours }}"
                                            data-notes="{{ $att->notes }}"
                                            data-bs-toggle="modal" data-bs-target="#attendanceModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.staff.attendance.delete', $att->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No attendance records found.</td>
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

{{-- Attendance Modal (Add/Edit) --}}
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="attendanceForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendanceModalLabel">Add Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="staff_id" class="form-label">Staff *</label>
                        <select class="form-control" name="staff_id" id="staff_id" required>
                            <option value="">Select Staff</option>
                            @foreach($allStaff as $s)
                                <option value="{{ $s->id }}">{{ $s->staff_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attendance_date" class="form-label">Date *</label>
                        <input type="date" class="form-control" name="attendance_date" id="attendance_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Select Status</option>
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                            <option value="half-day">Half Day</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In Time</label>
                        <input type="time" class="form-control" name="check_in" id="check_in">
                    </div>
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out Time</label>
                        <input type="time" class="form-control" name="check_out" id="check_out">
                    </div>
                    <div class="mb-3">
                        <label for="overtime_hours" class="form-label">Overtime Hours</label>
                        <input type="number" step="0.5" class="form-control" name="overtime_hours" id="overtime_hours" placeholder="0.0">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" id="notes" rows="2"></textarea>
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
        $('#attendanceModal').on('hidden.bs.modal', function () {
            $('#attendanceForm')[0].reset();
            $('#method').val('POST');
            $('#attendanceForm').attr('action', '{{ route("admin.staff.attendance.store") }}');
            $('#attendanceModalLabel').text('Add Attendance');
        });

        // Edit button
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            $('#staff_id').val($(this).data('staff_id'));
            $('#attendance_date').val($(this).data('attendance_date'));
            $('#status').val($(this).data('status'));
            $('#check_in').val($(this).data('check_in'));
            $('#check_out').val($(this).data('check_out'));
            $('#overtime_hours').val($(this).data('overtime_hours'));
            $('#notes').val($(this).data('notes'));

            // Trigger change to update any custom select plugins
            $('#staff_id, #status').trigger('change');

            $('#method').val('POST');
            $('#attendanceForm').attr('action', '{{ route("admin.staff.attendance.update", "") }}/' + id);
            $('#attendanceModalLabel').text('Edit Attendance');
        });

        // Add button
        $('#addAttendanceBtn').click(function() {
            $('#attendanceForm')[0].reset();
            $('#method').val('POST');
            $('#attendanceForm').attr('action', '{{ route("admin.staff.attendance.store") }}');
            $('#attendanceModalLabel').text('Add Attendance');
        });
    });
</script>
@endpush