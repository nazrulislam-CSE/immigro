<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSale extends Model
{
    use HasFactory;

    protected $table = 'book_sales';

    protected $fillable = [
        'book_name', 'writer_name', 'photo', 'page', 'price',
        'discount', 'seller_price', 'customer_price', 'status'
    ];

    protected $casts = [
        'price' => 'float',
        'discount' => 'float',
        'seller_price' => 'float',
        'customer_price' => 'float',
        'status' => 'integer',
    ];

    // Status badge helper
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
}