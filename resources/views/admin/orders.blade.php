<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f1eb;
            color: #1a1a1a;
            padding: 60px 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            margin-bottom: 30px;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .orders-table th, .orders-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e5e5;
        }
        .orders-table th {
            background: #2d5016;
            color: white;
            font-weight: 500;
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-processing { background: #d1ecf1; color: #0c5460; }
        .status-shipped { background: #d4edda; color: #155724; }
        .status-delivered { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .btn-success { background: #28a745; color: white; }
        .btn-primary { background: #007bff; color: white; }
        .back-btn { background: #6c757d; color: white; margin-bottom: 20px; }
        .status-form {
            display: inline;
        }
        select.status-select {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 12px;
        }
        @if (session('success'))
            .success-alert {
                padding: 15px;
                background: #d4edda;
                border: 1px solid #c3e6cb;
                border-radius: 6px;
                color: #155724;
                margin-bottom: 20px;
            }
        @endif
    </style>
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="header">
            <a href="{{ route('admin.dashboard') }}" class="btn back-btn">← Kembali ke Dashboard</a>
            <h1>Daftar Orders ({{ $orders->total() }})</h1>
        </div>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->user->name }}<br><small>{{ $order->user->email }}</small></td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="status-form">
                                @csrf
                                <select name="status" onchange="this.form.submit();" class="status-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                            <div style="margin-top: 5px; font-size: 11px; color: #666;">
                                {{ $order->items->count() }} items
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">Tidak ada orders</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 30px; text-align: center;">
            {{ $orders->links() }}
        </div>
    </div>
</body>
</html>

