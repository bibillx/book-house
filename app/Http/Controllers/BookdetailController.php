<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookDetailController extends Controller
{
    /**
     * Show the book detail page.
     * Fetches data from your existing books API route.
     */
    public function show(string $id)
    {
        // Reuse your existing API endpoint
        // Adjust the URL if your local API route is different
        try {
            $response = Http::get(url("/api/books/{$id}"));

            if ($response->successful()) {
                $result = $response->json();

                if ($result['success'] ?? false) {
                    $book = $result['data'];

                    // Normalise cover URL (same logic as catalog.blade.php)
                    if (!empty($book['cover']) && !str_starts_with($book['cover'], 'http')) {
                        $book['cover'] = asset('storage/' . $book['cover']);
                    }

                    return view('book-detail', compact('book'));
                }
            }
        } catch (\Exception $e) {
            // fall through to 404
        }

        abort(404, 'Book not found');
    }
}