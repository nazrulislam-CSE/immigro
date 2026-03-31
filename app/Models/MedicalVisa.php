<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalVisa extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'publish_date' => 'date',
        'apply_fee' => 'float',
        'visa_fee' => 'float',
        'status' => 'integer',
    ];
}
