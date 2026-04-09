<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - BookStore</title>
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
            padding-top: 100px;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 60px;
            padding-right: 60px;
            padding-bottom: 60px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 48px;
            font-weight: 700;
            color: #f4e4c1;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .page-subtitle {
            font-size: 16px;
            color: #d2b48c;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.15);
            color: #4caf50;
            border: 2px solid rgba(76, 175, 80, 0.3);
        }

        .cart-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .cart-items {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            padding: 30px;
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: rgba(26, 20, 16, 0.5);
            border-radius: 12px;
            margin-bottom: 15px;
            border: 2px solid rgba(210, 180, 140, 0.2);
            transition: all 0.3s;
        }

        .cart-item:hover {
            border-color: rgba(210, 180, 140, 0.4);
        }

        .item-image {
            width: 100px;
            height: 140px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .item-title {
            font-size: 18px;
            font-weight: 600;
            color: #f4e4c1;
            margin-bottom: 8px;
        }

        .item-author {
            font-size: 14px;
            color: #d2b48c;
            margin-bottom: 15px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: auto;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 8px;
            padding: 5px;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .qty-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            background: transparent;
            border: none;
            color: #f4e4c1;
            font-size: 16px;
            font-weight: 600;
        }

        .item-price {
            font-size: 20px;
            font-weight: 700;
            color: #c9a872;
        }

        .remove-btn {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 2px solid rgba(255, 107, 107, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .remove-btn:hover {
            background: rgba(255, 107, 107, 0.3);
            color: #ff4757;
        }

        .cart-summary {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 24px;
            font-weight: 700;
            color: #f4e4c1;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
            color: #d2b48c;
        }

        .summary-row:last-child {
            border-bottom: none;
            padding-top: 20px;
            margin-top: 10px;
            border-top: 2px solid rgba(210, 180, 140, 0.3);
        }

        .summary-row.total {
            font-size: 22px;
            font-weight: 700;
            color: #f4e4c1;
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
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(210, 180, 140, 0.3);
        }

        .clear-cart-btn {
            width: 100%;
            padding: 12px;
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 2px solid rgba(255, 107, 107, 0.3);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .clear-cart-btn:hover {
            background: rgba(255, 107, 107, 0.3);
            color: #ff4757;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: #d2b48c;
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #f4e4c1;
        }

        .continue-shopping {
            display: inline-block;
            margin-top: 20px;
            padding: 14px 35px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .continue-shopping:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
        }

        @media (max-width: 968px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>

    <nav>
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                <span>BookHouse</span>
            </a>
            <div class="nav-menu">
                <a href="{{ url('/dashboard') }}">
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
        <div class="page-header">
            <h1 class="page-title">Shopping Cart</h1>
            <p class="page-subtitle">Review your items before checkout</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="cart-container">
                <div class="cart-items">
                    @foreach ($cartItems as $item)
                        <div class="cart-item" id="cart-item-{{ $item->id }}">
                            <div class="item-image">
                                <img src="{{ $item->book_cover ?: 'https://via.placeholder.com/100x140/2a231c/8b7355?text=No+Cover' }}" alt="{{ $item->book_title }}" onerror="this.src='https://via.placeholder.com/100x140/2a231c/8b7355?text=No+Cover'">
                            </div>
                            <div class="item-details">
                                <div class="item-title">{{ $item->book_title }}</div>
                                <div class="item-author">{{ $item->book_author }}</div>
                                <div class="item-actions">
                                    <div class="quantity-control">
                                        <button class="qty-btn"
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">−</button>
                                        <input type="number" class="qty-input" value="{{ $item->quantity }}" readonly>
                                        <button class="qty-btn"
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">+</button>
                                    </div>
                                    <div class="item-price">Rp
                                        {{ number_format($item->book_price * $item->quantity, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <button class="remove-btn" onclick="removeFromCart({{ $item->id }})">🗑️
                                Remove</button>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="checkout-btn"
                        style="display: block; text-align: center; text-decoration: none;">
                        Proceed to Checkout
                    </a>
                    <form method="POST" action="{{ route('cart.clear') }}"
                        onsubmit="return confirm('Are you sure you want to clear your cart?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="clear-cart-btn">Clear Cart</button>
                    </form>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <div class="empty-icon">🛒</div>
                <h3>Your cart is empty</h3>
                <p>Start adding some books to your cart!</p>
                <a href="{{ route('catalog') }}" class="continue-shopping">Browse Catalog</a>
            </div>
        @endif
    </div>

    <script>
        async function updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1) {
                if (confirm('Remove this item from cart?')) {
                    removeFromCart(cartId);
                }
                return;
            }

            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                });

                const data = await response.json();
                if (data.success) {
                    location.reload();
                }
            } catch (error) {
                alert('Failed to update quantity');
            }
        }

        async function removeFromCart(cartId) {
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (data.success) {
                    document.getElementById(`cart-item-${cartId}`).remove();
                    location.reload();
                }
            } catch (error) {
                alert('Failed to remove item');
            }
        }
    </script>
</body>

</html>
