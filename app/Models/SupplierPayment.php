<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'payment_category',
        'total_amount',
        'total_pay',
        'due',
        'due_pay_date',
        'date',
        'payment_purpose',
        'applicable_fee',
        'visa_category',
    ];

    protected $casts = [
        'date' => 'date',
        'due_pay_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}