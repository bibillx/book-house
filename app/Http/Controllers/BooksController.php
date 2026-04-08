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
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

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
        // Memulai query builder
        $query = Book::query();

        // 1. Filter Pencarian (Search)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter Tipe Buku (Physical/Digital)
        if ($request->filled('type') && in_array($request->type, ['physical', 'digital'])) {
            $query->where('book_type', $request->type);
        }

        // 3. Filter Berdasarkan Huruf (A-Z)
        if ($request->filled('letter') && $request->letter !== 'all') {
            $query->where('title', 'like', $request->letter . '%');
        }

        // 4. Sorting (Pengurutan)
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
                // Default: Urutkan judul A-Z
                $query->orderBy('title', 'asc');
                break;
        }

        // Ambil data dengan Pagination (misal 12 data per halaman)
        $books = $query->paginate(12);

        //Decode genre JSON di level controller agar ringan
        //(Gunakan getCollection karena sudah menggunakan paginate)
        $books->getCollection()->transform(function ($book) {
            $book->genre_list = $book->genre ? json_decode($book->genre) : [];
            return $book;
        });

        return view('catalog', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        // Decode genre JSON
        $book->genre_list = $book->genre ? json_decode($book->genre, true) : [];
        
        // Full cover path
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
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $books = Book::latest()->paginate(10);
        return view('admin.books', compact('books'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.books.create');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - STORE BOOK
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $request->validate([
            'title'     => 'required',
            'author'   => 'required',
            'price'     => 'required|numeric',
            'stock'     => 'required|numeric',
            'book_type' => 'required|in:physical,digital',
            'cover'     => 'required|image|mimes:jpg,jpeg,png',
            'genre'     => 'nullable|array'
        ]);

        $coverPath = $request->file('cover')->store('covers', 'public');

        $book = Book::create([
            'title'     => $request->title,
            'author'   => $request->author,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'book_type' => $request->book_type,
            'cover'     => $coverPath,
            'synopsis'  => $request->synopsis,
            'genre'     => json_encode($request->genre ?? []),
            'status'    => 'available',
        ]);

        // Debug log to check if book is created
        // \Log::info('Book created: ' . $book->id . ' - ' . $book->title);

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
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

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
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title'     => 'required',
            'author'   => 'required',
            'price'     => 'required|numeric',
            'stock'     => 'required|numeric',
            'book_type' => 'required|in:physical,digital',
            'cover'     => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $book->cover = $coverPath;
        }

            $book->update([
            'title'     => $request->title,
            'author'   => $request->author,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'book_type' => $request->book_type,
            'synopsis'  => $request->synopsis,
            'genre'     => json_encode($request->genre),
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE BOOK
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

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

        // Filter by status (only show available books or books without status)
        $query->where(function ($q) {
            $q->where('status', 'available')
                ->orWhereNull('status');
        });

        // Search by title or author
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by book type
        if ($request->filled('type') && in_array($request->type, ['physical', 'digital'])) {
            $query->where('book_type', $request->type);
        }

        // Filter by first letter
        if ($request->filled('letter') && $request->letter !== 'all') {
            $query->where('title', 'like', $request->letter . '%');
        }

        // Sorting
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

        // Transform genre from JSON to array and generate full cover URL
        $books->transform(function ($book) {
            $book->genre_list = $book->genre ? json_decode($book->genre) : [];
            // Generate full URL for cover image
            if ($book->cover) {
                $book->cover_url = asset('storage/' . $book->cover);
            } else {
                $book->cover_url = null;
            }
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
