<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $guarded = [];
    protected $guard_name = 'admin'; 

    public static function getpermissionGroups()
    {
        return Permission::select('group_name')
            ->distinct()
            ->pluck('group_name')
            ->toArray();
    }

    public static function getPermissionsByGroup($group_name)
    {
        return Permission::where('group_name', $group_name)->get();
    }

}