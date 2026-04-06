<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'book_title',
        'book_author',
        'book_cover',
        'book_price',
        'book_type',
        'quantity',
    ];

    /**
     * Relationship: OrderItem belongs to Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
