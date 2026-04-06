<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Toggle wishlist (add or remove)
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|string',
            'book_title' => 'required|string',
            'book_author' => 'required|string',
            'book_cover' => 'nullable|string',
            'book_price' => 'required|numeric',
            'book_type' => 'nullable|string|in:physical,digital',
        ]);

        // Check if book already in wishlist
        $existingWishlist = Wishlist::where('user_id', Auth::id())
                                   ->where('book_id', $validated['book_id'])
                                   ->first();

        if ($existingWishlist) {
            // Remove from wishlist
            $existingWishlist->delete();
            
            return response()->json([
                'success' => true,
                'action' => 'removed',
                'message' => 'Removed from wishlist!',
                'wishlist_count' => Wishlist::where('user_id', Auth::id())->count()
            ]);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'book_title' => $validated['book_title'],
            'book_author' => $validated['book_author'],
            'book_cover' => $validated['book_cover'],
            'book_price' => $validated['book_price'],
            'book_type' => $validated['book_type'] ?? 'physical',
        ]);

        return response()->json([
            'success' => true,
            'action' => 'added',
            'message' => 'Added to wishlist!',
            'wishlist_count' => Wishlist::where('user_id', Auth::id())->count()
        ]);
    }

    /**
     * Show wishlist page
     */
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->get();

        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Remove item from wishlist
     */
    public function remove($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->findOrFail($id);
        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist!',
            'wishlist_count' => Wishlist::where('user_id', Auth::id())->count()
        ]);
    }

    /**
     * Clear all wishlist
     */
    public function clear()
    {
        Wishlist::where('user_id', Auth::id())->delete();

        return redirect()->route('wishlist.index')->with('success', 'Wishlist cleared!');
    }
}