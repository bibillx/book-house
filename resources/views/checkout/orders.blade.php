@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pembelanjaan</title>

    <style>
        body {
            font-family: Segoe UI;
            background: #1a1410;
            color: #f4e4c1;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .title {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .order-card {
            background: #2a231c;
            border: 1px solid rgba(210, 180, 140, 0.3);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .status {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 13px;
            background: #c9a872;
            color: #1a1410;
        }

        .book {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }

        .book img {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
        }

        .total {
            margin-top: 10px;
            font-weight: bold;
            color: #c9a872;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d2b48c;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-icon {
            font-size: 28px;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav-menu a {
            color: #d2b48c;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: rgba(210, 180, 140, 0.15);
            color: #f4e4c1;
        }

        /* supaya konten tidak ketutup navbar */
        .container {
            max-width: 1000px;
            margin: auto;
            margin-top: 120px;
        }
    </style>

</head>

<body>

    <nav>
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                <span>BookHouse</span>
            </a>
            <div class="nav-menu">
                <a href="{{ route('dashboard') }}">
                    <span>🏠</span> Home
                </a>
                <a href="{{ route('catalog') }}">
                    <span>📖</span> Catalog
                </a>
                <a href="{{ route('cart') }}">
                    <span>🛒</span> Cart
                </a>
                <a href="{{ route('wishlist') }}">
                    <span>❤️</span> Wishlist
                </a>
                <a href="{{ route('checkout.orders') }}" class="active">
                   <span>📦</span> Orders
                </a>
            </div>
        </div>
    </nav>

    <div class="container">

        <h1 class="title">Riwayat Pembelanjaan</h1>

        @if ($orders->isEmpty())
            <p>Belum ada pesanan.</p>
        @endif

        @foreach ($orders as $order)
            <div class="order-card">

                <div class="order-header">
                    <div>

                        <div>
                            Order ID:
                            <b>{{ $order->order_number }}</b>
                        </div>

                        <div>
                            Tanggal:
                            {{ $order->created_at->format('d M Y H:i') }}
                        </div>

                    </div>

                    <div class="status">
                        {{ $order->status }}
                    </div>
                </div>


                @foreach ($order->items as $item)
                    <div class="book">

                        <img src="{{ $item->book_cover }}">

                        <div>

                            <div>
                                {{ $item->book_title }}
                            </div>

                            <div style="font-size:13px;color:#d2b48c">
                                {{ $item->book_author }}
                            </div>

                            <div>
                                Qty: {{ $item->quantity }}
                            </div>

                        </div>

                    </div>
                @endforeach


                <div class="total">
                    Total:
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </div>

            </div>
        @endforeach

    </div>

</body>

</html>
