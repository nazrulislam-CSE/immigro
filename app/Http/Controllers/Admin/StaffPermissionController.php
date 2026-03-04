<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaffPermissionController extends Controller
{
    /**
     * Display a listing of staff for permission management.
     */
    public function index()
    {
        $staffMembers = Staff::with('admin', 'role')->latest()->get();
        $pageTitle = 'Staff Permissions';
        return view('admin.staff.permissions.index', compact('staffMembers', 'pageTitle'));
    }

    /**
     * Show the form for editing permissions of a specific staff member.
     */
    public function edit($id)
    {
        $staff = Staff::with('admin')->findOrFail($id);
        $admin = $staff->admin;

        // Get all permissions grouped by module
        $groups = Admin::getpermissionGroups(); // returns array of group names
        $permissions = Permission::all()->groupBy('group_name');

        // Get the role of the staff
        $role = $staff->role;

        // Get direct permissions of the admin (for pre-checking)
        $directPermissions = $admin->getDirectPermissions()->pluck('name')->toArray();

        $pageTitle = 'Manage Permissions: ' . $staff->staff_name;

        return view('admin.staff.permissions.edit', compact('staff', 'admin', 'groups', 'permissions', 'role', 'directPermissions', 'pageTitle'));
    }


    public function show($id)
{
    $staff = Staff::with('admin')->findOrFail($id);
    $admin = $staff->admin;

    // Get all permissions grouped by module
    $groups = Admin::getpermissionGroups();
    $permissions = Permission::all()->groupBy('group_name');

    // Get the role of the staff
    $role = $staff->role;

    // Get direct permissions of the admin
    $directPermissions = $admin->getDirectPermissions()->pluck('name')->toArray();

    // Get all permissions via role
    $rolePermissions = $role ? $role->permissions->pluck('name')->toArray() : [];

    $pageTitle = 'View Permissions: ' . $staff->staff_name;

    return view('admin.staff.permissions.show', compact('staff', 'admin', 'groups', 'permissions', 'role', 'directPermissions', 'rolePermissions', 'pageTitle'));
}

    /**
     * Update the permissions for the staff (admin).
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::with('admin')->findOrFail($id);
        $admin = $staff->admin;

        // Validate: permissions must exist
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        // Get the permission names from the request
        $permissionNames = $request->input('permissions', []);

        // Sync the direct permissions (this will remove any direct permissions not in the list)
        $admin->syncPermissions($permissionNames);

        return redirect()->route('admin.staff.permissions.index')
            ->with('success', 'Permissions updated successfully for ' . $staff->staff_name);
    }
}