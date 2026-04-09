<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - BookHouse</title>
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

        .main-content {
            position: relative;
            z-index: 1;
            padding-top: 120px;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 60px;
            padding-right: 60px;
            padding-bottom: 60px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            color: #f4e4c1;
            margin-bottom: 30px;
            font-family: 'Georgia', serif;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .checkout-form {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 16px;
            padding: 30px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section h3 {
            font-size: 18px;
            color: #f4e4c1;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #d2b48c;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(26, 20, 16, 0.6);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 10px;
            color: #f4e4c1;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #d2b48c;
            background: rgba(26, 20, 16, 0.8);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #8b7355;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: rgba(26, 20, 16, 0.6);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option:hover {
            border-color: rgba(210, 180, 140, 0.5);
        }

        .payment-option.selected {
            border-color: #d2b48c;
            background: rgba(210, 180, 140, 0.1);
        }

        .payment-option input {
            display: none;
        }

        .payment-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #d2b48c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .payment-option.selected .payment-radio::after {
            content: '';
            width: 10px;
            height: 10px;
            background: #d2b48c;
            border-radius: 50%;
        }

        .payment-icon {
            font-size: 28px;
        }

        .payment-info h4 {
            font-size: 16px;
            color: #f4e4c1;
            margin-bottom: 4px;
        }

        .payment-info p {
            font-size: 13px;
            color: #d2b48c;
        }

        .order-summary {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 16px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 120px;
        }

        .order-summary h3 {
            font-size: 20px;
            color: #f4e4c1;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(210, 180, 140, 0.1);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-image {
            width: 60px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-size: 14px;
            font-weight: 600;
            color: #f4e4c1;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cart-item-author {
            font-size: 12px;
            color: #d2b48c;
            margin-bottom: 8px;
        }

        .cart-item-price {
            font-size: 14px;
            font-weight: 600;
            color: #c9a872;
        }

        .cart-item-qty {
            font-size: 12px;
            color: #d2b48c;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            font-size: 15px;
            color: #d2b48c;
        }

        .summary-row.total {
            border-top: 2px solid rgba(210, 180, 140, 0.3);
            margin-top: 10px;
            padding-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #f4e4c1;
        }

        .summary-row.total span:last-child {
            color: #c9a872;
        }

        .checkout-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(210, 180, 140, 0.3);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.15);
            color: #ff6b6b;
            border: 2px solid rgba(244, 67, 54, 0.3);
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.15);
            color: #4caf50;
            border: 2px solid rgba(76, 175, 80, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-cart-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-cart h3 {
            font-size: 24px;
            color: #f4e4c1;
            margin-bottom: 10px;
        }

        .empty-cart p {
            font-size: 16px;
            color: #d2b48c;
            margin-bottom: 25px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
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

        @media (max-width: 1024px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: relative;
                top: 0;
                order: -1;
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .nav-menu {
                display: none;
            }

            .main-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .page-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>

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
                <a href="{{ route('cart') }}" class="active">
                    <span>🛒</span> Cart
                </a>
                <a href="{{ route('wishlist') }}">
                    <span>❤️</span> Wishlist
                </a>
                <a href="{{ route('checkout.orders') }}">
                    <span>📦</span> Orders
                </a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <h1 class="page-title">Checkout</h1>

        @if ($cartItems->isEmpty())
            <div class="checkout-form">
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h3>Keranjang Belanja Kosong</h3>
                    <p>Silakan tambahkan buku ke keranjang terlebih dahulu</p>
                    <a href="{{ route('catalog') }}" class="back-btn">
                        ← Lanjut Belanja
                    </a>
                </div>
            </div>
        @else
            <form action="{{ route('checkout.process') }}" method="POST" class="checkout-grid">
                @csrf

                <div class="checkout-form">
                    @if (session('error'))
                        <div class="alert alert-error">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error">
                            <strong>Silakan perbaiki kesalahan berikut:</strong><br>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    <!-- Shipping Information --> 
                    <div class="form-section">
                        <h3>📍 Informasi Pengiriman</h3>

                        <div class="form-group">
                            <label for="shipping_address">Alamat Lengkap</label>
                            <textarea id="shipping_address" name="shipping_address"
                                placeholder="Contoh: Jl. Jalan No. 123, Rt/Rw 01/02, Kelurahan, Kecamatan, Kota" required>{{ old('shipping_address') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Nomor Telepon</label>
                            <input type="text" id="phone_number" name="phone_number"
                                placeholder="Contoh: 081234567890" value="{{ old('phone_number') }}" required>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-section">
                        <h3>💳 Metode Pembayaran</h3>

                        <div class="payment-methods">
                            <label class="payment-option {{ old('payment_method') === 'transfer' ? 'selected' : '' }}">
                                <input type="radio" name="payment_method" value="transfer"
                                    {{ old('payment_method') === 'transfer' ? 'checked' : '' }} required>
                                <div class="payment-radio"></div>
                                <div class="payment-icon">🏦</div>
                                <div class="payment-info">
                                    <h4>Transfer Bank</h4>
                                    <p>Transfer melalui ATM/Internet Banking</p>
                                </div>
                            </label>

                            <label class="payment-option {{ old('payment_method') === 'cod' ? 'selected' : '' }}">
                                <input type="radio" name="payment_method" value="cod"
                                    {{ old('payment_method') === 'cod' ? 'checked' : '' }}>
                                <div class="payment-radio"></div>
                                <div class="payment-icon">📦</div>
                                <div class="payment-info">
                                    <h4>Cash on Delivery (COD)</h4>
                                    <p>Bayar saat barang diterima</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <h3>Ringkasan Pesanan</h3>

                    <div class="cart-items">
                        @foreach ($cartItems as $item)
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="{{ $item->book_cover ?: 'https://via.placeholder.com/60x80/2a231c/8b7355?text=No+Cover' }}" alt="{{ $item->book_title }}" onerror="this.src='https://via.placeholder.com/60x80/2a231c/8b7355?text=No+Cover'">
                                </div>
                                <div class="cart-item-details">
                                    <div class="cart-item-title">{{ $item->book_title }}</div>
                                    <div class="cart-item-author">{{ $item->book_author }}</div>
                                    <div class="cart-item-price">Rp {{ number_format($item->book_price, 0, ',', '.') }}
                                    </div>
                                    <div class="cart-item-qty">Qty: {{ $item->quantity }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pengiriman</span>
                        <span>Gratis</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="checkout-btn">
                        Buat Pesanan
                    </button>

                    <a href="{{ route('catalog') }}" class="back-btn"
                        style="display: block; text-align: center; margin-top: 15px;">
                        ← Kembali ke Katalog
                    </a>
                </div>
            </form>
        @endif
    </div>

    <script>
        // Handle payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input').checked = true;
            });
        });
    </script>
</body>

</html>
