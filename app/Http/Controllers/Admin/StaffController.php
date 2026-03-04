<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with(['admin', 'role'])->latest()->get();
        $roles = Role::where('id', '!=', 1)->orderBy('name')->get();
        $pageTitle = 'Staff List';
        return view('admin.staff.index', compact('staff', 'pageTitle', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Admin fields
            'email'                 => 'required|email|unique:admins,email',
            'password'              => 'required|string|min:6',
            'status'                => 'nullable|in:0,1',

            // Staff fields
            'staff_name'            => 'required|string|max:255',
            'mobile_number'         => 'nullable|string|max:20',
            'photo'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'academic_qualification'=> 'nullable|string',
            'experience'            => 'nullable|string',
            'present_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'basic_salary'          => 'nullable|numeric',
            'house_rent'            => 'nullable|numeric',
            'medical_allowance'     => 'nullable|numeric',
            'target_incentive'      => 'nullable|numeric',
            'gross_salary'          => 'nullable|numeric',
            'payment_system'        => 'nullable|string|in:cash,bkash,nagad,rocket,bank',
            'mobile_banking_number' => 'nullable|string|max:20|required_if:payment_system,bkash,nagad,rocket',
            'bank_name'             => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_name'          => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_number'        => 'nullable|string|max:255|required_if:payment_system,bank',
            'branch'                => 'nullable|string|max:255',
            'payment_amount'        => 'nullable|numeric',
            'role_id'               => 'required|exists:roles,id',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('staff', 'public');
            $validated['photo'] = $path;
        }

        // Create Admin user
        $admin = Admin::create([
            'name'          => $validated['staff_name'],
            'username'      => $validated['staff_name'],
            'email'         => $validated['email'],
            'phone'         => $validated['mobile_number'] ?? null,
            'password'      => Hash::make($validated['password']),
            'show_password' => $validated['password'], // if you store plain password
            'status'        => $validated['status'] ?? 1,
        ]);

        // Create Staff record linked to the Admin
        $staffData = $validated;
        $staffData['admin_id'] = $admin->id;
        $staff = Staff::create($staffData);

        // Assign role to the Admin
        $role = Role::findById($validated['role_id']);
        $admin->assignRole($role->name);

        return redirect()->route('admin.staff.index')->with('success', 'Staff added successfully.');
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::with('admin')->findOrFail($id);
        $admin = $staff->admin;

        $validated = $request->validate([
            // Admin fields (optional)
            'email'                 => 'required|email|unique:admins,email,' . $admin->id,
            'password'              => 'nullable|string|min:6',
            'status'                => 'nullable|in:0,1',

            // Staff fields
            'staff_name'            => 'required|string|max:255',
            'mobile_number'         => 'nullable|string|max:20',
            'photo'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'academic_qualification'=> 'nullable|string',
            'experience'            => 'nullable|string',
            'present_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'basic_salary'          => 'nullable|numeric',
            'house_rent'            => 'nullable|numeric',
            'medical_allowance'     => 'nullable|numeric',
            'target_incentive'      => 'nullable|numeric',
            'gross_salary'          => 'nullable|numeric',
            'payment_system'        => 'nullable|string|in:cash,bkash,nagad,rocket,bank',
            'mobile_banking_number' => 'nullable|string|max:20|required_if:payment_system,bkash,nagad,rocket',
            'bank_name'             => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_name'          => 'nullable|string|max:255|required_if:payment_system,bank',
            'account_number'        => 'nullable|string|max:255|required_if:payment_system,bank',
            'branch'                => 'nullable|string|max:255',
            'payment_amount'        => 'nullable|numeric',
            'role_id'               => 'required|exists:roles,id',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $path = $request->file('photo')->store('staff', 'public');
            $validated['photo'] = $path;
        }

        // Update Admin
        $adminData = [
            'name'   => $validated['staff_name'],
            'email'  => $validated['email'],
            'phone'  => $validated['mobile_number'] ?? null,
            'status' => $validated['status'] ?? $admin->status,
        ];
        if (!empty($validated['password'])) {
            $adminData['password'] = Hash::make($validated['password']);
            $adminData['show_password'] = $validated['password'];
        }
        $admin->update($adminData);

        // Update Staff
        $staff->update($validated);

        // Update role if changed
        if ($staff->role_id != $validated['role_id']) {
            $oldRole = Role::findById($staff->role_id);
            $newRole = Role::findById($validated['role_id']);
            $admin->removeRole($oldRole->name);
            $admin->assignRole($newRole->name);
        }

        return redirect()->route('admin.staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = Staff::with('admin')->findOrFail($id);
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }
        // Delete related Admin (which also removes role assignments)
        if ($staff->admin) {
            $staff->admin->delete();
        }
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully.');
    }
}