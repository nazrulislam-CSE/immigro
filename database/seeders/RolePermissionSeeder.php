<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // পারমিশন ক্যাশ রিসেট
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ========= ১. মূল মডিউলসমূহ (শুধু view পারমিশন) =========
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

        foreach ($modules as $moduleName => $groupName) {
            Permission::firstOrCreate([
                'name'       => "view {$moduleName}",
                'guard_name' => 'admin',
                'group_name' => $groupName
            ]);
        }

        // ========= ২. CRUD পারমিশন (create, edit, delete) =========
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

        // ========= ৩. বিশেষ পারমিশন (যেগুলো CRUD-এর বাইরে) =========
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
            // Online Apply, Software Sale, Books (view only)
            ['name' => 'view online apply', 'group' => 'Online Apply'],
            ['name' => 'view software sale', 'group' => 'Software Sale'],
            ['name' => 'view books', 'group' => 'Books'],
        ];

        foreach ($specialPermissions as $perm) {
            Permission::firstOrCreate([
                'name'       => $perm['name'],
                'guard_name' => 'admin',
                'group_name' => $perm['group']
            ]);
        }

        // ========= ৪. রোল তৈরি =========
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $adminRole      = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        $staffRole      = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'admin']);
        $agentRole      = Role::firstOrCreate(['name' => 'Agent', 'guard_name' => 'admin']);

        // ========= ৫. রোলগুলিতে পারমিশন অ্যাসাইন =========
        // Super Admin ও Admin সব পারমিশন পাবে
        $superAdminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo(Permission::all());

        // Staff রোলের পারমিশন (নিজের তথ্য ও উপস্থিতি)
        $staffRole->givePermissionTo([
            'view Staff',
            'view staff payments',
            'view staff attendance',
        ]);

        // Agent রোলের পারমিশন
        $agentRole->givePermissionTo([
            'view Agents',
        ]);

        // ========= ৬. ডিফল্ট সুপার অ্যাডমিন ইউজার =========
        $superAdmin = Admin::first();
        if (!$superAdmin) {
            $superAdmin = Admin::create([
                'name'          => 'Super Admin',
                'username'      => 'admin',
                'email'         => 'admin@gmail.com',
                'password'      => Hash::make('12345678'),
                'show_password' => '12345678',
                'status'        => 1,
            ]);
        }
        $superAdmin->assignRole($superAdminRole);

        // ========= ৭. স্টাফ ইউজার তৈরি (admins ও staff টেবিলে) =========
        $staffAdmin = Admin::where('email', 'staff@gmail.com')->first();
        if (!$staffAdmin) {
            $staffAdmin = Admin::create([
                'name'          => 'Staff User',
                'username'      => 'staff',
                'email'         => 'staff@gmail.com',
                'password'      => Hash::make('12345678'),
                'show_password' => '12345678',
                'status'        => 1,
            ]);
        }
        $staffAdmin->assignRole($staffRole);

        // staff টেবিলে ডেটা ইনসার্ট/আপডেট
        Staff::updateOrCreate(
            ['admin_id' => $staffAdmin->id],
            [
                'staff_name'         => 'Staff User',
                'mobile_number'      => '01700000000',
                'basic_salary'       => 20000,
                'house_rent'         => 5000,
                'medical_allowance'  => 2000,
                'target_incentive'   => 1000,
                'gross_salary'       => 28000,
                'payment_system'     => 'cash',
                'admin_id'           => $staffAdmin->id,
                'role_id'            => $staffRole->id,
            ]
        );

        // ========= ৮. এজেন্ট ইউজার তৈরি (admins ও staff টেবিলে) =========
        $agentAdmin = Admin::where('email', 'agent@gmail.com')->first();
        if (!$agentAdmin) {
            $agentAdmin = Admin::create([
                'name'          => 'Agent User',
                'username'      => 'agent',
                'email'         => 'agent@gmail.com',
                'password'      => Hash::make('12345678'),
                'show_password' => '12345678',
                'status'        => 1,
            ]);
        }
        $agentAdmin->assignRole($agentRole);

        Staff::updateOrCreate(
            ['admin_id' => $agentAdmin->id],
            [
                'staff_name'     => 'Agent User',
                'mobile_number'  => '01800000000',
                'basic_salary'   => 15000,
                'gross_salary'   => 15000,
                'payment_system' => 'bkash',
                'admin_id'       => $agentAdmin->id,
                'role_id'        => $agentRole->id,
            ]
        );
    }
}