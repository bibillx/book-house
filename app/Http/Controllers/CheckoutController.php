<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CHECKOUT PAGE
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Get user's cart items
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->book_price * $item->quantity;
        });

        $total = $subtotal; // Could add shipping cost here

        return view('checkout', compact('cartItems', 'subtotal', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS CHECKOUT
    |--------------------------------------------------------------------------
    */
    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'shipping_address' => 'required|string|min:10',
            'phone_number' => 'required|string|min:10',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        // Get cart items
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong');
        }

        // Calculate total
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->book_price * $item->quantity;
        });

        // Generate order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        // Skip extra fields - create basic order only (DB issue)
        // Create order items and update stock
        foreach ($cartItems as $cartItem) {
            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->book_id,
                'book_title' => $cartItem->book_title,
                'book_author' => $cartItem->book_author,
                'book_cover' => $cartItem->book_cover,
                'book_price' => $cartItem->book_price,
                'book_type' => $cartItem->book_type,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->book_price * $cartItem->quantity,
            ]);

            // Update book stock (for physical books)
            if ($cartItem->book_type === 'physical') {
                $book = Book::find($cartItem->book_id);
                if ($book && $book->stock >= $cartItem->quantity) {
                    $book->stock -= $cartItem->quantity;
                    $book->save();
                }
            }
        }

        // Clear cart after successful order
        // Clear cart after successful order
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.orders')
            ->with('success', 'Pembelian berhasil!');
    }

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT SUCCESS PAGE
    |--------------------------------------------------------------------------
    */
    public function success($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->with('items')
            ->first();

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Pesanan tidak ditemukan');
        }

        return view('checkout.success', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | ORDER HISTORY
    |--------------------------------------------------------------------------
    */
    public function orders()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->get();

        return view('checkout.orders', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | ORDER DETAIL
    |--------------------------------------------------------------------------
    */
    public function buyNow(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'book_id' => 'required',
            'book_title' => 'required|string|max:255',
            'book_author' => 'required|string|max:255',
            'book_cover' => 'nullable|string|max:255',
            'book_price' => 'required|numeric|min:0',
            'book_type' => 'required|in:physical,digital',
            'quantity' => 'sometimes|integer|min:1|max:10'
        ]);

        $quantity = $request->integer('quantity', 1);

        // Clear existing cart
        Cart::where('user_id', Auth::id())->delete();

        // Create single cart item
        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'book_title' => $request->book_title,
            'book_author' => $request->book_author,
            'book_cover' => $request->book_cover,
            'book_price' => $request->book_price,
            'book_type' => $request->book_type,
            'quantity' => $quantity
        ]);

        return redirect()->route('checkout')
            ->with('success', 'Buku ditambahkan ke checkout! Langsung pesan.');
    }

    public function orderDetail($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->with('items')
            ->first();

        if (!$order) {
            return redirect()->route('checkout.orders')->with('error', 'Pesanan tidak ditemukan');
        }

        return view('checkout.orders', compact('order'));
    }
}
