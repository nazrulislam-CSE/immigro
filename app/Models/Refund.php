<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'refund_amount',
        'payment_method',
        'date',
        'reason',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($refund) {
            $refund->client->updateTotalRefund();
        });

        static::deleted(function ($refund) {
            $refund->client->updateTotalRefund();
        });
    }
}