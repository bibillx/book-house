<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'authors',
        'publisher',
        'description',
        'cover',
        'book_type',
        'price',
        'published_date',
        'stock',
        'synopsis',
        'genre',
        'status',
    ];

    // Scope untuk mengambil buku yang tersedia saja
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
