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
        // ক্যাশ রিসেট
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ========= ১. পারমিশন তৈরি =========
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
            'Advance Settings' => 'Advance Settings'
        ];

        // প্রতিটি মডিউলের জন্য 'view' পারমিশন
        foreach ($modules as $moduleName => $groupName) {
            Permission::firstOrCreate([
                'name'       => "view {$moduleName}",
                'guard_name' => 'admin',
                'group_name' => $groupName
            ]);
        }

        // যে মডিউলগুলোতে create/edit/delete লাগবে
        $crudModules = ['Visitors', 'Clients', 'Agents', 'Suppliers', 'Invoices',
                        'Passports', 'Refunds', 'Staff', 'Sections', 'Sliders',
                        'Pages', 'Teams', 'Partners', 'Testimonials', 'Counters',
                        'Services', 'Gallery', 'Advance Settings'];

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

        // স্পেশাল পারমিশন (supplier payments, staff payments, staff attendance)
        Permission::firstOrCreate([
            'name'       => 'view supplier payments',
            'guard_name' => 'admin',
            'group_name' => 'Suppliers'
        ]);
        Permission::firstOrCreate([
            'name'       => 'view staff payments',
            'guard_name' => 'admin',
            'group_name' => 'Staff'
        ]);
        Permission::firstOrCreate([
            'name'       => 'view staff attendance',
            'guard_name' => 'admin',
            'group_name' => 'Staff'
        ]);

        // ========= ২. রোল তৈরি =========
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $adminRole      = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        $managerRole    = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'admin']);
        $staffRole      = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'admin']);

        // ========= ৩. রোলগুলিতে পারমিশন অ্যাসাইন =========
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole->givePermissionTo([
            'view Dashboard',
            'view Visitors', 'create Visitors', 'edit Visitors', 'delete Visitors',
            'view Clients', 'create Clients', 'edit Clients', 'delete Clients',
            'view Agents', 'create Agents', 'edit Agents', 'delete Agents',
            'view Suppliers', 'create Suppliers', 'edit Suppliers', 'delete Suppliers',
            'view supplier payments',
            'view Invoices', 'create Invoices', 'edit Invoices', 'delete Invoices',
            'view Passports', 'create Passports', 'edit Passports', 'delete Passports',
            'view Refunds', 'create Refunds', 'edit Refunds', 'delete Refunds',
            'view Staff', 'create Staff', 'edit Staff', 'delete Staff',
            'view staff payments', 'view staff attendance',
            'view SMS',
            'view Sections', 'create Sections', 'edit Sections', 'delete Sections',
            'view Sliders', 'create Sliders', 'edit Sliders', 'delete Sliders',
            'view About',
            'view Pages', 'create Pages', 'edit Pages', 'delete Pages',
            'view Menu Builder',
            'view Teams', 'create Teams', 'edit Teams', 'delete Teams',
            'view Partners', 'create Partners', 'edit Partners', 'delete Partners',
            'view Testimonials', 'create Testimonials', 'edit Testimonials', 'delete Testimonials',
            'view Counters', 'create Counters', 'edit Counters', 'delete Counters',
            'view Services', 'create Services', 'edit Services', 'delete Services',
            'view Gallery', 'create Gallery', 'edit Gallery', 'delete Gallery',
        ]);

        $managerRole->givePermissionTo([
            'view Dashboard',
            'view Visitors', 'create Visitors', 'edit Visitors',
            'view Clients', 'create Clients', 'edit Clients',
            'view Agents', 'create Agents', 'edit Agents',
            'view Suppliers', 'create Suppliers', 'edit Suppliers',
            'view supplier payments',
            'view Invoices', 'create Invoices', 'edit Invoices',
            'view Passports', 'create Passports', 'edit Passports',
            'view Refunds', 'create Refunds', 'edit Refunds',
            'view Staff', 'create Staff', 'edit Staff',
            'view staff payments', 'view staff attendance',
            'view SMS',
            'view Sections', 'create Sections', 'edit Sections',
            'view Sliders', 'create Sliders', 'edit Sliders',
            'view About',
            'view Pages', 'create Pages', 'edit Pages',
            'view Menu Builder',
            'view Teams', 'create Teams', 'edit Teams',
            'view Partners', 'create Partners', 'edit Partners',
            'view Testimonials', 'create Testimonials', 'edit Testimonials',
            'view Counters', 'create Counters', 'edit Counters',
            'view Services', 'create Services', 'edit Services',
            'view Gallery', 'create Gallery', 'edit Gallery',
        ]);

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