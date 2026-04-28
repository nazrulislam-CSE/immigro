<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_name',
        'mobile_number',
        'agent_id',
        'no_area',
        'photo',
        'created_by',
        'updated_by',
    ];

    // 👇 Auto tracking created_by & updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agent) {
            if (Auth::guard('admin')->check()) {
                $agent->created_by = Auth::guard('admin')->id();
            }
        });

        static::updating(function ($agent) {
            if (Auth::guard('admin')->check()) {
                $agent->updated_by = Auth::guard('admin')->id();
            }
        });
    }
}