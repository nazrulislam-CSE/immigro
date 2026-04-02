<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'photo', 'brand_name', 'size', 'price',
        'color', 'discount', 'seller_price', 'customer_price', 'note', 'status'
    ];

    protected $casts = [
        'price' => 'float',
        'discount' => 'float',
        'seller_price' => 'float',
        'customer_price' => 'float',
        'status' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(ProductOrder::class);
    }
}