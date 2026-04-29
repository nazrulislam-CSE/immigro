<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile_number',
        'address',
        'previous_due',
        'created_by',
        'updated_by',
    ];

    // 👇 Auto tracking created_by & updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            if (Auth::guard('admin')->check()) {
                $supplier->created_by = Auth::guard('admin')->id();
            }
        });

        static::updating(function ($supplier) {
            if (Auth::guard('admin')->check()) {
                $supplier->updated_by = Auth::guard('admin')->id();
            }
        });
    }
}