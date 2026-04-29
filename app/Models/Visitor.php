<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'interacted_country',
        'visa_category',
        'date',
        'next_followup',
        'followup_result',
        'comments',
        'counsellor_name',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date'          => 'date',
        'next_followup' => 'date',
    ];

    // 👇 Auto tracking created_by & updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($visitor) {
            if (Auth::guard('admin')->check()) {
                $visitor->created_by = Auth::guard('admin')->id();
            }
        });

        static::updating(function ($visitor) {
            if (Auth::guard('admin')->check()) {
                $visitor->updated_by = Auth::guard('admin')->id();
            }
        });
    }
}