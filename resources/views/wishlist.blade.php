<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - BookStore</title>
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
            max-width: 1400px;
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

        .wishlist-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .wishlist-count {
            font-size: 18px;
            color: #d2b48c;
        }

        .clear-wishlist-btn {
            padding: 12px 25px;
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 2px solid rgba(255, 107, 107, 0.3);
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .clear-wishlist-btn:hover {
            background: rgba(255, 107, 107, 0.3);
            color: #ff4757;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        .wishlist-card {
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.2);
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            border-color: rgba(210, 180, 140, 0.4);
        }

        .book-cover {
            width: 100%;
            height: 260px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-wishlist-btn {
            position: absolute;
            top: 25px;
            right: 25px;
            width: 32px;
            height: 32px;
            background: rgba(255, 107, 107, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            border: none;
            color: white;
        }

        .remove-wishlist-btn:hover {
            background: #ff4757;
            transform: scale(1.1);
        }

        .book-info {
            padding: 0 5px;
        }

        .book-title {
            font-size: 15px;
            font-weight: 600;
            color: #f4e4c1;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 40px;
        }

        .book-author {
            font-size: 13px;
            color: #d2b48c;
            margin-bottom: 10px;
        }

        .book-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
        }

        .book-price {
            font-size: 18px;
            font-weight: 700;
            color: #c9a872;
        }

        .add-to-cart-btn {
            padding: 8px 16px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: scale(1.05);
        }

        .empty-wishlist {
            text-align: center;
            padding: 80px 20px;
            color: #d2b48c;
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-wishlist h3 {
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
                <a href="{{ route('cart') }}">
                    <span>🛒</span> Cart
                </a>
                <a href="{{ route('wishlist') }}" class="active">
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
            <h1 class="page-title">My Wishlist</h1>
            <p class="page-subtitle">Books you want to read later</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($wishlistItems->count() > 0)
            <div class="wishlist-actions">
                <div class="wishlist-count">
                    <strong>{{ $wishlistItems->count() }}</strong> books in your wishlist
                </div>
                <form method="POST" action="{{ route('wishlist.clear') }}" style="display: inline;"
                    onsubmit="return confirm('Are you sure you want to clear your wishlist?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="clear-wishlist-btn">Clear All</button>
                </form>
            </div>

            <div class="wishlist-grid">
                @foreach ($wishlistItems as $item)
                    <div class="wishlist-card" id="wishlist-item-{{ $item->id }}">
                        <button class="remove-wishlist-btn"
                            onclick="removeFromWishlist({{ $item->id }})">✕</button>
                        <div class="book-cover">
                            <img src="{{ $item->book_cover }}" alt="{{ $item->book_title }}">
                        </div>
                        <div class="book-info">
                            <div class="book-title">{{ $item->book_title }}</div>
                            <div class="book-author">{{ $item->book_author }}</div>
                            <div class="book-footer">
                                <div class="book-price">Rp {{ number_format($item->book_price, 0, ',', '.') }}</div>
                                <button class="add-to-cart-btn"
                                    onclick="addToCart('{{ $item->book_id }}', '{{ addslashes($item->book_title) }}', '{{ addslashes($item->book_author) }}', '{{ $item->book_cover }}', {{ $item->book_price }}, '{{ $item->book_type }}')">
                                    <span>🛒</span> Add
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <div class="empty-icon">❤️</div>
                <h3>Your wishlist is empty</h3>
                <p>Save books you love for later!</p>
                <a href="{{ route('catalog') }}" class="continue-shopping">Browse Catalog</a>
            </div>
        @endif
    </div>

    <script>
        async function removeFromWishlist(wishlistId) {
            if (!confirm('Remove this book from wishlist?')) return;

            try {
                const response = await fetch(`/wishlist/${wishlistId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (data.success) {
                    document.getElementById(`wishlist-item-${wishlistId}`).remove();

                    // Reload if no items left
                    if (document.querySelectorAll('.wishlist-card').length === 0) {
                        location.reload();
                    }
                }
            } catch (error) {
                alert('Failed to remove item');
            }
        }

        async function addToCart(bookId, title, author, cover, price, bookType = 'physical') {
            try {
                const response = await fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        book_title: title,
                        book_author: author,
                        book_cover: cover,
                        book_price: price,
                        book_type: bookType
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                }
            } catch (error) {
                showNotification('Failed to add to cart', 'error');
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: ${type === 'success' ? 'rgba(76, 175, 80, 0.95)' : 'rgba(244, 67, 54, 0.95)'};
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.3);
                z-index: 10000;
                font-size: 14px;
                font-weight: 600;
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
