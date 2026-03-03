<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_name',
        'mobile_number',
        'photo',
        'academic_qualification',
        'experience',
        'present_address',
        'permanent_address',
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'target_incentive',
        'gross_salary',
        'payment_system',
        'mobile_banking_number',
        'bank_name',
        'account_name',
        'account_number',
        'branch',
        'payment_amount',
    ];
}