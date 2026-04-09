<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;

class BooksController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $featuredBooks = Book::latest()->take(6)->get();
        $newArrivals   = Book::inRandomOrder()->take(6)->get();

        $stats = [
            'total_purchases' => Auth::check()
                ? Order::where('user_id', Auth::id())
                ->where('status', 'completed')
                ->count()
                : 0,

            'cart_count' => Auth::check()
                ? Cart::where('user_id', Auth::id())->sum('quantity')
                : 0,

            'wishlist_count' => Auth::check()
                ? Wishlist::where('user_id', Auth::id())->count()
                : 0,
        ];

        return view('dashboard', compact('featuredBooks', 'newArrivals', 'stats'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function adminDashboard()
    {
        $totalBooks  = Book::count();
        $totalUsers  = User::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'totalOrders'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CATALOG
    |--------------------------------------------------------------------------
    */
    public function catalog(Request $request)
    {
        $query = Book::query()->where(function ($q) {
            $q->where('status', 'available')
                ->orWhereNull('status');
        });

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type') && in_array($request->type, ['physical', 'digital'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('letter') && $request->letter !== 'all') {
            $query->where('title', 'like', $request->letter . '%');
        }

        switch ($request->sort) {
            case 'title-desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('title', 'asc');
                break;
        }

        $books = $query->paginate(12);

        $books->getCollection()->transform(function ($book) {
            $book->genre_list = $book->genre ? json_decode($book->genre) : [];
            return $book;
        });

        return view('catalog', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        $book->genre_list = $book->genre ? json_decode($book->genre, true) : [];
        $book->cover_url = $book->cover ? asset('storage/' . $book->cover) : null;

        return view('book-detail', compact('book'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST BOOKS
    |--------------------------------------------------------------------------
    */
    public function manageBooks()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.books.create');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - STORE BOOK
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'price'     => 'required|numeric',
            'stock'     => 'required|integer|min:0',
            'type' => 'required|in:physical,digital',
            'cover'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'synopsis'  => 'nullable|string|max:1000'
        ]);

        $data['author'] = $request->author ?? 'Unknown Author';
        $data['isbn'] = 'ISBN-' . time() . rand(100,999);
        $data['status'] = 'available';
        $data['cover'] = $request->file('cover')->store('covers', 'public');

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - EDIT FORM
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE BOOK
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'stock'     => 'required|integer|min:0',
        ]);

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Stok berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE BOOK
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | API - GET ALL BOOKS
    |--------------------------------------------------------------------------
    */
    public function apiIndex(Request $request)
    {
        $query = Book::query();

        $query->where(function ($q) {
            $q->where('status', 'available')
                ->orWhereNull('status');
        });

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%')
                    ->orWhere('authors', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type') && in_array($request->type, ['physical', 'digital'])) {
            $query->where(function ($q) use ($request) {
                $q->where('type', $request->type)
                  ->orWhere('book_type', $request->type);
            });
        }

        if ($request->filled('letter') && $request->letter !== 'all') {
            $query->where('title', 'like', $request->letter . '%');
        }

        switch ($request->sort) {
            case 'title-desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('title', 'asc');
                break;
        }

        $books = $query->get();

        $books->transform(function ($book) {
            $book->authors = $book->author ?? $book->authors ?? 'Unknown Author';
            $book->book_type = $book->book_type ?? $book->type ?? 'physical';
            $book->cover = $book->cover ? asset('storage/' . $book->cover) : null;
            $book->genre_list = $book->genre ? json_decode($book->genre) : [];
$book->price = (float) $book->price;
            return $book;
        });

        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | API - GET FEATURED BOOKS
    |--------------------------------------------------------------------------
    */
    public function apiFeatured()
    {
        $books = Book::where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        $books->transform(function ($book) {
            $book->genre_list = $book->genre ? json_decode($book->genre) : [];
            return $book;
        });

        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }
}

