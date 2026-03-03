<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffAttendance;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Get filter inputs
        $staff_id = $request->get('staff_id');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $status = $request->get('status');

        // Build query
        $query = StaffAttendance::with('staff');

        if ($staff_id) {
            $query->where('staff_id', $staff_id);
        }
        if ($date_from) {
            $query->whereDate('attendance_date', '>=', $date_from);
        }
        if ($date_to) {
            $query->whereDate('attendance_date', '<=', $date_to);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->get();

        // Get all staff for dropdown
        $allStaff = Staff::all();

        $pageTitle = 'Staff Attendance';
        return view('admin.staff.attendance.index', compact('attendances', 'allStaff', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id'          => 'required|exists:staff,id',
            'attendance_date'   => 'required|date|unique:staff_attendances,attendance_date,NULL,id,staff_id,' . $request->staff_id,
            'status'            => 'required|string|in:present,absent,late,half-day,holiday',
            'check_in'          => 'nullable|date_format:H:i',
            'check_out'         => 'nullable|date_format:H:i',
            'overtime_hours'    => 'nullable|numeric|min:0',
            'notes'             => 'nullable|string',
        ]);

        StaffAttendance::create($validated);

        return redirect()->route('admin.staff.attendance.index')->with('success', 'Attendance added successfully.');
    }

    public function update(Request $request, $id)
    {
        $attendance = StaffAttendance::findOrFail($id);

        $validated = $request->validate([
            'staff_id'          => 'required|exists:staff,id',
            'attendance_date'   => 'required|date|unique:staff_attendances,attendance_date,' . $id . ',id,staff_id,' . $request->staff_id,
            'status'            => 'required|string|in:present,absent,late,half-day,holiday',
            'check_in'          => 'nullable|date_format:H:i',
            'check_out'         => 'nullable|date_format:H:i',
            'overtime_hours'    => 'nullable|numeric|min:0',
            'notes'             => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('admin.staff.attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = StaffAttendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.staff.attendance.index')->with('success', 'Attendance deleted successfully.');
    }
}