<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'order',
        'status'
    ];

    // Optional: scope for active items
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Optional: scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}