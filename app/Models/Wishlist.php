<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'book_title',
        'book_author',
        'book_cover',
        'book_price',
        'book_type',
    ];

    /**
     * Relationship: Wishlist belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}