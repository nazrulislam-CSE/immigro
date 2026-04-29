<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'created_by',
        'updated_by',
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

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    // 👇 Auto tracking created_by & updated_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            if (Auth::guard('admin')->check()) {
                $client->created_by = Auth::guard('admin')->id();
            }
        });

        static::updating(function ($client) {
            if (Auth::guard('admin')->check()) {
                $client->updated_by = Auth::guard('admin')->id();
            }
        });
    }
}
