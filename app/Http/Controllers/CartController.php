<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Add book to cart
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|string',
            'book_title' => 'required|string',
            'book_author' => 'required|string',
            'book_cover' => 'nullable|string',
            'book_price' => 'required|numeric',
            'book_type' => 'nullable|string|in:physical,digital',
        ]);

        // Check if book already in cart
        $existingCart = Cart::where('user_id', Auth::id())
                           ->where('book_id', $validated['book_id'])
                           ->first();

        if ($existingCart) {
            // Increase quantity
            $existingCart->quantity += 1;
            $existingCart->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated in cart!',
                'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
            ]);
        }

        // Add new item to cart
        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'book_title' => $validated['book_title'],
            'book_author' => $validated['book_author'],
            'book_cover' => $validated['book_cover'],
            'book_price' => $validated['book_price'],
            'book_type' => $validated['book_type'] ?? 'physical',
            'quantity' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book added to cart!',
            'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    /**
     * Show cart page
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(function($item) {
            return $item->book_price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->quantity = $validated['quantity'];
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated!'
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    /**
     * Clear all cart
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}