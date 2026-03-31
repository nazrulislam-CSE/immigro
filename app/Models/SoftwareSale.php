<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareSale extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
        'discount' => 'float',
        'sell_comission' => 'float',
        'monthly_charge' => 'float',
        'status' => 'integer',
    ];
}
