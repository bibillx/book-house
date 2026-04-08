<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        $orders = Order::with('user', 'items')->latest()->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($orderId);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status order berhasil diupdate!');
    }
}

