<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'date'          => 'date',
        'next_followup' => 'date',
    ];
}