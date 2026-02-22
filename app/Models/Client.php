<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'phone_number',
        'address',
        'country_name',
        'work_category',
        'processing_time',
        'date',
        'visa_category',
        'transport_number',
        'total_amount',
        'agent_name',
        'agent_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}