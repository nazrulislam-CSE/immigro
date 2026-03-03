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
        'total_refund',
        'agent_name',
        'agent_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function updateTotalRefund()
    {
        $this->total_refund = $this->refunds()->sum('refund_amount');
        $this->saveQuietly();
    }
}
