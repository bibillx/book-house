<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - BookHouse</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1410;
            color: #f4e4c1;
            position: relative;
            min-height: 100vh;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: linear-gradient(135deg, #2d1810 0%, #1a1410 50%, #0f0a08 100%);
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
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
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

        .main-content {
            position: relative;
            z-index: 1;
            padding-top: 120px;
            max-width: 900px;
            margin: 0 auto;
            padding-left: 60px;
            padding-right: 60px;
            padding-bottom: 60px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #f4e4c1;
            font-family: 'Georgia', serif;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 10px;
            color: #d2b48c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(210, 180, 140, 0.2);
            color: #f4e4c1;
        }

        .order-card {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .order-number {
            font-size: 14px;
            color: #d2b48c;
        }

        .order-number strong {
            font-size: 22px;
            color: #f4e4c1;
            display: block;
            margin-top: 5px;
        }

        .order-status {
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-section h4 {
            font-size: 15px;
            color: #f4e4c1;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.1);
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-size: 12px;
            color: #d2b48c;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 14px;
            color: #f4e4c1;
        }

        .items-section h4 {
            font-size: 15px;
            color: #f4e4c1;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .order-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: rgba(26, 20, 16, 0.4);
            border-radius: 10px;
        }

        .order-item-image {
            width: 70px;
            height: 95px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .order-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-item-details {
            flex: 1;
        }

        .order-item-title {
            font-size: 15px;
            font-weight: 600;
            color: #f4e4c1;
            margin-bottom: 5px;
        }

        .order-item-author {
            font-size: 13px;
            color: #d2b48c;
            margin-bottom: 8px;
        }

        .order-item-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #d2b48c;
        }

        .order-item-price {
            font-size: 15px;
            font-weight: 600;
            color: #c9a872;
            text-align: right;
            flex-shrink: 0;
        }

        .order-total-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 2px solid rgba(210, 180, 140, 0.3);
            margin-top: 15px;
        }

        .order-total-label {
            font-size: 18px;
            color: #f4e4c1;
            font-weight: 600;
        }

        .order-total-amount {
            font-size: 26px;
            font-weight: 700;
            color: #c9a872;
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .main-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .order-item {
                flex-direction: column;
            }

            .order-item-price {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <nav>
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-icon">📚</span>
            <span>BookHouse</span>
        </a>
    </nav>

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Detail Pesanan</h1>
            <a href="{{ route('checkout.orders') }}" class="back-btn">
                ← Kembali ke Pesanan
            </a>
        </div>

        <div class="order-card">
            <div class="order-header">
                <div class="order-number">
                    Nomor Pesanan
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <span class="order-status status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h4>📍 Informasi Pengiriman</h4>
                    <div class="info-item">
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $order->shipping_address }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">No. Telepon</div>
                        <div class="info-value">{{ $order->phone_number }}</div>
                    </div>
                </div>

                <div class="info-section">
                    <h4>💳 Informasi Pembayaran</h4>
                    <div class="info-item">
                        <div class="info-label">Metode</div>
                        <div class="info-value">
                            @if($order->payment_method === 'transfer')
                                🏦 Transfer Bank
                            @else
                                📦 Cash on Delivery (COD)
                            @endif
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value">{{ ucfirst($order->status) }}</div>
                    </div>
                </div>
            </div>

            <div class="items-section">
                <h4>📚 Buku yang Dipesan</h4>
                <div class="order-items">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <div class="order-item-image">
                                <img src="{{ $item->book_cover }}" alt="{{ $item->book_title }}">
                            </div>
                            <div class="order-item-details">
                                <div class="order-item-title">{{ $item->book_title }}</div>
                                <div class="order-item-author">{{ $item->book_author }}</div>
                                <div class="order-item-meta">
                                    <span>{{ $item->book_type === 'physical' ? '📦 Fisik' : '📄 Digital' }}</span>
                                    <span>Qty: {{ $item->quantity }}</span>
                                </div>
                            </div>
                            <div class="order-item-price">
                                Rp {{ number_format($item->book_price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-total-section">
                    <span class="order-total-label">Total Pembayaran</span>
                    <span class="order-total-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
