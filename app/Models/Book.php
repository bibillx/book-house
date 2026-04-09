<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'authors',
        'publisher',
        'description',
        'cover',
        'type',
        'price',
        'published_date',
        'stock',
        'synopsis',
        'genre',
        'status',
        'isbn',
        'book_type',
    ];

    // Scope untuk mengambil buku yang tersedia saja
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}

