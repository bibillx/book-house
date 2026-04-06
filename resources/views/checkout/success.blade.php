<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - BookHouse</title>
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
            padding-top: 150px;
            max-width: 800px;
            margin: 0 auto;
            padding-left: 60px;
            padding-right: 60px;
            padding-bottom: 60px;
            text-align: center;
        }

        .success-icon {
            font-size: 80px;
            margin-bottom: 25px;
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .success-title {
            font-size: 36px;
            font-weight: 700;
            color: #f4e4c1;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .success-message {
            font-size: 18px;
            color: #d2b48c;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .order-card {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 16px;
            padding: 30px;
            text-align: left;
            margin-bottom: 30px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .order-number {
            font-size: 14px;
            color: #d2b48c;
        }

        .order-number strong {
            font-size: 18px;
            color: #f4e4c1;
            display: block;
        }

        .order-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .payment-info {
            margin-bottom: 20px;
        }

        .payment-info h4 {
            font-size: 16px;
            color: #f4e4c1;
            margin-bottom: 12px;
        }

        .payment-box {
            background: rgba(26, 20, 16, 0.6);
            border-radius: 12px;
            padding: 20px;
        }

        .payment-method {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .payment-method-icon {
            font-size: 24px;
        }

        .payment-method-text {
            font-size: 15px;
            color: #f4e4c1;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(210, 180, 140, 0.2);
        }

        .order-total-label {
            font-size: 16px;
            color: #d2b48c;
        }

        .order-total-amount {
            font-size: 24px;
            font-weight: 700;
            color: #c9a872;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(210, 180, 140, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #d2b48c;
            border: 2px solid rgba(210, 180, 140, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(210, 180, 140, 0.1);
            border-color: #d2b48c;
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .main-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
        <div class="success-icon">✅</div>
        <h1 class="success-title">Pesanan Berhasil!</h1>
        <p class="success-message">
            @if($order->payment_method === 'transfer')
                Terima kasih telah melakukan pemesanan. Silakan lakukan pembayaran sesuai nominal di bawah.
            @else
                Pesanan Anda akan diproses dan dikirim menggunakan layanan COD.
            @endif
        </p>

        <div class="order-card">
            <div class="order-header">
                <div class="order-number">
                    Nomor Pesanan
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <span class="order-status status-pending">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="payment-info">
                <h4>Informasi Pembayaran</h4>
                <div class="payment-box">
                    <div class="payment-method">
                        <span class="payment-method-icon">
                            @if($order->payment_method === 'transfer')
                                🏦
                            @else
                                📦
                            @endif
                        </span>
                        <span class="payment-method-text">
                            @if($order->payment_method === 'transfer')
                                Transfer Bank
                            @else
                                Cash on Delivery (COD)
                            @endif
                        </span>
                    </div>
                    <p style="font-size: 14px; color: #d2b48c; margin-top: 10px;">
                        @if($order->payment_method === 'transfer')
                            Silakan transfer ke rekening: <strong>Bank BCA 1234567890</strong> a.n BookHouse
                        @else
                            Pesanan akan dikirim ke alamat: <br>
                            <strong>{{ $order->shipping_address }}</strong><br>
                            No. HP: {{ $order->phone_number }}
                        @endif
                    </p>
                </div>
            </div>

            <div class="order-total">
                <span class="order-total-label">Total Pembayaran</span>
                <span class="order-total-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('checkout.orders') }}" class="btn btn-primary">
                📋 Lihat Pesanan
            </a>
            <a href="{{ route('catalog') }}" class="btn btn-secondary">
                🛒 Lanjut Belanja
            </a>
        </div>
    </div>
</body>
</html>
