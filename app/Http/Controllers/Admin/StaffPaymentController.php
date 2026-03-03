<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffPayment;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffPaymentController extends Controller
{
    public function index(Request $request)
    {
        // Get filter inputs
        $staff_id = $request->get('staff_id');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $payment_type = $request->get('payment_type');

        // Build query
        $query = StaffPayment::with('staff');

        if ($staff_id) {
            $query->where('staff_id', $staff_id);
        }
        if ($date_from) {
            $query->whereDate('payment_date', '>=', $date_from);
        }
        if ($date_to) {
            $query->whereDate('payment_date', '<=', $date_to);
        }
        if ($payment_type) {
            $query->where('payment_type', $payment_type);
        }

        $payments = $query->orderBy('payment_date', 'desc')->get();

        // Get all staff for dropdown and status summary
        $allStaff = Staff::all();

        // Calculate payment summary for each staff
        $staffSummary = [];
        foreach ($allStaff as $staff) {
            $totalPaid = StaffPayment::where('staff_id', $staff->id)->sum('amount');
            $gross = $staff->gross_salary ?? 0;
            $status = 'Unpaid';
            if ($totalPaid >= $gross && $gross > 0) {
                $status = 'Paid';
            } elseif ($totalPaid > 0) {
                $status = 'Partially Paid';
            }
            $staffSummary[] = [
                'id' => $staff->id,
                'name' => $staff->staff_name,
                'gross' => $gross,
                'total_paid' => $totalPaid,
                'status' => $status,
            ];
        }

        $pageTitle = 'Staff Payments';
        return view('admin.staff.payments.index', compact('payments', 'allStaff', 'staffSummary', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id'       => 'required|exists:staff,id',
            'payment_date'   => 'required|date',
            'amount'         => 'required|numeric|min:0',
            'payment_type'   => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'reference'      => 'nullable|string|max:255',
            'notes'          => 'nullable|string',
        ]);

        StaffPayment::create($validated);

        return redirect()->route('admin.staff.payment.index')->with('success', 'Payment added successfully.');
    }

    public function update(Request $request, $id)
    {
        $payment = StaffPayment::findOrFail($id);

        $validated = $request->validate([
            'staff_id'       => 'required|exists:staff,id',
            'payment_date'   => 'required|date',
            'amount'         => 'required|numeric|min:0',
            'payment_type'   => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'reference'      => 'nullable|string|max:255',
            'notes'          => 'nullable|string',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.staff.payment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = StaffPayment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.staff.payment.index')->with('success', 'Payment deleted successfully.');
    }
}