<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        $pageTitle = 'Staff List';
        return view('admin.staff.index', compact('staff', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_name'               => 'required|string|max:255',
            'mobile_number'             => 'nullable|string|max:20',
            'photo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'academic_qualification'    => 'nullable|string',
            'experience'                => 'nullable|string',
            'present_address'           => 'nullable|string',
            'permanent_address'         => 'nullable|string',
            'basic_salary'              => 'nullable|numeric',
            'house_rent'                => 'nullable|numeric',
            'medical_allowance'         => 'nullable|numeric',
            'target_incentive'          => 'nullable|numeric',
            'gross_salary'              => 'nullable|numeric',
            'payment_system'            => 'nullable|string|in:cash,bkash,nagad,rocket,bank',
            'mobile_banking_number'     => 'nullable|string|max:20|required_if:payment_system,bkash,nagad,rocket',
            'bank_name'                 => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_name'              => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_number'            => 'nullable|string|max:255|required_if:payment_system,bank',
            'branch'                    => 'nullable|string|max:255',
            'payment_amount'            => 'nullable|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('staff', 'public');
            $validated['photo'] = $path;
        }

        Staff::create($validated);

        return redirect()->route('admin.staff.index')->with('success', 'Staff added successfully.');
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'staff_name'               => 'required|string|max:255',
            'mobile_number'             => 'nullable|string|max:20',
            'photo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'academic_qualification'    => 'nullable|string',
            'experience'                => 'nullable|string',
            'present_address'           => 'nullable|string',
            'permanent_address'         => 'nullable|string',
            'basic_salary'              => 'nullable|numeric',
            'house_rent'                => 'nullable|numeric',
            'medical_allowance'         => 'nullable|numeric',
            'target_incentive'          => 'nullable|numeric',
            'gross_salary'              => 'nullable|numeric',
            'payment_system'            => 'nullable|string|in:cash,bkash,nagad,rocket,bank',
            'mobile_banking_number'     => 'nullable|string|max:20|required_if:payment_system,bkash,nagad,rocket',
            'bank_name'                 => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_name'              => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_number'            => 'nullable|string|max:255|required_if:payment_system,bank',
            'branch'                    => 'nullable|string|max:255',
            'payment_amount'            => 'nullable|numeric',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $path = $request->file('photo')->store('staff', 'public');
            $validated['photo'] = $path;
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully.');
    }
}