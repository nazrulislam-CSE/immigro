<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ========= ১. মূল মডিউলসমূহ =========
        $modules = [
            'Dashboard' => 'Dashboard',
            'Visitors'  => 'Visitors',
            'Clients'   => 'Clients',
            'Agents'    => 'Agents',
            'Suppliers' => 'Suppliers',
            'Invoices'  => 'Invoices',
            'Passports' => 'Passports',
            'Refunds'   => 'Refunds',
            'Staff'     => 'Staff',
            'SMS'       => 'SMS',
            'Sections'  => 'Sections',
            'Sliders'   => 'Sliders',
            'About'     => 'About',
            'Pages'     => 'Pages',
            'Menu Builder' => 'Menu Builder',
            'Teams'     => 'Teams',
            'Partners'  => 'Partners',
            'Testimonials' => 'Testimonials',
            'Counters'  => 'Counters',
            'Services'  => 'Services',
            'Gallery'   => 'Gallery',
            'Advance Settings' => 'Advance Settings',
            'Training'  => 'Training',
            'Country'   => 'Country',
            'Branch'    => 'Branch',
            'Course'    => 'Course',
            'Education' => 'Education',
            'Visa'      => 'Visa',
            'Online Apply' => 'Online Apply',
            'Software Sale' => 'Software Sale',
            'Books'     => 'Books',
            'Products'  => 'Products',
            'Account'   => 'Account',
        ];

        // View permissions
        foreach ($modules as $moduleName => $groupName) {
            Permission::firstOrCreate([
                'name'       => "view {$moduleName}",
                'guard_name' => 'admin',
                'group_name' => $groupName
            ]);
        }

        // CRUD permissions for standard modules
        $crudModules = [
            'Visitors', 'Clients', 'Agents', 'Suppliers', 'Invoices',
            'Passports', 'Refunds', 'Staff', 'Sections', 'Sliders',
            'Pages', 'Teams', 'Partners', 'Testimonials', 'Counters',
            'Services', 'Gallery', 'Advance Settings',
            'Training', 'Country', 'Education', 'Products'
        ];

        foreach ($crudModules as $module) {
            Permission::firstOrCreate([
                'name'       => "create {$module}",
                'guard_name' => 'admin',
                'group_name' => $module
            ]);
            Permission::firstOrCreate([
                'name'       => "edit {$module}",
                'guard_name' => 'admin',
                'group_name' => $module
            ]);
            Permission::firstOrCreate([
                'name'       => "delete {$module}",
                'guard_name' => 'admin',
                'group_name' => $module
            ]);
        }

        // ========= বিশেষ পারমিশন (যেগুলো CRUD-এর বাইরে) =========
        $specialPermissions = [
            // Supplier payments
            ['name' => 'view supplier payments', 'group' => 'Suppliers'],
            // Staff payments & attendance
            ['name' => 'view staff payments', 'group' => 'Staff'],
            ['name' => 'create staff payments', 'group' => 'Staff'],
            ['name' => 'edit staff payments', 'group' => 'Staff'],
            ['name' => 'delete staff payments', 'group' => 'Staff'],
            ['name' => 'view staff attendance', 'group' => 'Staff'],
            ['name' => 'create staff attendance', 'group' => 'Staff'],
            ['name' => 'edit staff attendance', 'group' => 'Staff'],
            ['name' => 'delete staff attendance', 'group' => 'Staff'],
            // Staff permissions management
            ['name' => 'view staff permissions', 'group' => 'Staff'],
            ['name' => 'create staff permissions', 'group' => 'Staff'],
            ['name' => 'edit staff permissions', 'group' => 'Staff'],
            ['name' => 'delete staff permissions', 'group' => 'Staff'],
            // Visa types
            ['name' => 'view work permit visa', 'group' => 'Visa'],
            ['name' => 'view student visa', 'group' => 'Visa'],
            ['name' => 'view medical visa', 'group' => 'Visa'],
            // Account
            ['name' => 'view income', 'group' => 'Account'],
            ['name' => 'view expense', 'group' => 'Account'],
            ['name' => 'view account statement', 'group' => 'Account'],
            ['name' => 'view due list', 'group' => 'Account'],
        ];

        foreach ($specialPermissions as $perm) {
            Permission::firstOrCreate([
                'name'       => $perm['name'],
                'guard_name' => 'admin',
                'group_name' => $perm['group']
            ]);
        }

        // ========= ২. রোল তৈরি =========
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $adminRole      = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        $managerRole    = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'admin']);
        $staffRole      = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'admin']);

        // ========= ৩. রোলগুলিতে পারমিশন অ্যাসাইন =========
        $superAdminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo(Permission::all());

        // Manager - সব পারমিশন (এখন আর error হবে না)
        $managerRole->givePermissionTo(Permission::all()); // সহজ উপায়

        // Staff - সীমিত পারমিশন
        $staffRole->givePermissionTo([
            'view Staff',
            'view staff payments',
            'view staff attendance',
        ]);

        // ========= ৪. ডিফল্ট সুপার অ্যাডমিন ইউজার =========
        $admin = Admin::first();
        if (!$admin) {
            $admin = Admin::create([
                'name'          => 'Super Admin',
                'username'      => 'admin',
                'email'         => 'admin@gmail.com',
                'password'      => Hash::make('12345678'),
                'show_password' => '12345678',
                'status'        => 1,
            ]);
        }

        $admin->assignRole($superAdminRole);
    }
}