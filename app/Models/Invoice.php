<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'client_id',
        'mobile',
        'country_name',
        'total_amount',
        'advance_pay',
        'due',
        'processing_time',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // Generate invoice number: INV-YYYYMMDD-XXXX (incrementing)
            $date = now()->format('Ymd');
            $lastInvoice = self::whereDate('created_at', today())->orderBy('id', 'desc')->first();
            if ($lastInvoice) {
                $lastNumber = intval(substr($lastInvoice->invoice_no, -4));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }
            $invoice->invoice_no = 'INV-' . $date . '-' . $newNumber;
        });
    }
}