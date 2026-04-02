<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = 'product_orders';

    protected $fillable = [
        'product_id','customer_price', 'quantity', 'customer_name', 'mobile_number', 'shipping_cost', 'advance_payment',
        'payment_method', 'shipping_address', 'thana', 'district', 'status'
    ];

    protected $casts = [
        'customer_price' => 'float',
        'quantity' => 'integer',
        'shipping_cost' => 'float',
        'advance_payment' => 'float',
        'status' => 'integer',
    ];

    // Helper for status badge
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 0: return '<span class="badge bg-warning">Pending</span>';
            case 1: return '<span class="badge bg-info">Approved</span>';
            case 2: return '<span class="badge bg-success">Paid</span>';
            case 3: return '<span class="badge bg-primary">Delivery</span>';
            default: return '<span class="badge bg-secondary">Unknown</span>';
        }
    }

    // Total price calculation
    public function getTotalPriceAttribute()
    {
        return ($this->customer_price * $this->quantity) + $this->shipping_cost - $this->advance_payment;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}