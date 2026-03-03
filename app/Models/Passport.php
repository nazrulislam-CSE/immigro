<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'mobile_no',
        'visa_type',
        'passport_number',
        'address',
        'country',
        'date',
        'received_by',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}