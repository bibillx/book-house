<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $book->title }} - BookStore</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1410;
            color: #f4e4c1;
            min-height: 100vh;
        }

        /* ── Background ────────────────────────────────────────────── */
        .background {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; z-index: 0;
            background: linear-gradient(135deg, #2d1810 0%, #1a1410 50%, #0f0a08 100%);
        }

        /* ── Nav ────────────────────────────────────────────────────── */
        nav {
            position: fixed; top: 0; left: 0; width: 100%;
            padding: 20px 60px;
            display: flex; justify-content: space-between; align-items: center;
            z-index: 1000;
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .nav-left { display: flex; align-items: center; gap: 50px; }

        .logo {
            display: flex; align-items: center; gap: 12px;
            color: #d2b48c; font-size: 24px; font-weight: bold; text-decoration: none;
        }

        .nav-menu { display: flex; gap: 35px; align-items: center; }

        .nav-menu a {
            color: #d2b48c; text-decoration: none; font-size: 15px;
            font-weight: 500; transition: all 0.3s;
            display: flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 8px;
        }

        .nav-menu a:hover {
            background: rgba(210, 180, 140, 0.15); color: #f4e4c1;
        }

        /* ── Main Content ───────────────────────────────────────────── */
        .main-content {
            position: relative; z-index: 1;
            padding-top: 110px;
            max-width: 1200px; margin: 0 auto;
            padding-left: 60px; padding-right: 60px; padding-bottom: 80px;
        }

        /* ── Breadcrumb ─────────────────────────────────────────────── */
        .breadcrumb {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 35px; font-size: 14px; color: #8b7355;
        }

        .breadcrumb a {
            color: #d2b48c; text-decoration: none; transition: color 0.2s;
        }

        .breadcrumb a:hover { color: #f4e4c1; }
        .breadcrumb span { color: #8b7355; }

        /* ── Book Detail Layout ─────────────────────────────────────── */
        .book-detail {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 50px;
            align-items: start;
        }

        /* ── Left: Cover + Actions ──────────────────────────────────── */
        .book-left { position: sticky; top: 110px; }

        .cover-wrapper {
            position: relative;
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.7);
            margin-bottom: 25px;
        }

        .cover-wrapper img {
            width: 100%; display: block;
            min-height: 420px; object-fit: cover;
        }

        .cover-wrapper img.error {
            object-fit: contain; padding: 30px;
            background: #2a231c;
        }

        .book-type-badge {
            position: absolute; top: 16px; left: 16px;
            padding: 7px 16px; border-radius: 20px;
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
            color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }

        .book-type-badge.physical {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        }

        .book-type-badge.digital {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        /* stock badge */
        .stock-badge {
            position: absolute; bottom: 16px; right: 16px;
            padding: 6px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 700; color: white;
        }

        .stock-badge.in-stock  { background: rgba(76, 175, 80, 0.9); }
        .stock-badge.low-stock { background: rgba(255, 152, 0, 0.9); }
        .stock-badge.out-stock { background: rgba(244, 67, 54, 0.9); }

        /* ── Action Buttons ─────────────────────────────────────────── */
        .action-buttons { display: flex; flex-direction: column; gap: 12px; }

        .btn-buy-now {
            width: 100%; padding: 15px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410; border: none; border-radius: 12px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            transition: all 0.3s; display: flex;
            align-items: center; justify-content: center; gap: 8px;
        }

        .btn-buy-now:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(210, 180, 140, 0.3);
        }

        .btn-add-cart {
            width: 100%; padding: 14px;
            background: transparent;
            border: 2px solid rgba(210, 180, 140, 0.5);
            border-radius: 12px;
            color: #d2b48c; font-size: 15px; font-weight: 600;
            cursor: pointer; transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-add-cart:hover {
            background: rgba(210, 180, 140, 0.1);
            border-color: #d2b48c; color: #f4e4c1;
            transform: translateY(-2px);
        }

        .btn-wishlist {
            width: 100%; padding: 12px;
            background: transparent;
            border: 2px solid rgba(255, 107, 107, 0.4);
            border-radius: 12px;
            color: #ff6b6b; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-wishlist:hover, .btn-wishlist.active {
            background: rgba(255, 107, 107, 0.1);
            border-color: #ff4757; color: #ff4757;
        }

        .btn-disabled {
            opacity: 0.5; cursor: not-allowed; pointer-events: none;
        }

        /* ── Right: Book Info ───────────────────────────────────────── */
        .book-right {}

        .book-genre {
            display: inline-block;
            padding: 6px 18px;
            background: rgba(210, 180, 140, 0.15);
            border: 1px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            font-size: 13px; color: #d2b48c;
            margin-bottom: 18px;
        }

        .book-title {
            font-size: 36px; font-weight: 700;
            color: #f4e4c1; font-family: 'Georgia', serif;
            line-height: 1.2; margin-bottom: 12px;
        }

        .book-author {
            font-size: 18px; color: #d2b48c; margin-bottom: 25px;
        }

        .book-author span { color: #f4e4c1; font-weight: 600; }

        /* Price */
        .price-block { margin-bottom: 30px; }

        .book-price {
            font-size: 40px; font-weight: 700; color: #c9a872;
            font-family: 'Georgia', serif;
        }

        .price-label { font-size: 13px; color: #8b7355; margin-top: 4px; }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid rgba(210, 180, 140, 0.2);
            margin: 25px 0;
        }

        /* Meta info */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px; margin-bottom: 30px;
        }

        .meta-item {
            background: rgba(42, 35, 28, 0.8);
            border: 1px solid rgba(210, 180, 140, 0.2);
            border-radius: 12px; padding: 16px;
            text-align: center;
        }

        .meta-icon { font-size: 22px; margin-bottom: 8px; }
        .meta-value { font-size: 16px; font-weight: 700; color: #f4e4c1; }
        .meta-label { font-size: 12px; color: #8b7355; margin-top: 3px; }

        /* Description */
        .section-title {
            font-size: 20px; font-weight: 700;
            color: #f4e4c1; margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .book-description {
            font-size: 15px; color: #c9b99a;
            line-height: 1.8;
            background: rgba(42, 35, 28, 0.6);
            border: 1px solid rgba(210, 180, 140, 0.15);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 30px;
        }

        .book-description.collapsed {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more-btn {
            background: none; border: none;
            color: #d2b48c; font-size: 14px;
            cursor: pointer; margin-top: 8px;
            text-decoration: underline;
        }

        /* ── Notification ───────────────────────────────────────────── */
        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to   { transform: translateX(0);     opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0);     opacity: 1; }
            to   { transform: translateX(400px); opacity: 0; }
        }

        /* ── Responsive ─────────────────────────────────────────────── */
        @media (max-width: 900px) {
            .book-detail { grid-template-columns: 1fr; }
            .book-left   { position: relative; top: 0; }
            .cover-wrapper img { max-height: 400px; object-fit: cover; }
            .meta-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            nav { padding: 20px 30px; }
            .nav-menu { display: none; }
            .main-content { padding-left: 20px; padding-right: 20px; }
            .book-title { font-size: 26px; }
            .book-price { font-size: 30px; }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <!-- Nav -->
    <nav>
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span>📚</span> BookStore
            </a>
            <div class="nav-menu">
                <a href="{{ url('/dashboard') }}"><span>🏠</span> Home</a>
                <a href="{{ route('catalog') }}"><span>📖</span> Catalog</a>
                <a href="{{ url('cart') }}"><span>🛒</span> Cart</a>
                <a href="{{ url('wishlist') }}"><span>❤️</span> Wishlist</a>
                <a href="{{ route('checkout.orders') }}">
                    <span>📦</span> Orders
                </a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ url('/dashboard') }}">Home</a>
            <span>›</span>
            <a href="{{ route('catalog') }}">Catalog</a>
            <span>›</span>
{{ Str::limit($book->title, 40) }}
        </div>

        <div class="book-detail">
            <!-- ── LEFT ── -->
            <div class="book-left">
                <div class="cover-wrapper">
                    <!-- Type badge -->
                    <div class="book-type-badge {{ $book->book_type ?? 'physical' }}">
                        {{ ($book->book_type ?? 'physical') === 'physical' ? '📦 Fisik' : '📄 Digital' }}
                    </div>

                    <!-- Stock badge -->
@php
                        $stock = $book->stock ?? 0;
                    @endphp

                    @if($stock > 10)
                        <div class="stock-badge in-stock">✓ In Stock</div>
                    @elseif($stock > 0)
                        <div class="stock-badge low-stock">⚠ Low Stock ({{ $stock }})</div>
                    @else
                        <div class="stock-badge out-stock">✗ Out of Stock</div>
                    @endif

                    <img
                        src="{{ $book->cover_url ?? $book->cover ? asset('storage/' . $book->cover) : '' }}"
                        alt="{{ $book->title }}"
                        onerror="this.classList.add('error'); this.src='https://via.placeholder.com/320x450/2a231c/8b7355?text=No+Cover';"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @if($stock > 0)
                        <!-- Buy Now -->
                        <button class="btn-buy-now" id="btnBuyNow" >
                            ⚡ Beli Sekarang
                        </button>

                        <!-- Add to Cart -->
                        <button class="btn-add-cart" id="btnAddCart">
                            🛒 Tambah ke Keranjang
                        </button>
                    @else
                        <button class="btn-buy-now btn-disabled">
                            ✗ Stok Habis
                        </button>
                    @endif
                </div>
            </div>

            <!-- ── RIGHT ── -->
            <div class="book-right">
@if($book->genre_list && count($book->genre_list) > 0)
                    <div class="book-genre">{{ implode(', ', $book->genre_list) }}</div>
                @endif

                <h1 class="book-title">{{ $book->title }}</h1>
                <p class="book-author">oleh <span>{{ $book->authors }}</span></p>

                <!-- Price -->
                <div class="price-block">
                    <div class="book-price">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </div>
                    <div class="price-label">
                        {{ ($book->book_type ?? 'physical') === 'digital' ? 'Harga file digital (PDF)' : 'Harga buku fisik' }}
                    </div>
                </div>

                <hr class="divider">

                <!-- Meta Grid -->
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">📄</div>
                        <div class="meta-value">{{ $book->pages ?? '-' }}</div>
                        <div class="meta-label">Halaman</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">🏷️</div>
                        <div class="meta-value">{{ $book->genre_list ? implode(', ', $book->genre_list) : '-' }}</div>
                        <div class="meta-label">Genre</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">📦</div>
                        <div class="meta-value">{{ $stock > 0 ? $stock : 'Habis' }}</div>
                        <div class="meta-label">Stok</div>
                    </div>
                </div>

                <hr class="divider">

                <!-- Description -->
@if($book->synopsis)
                    <div class="section-title">📖 Sinopsis</div>
                    <div class="book-description collapsed" id="bookDesc">
                        {!! $book->synopsis !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form id="buyNowForm" action="{{ route('checkout.buynow') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="book_id"     value="{{ $book->id }}">
        <input type="hidden" name="book_title"  value="{{ $book->title }}">
        <input type="hidden" name="book_author" value="{{ $book->authors }}">
        <input type="hidden" name="book_cover"  value="{{ $book->cover_url ?? $book->cover ?? '' }}">
        <input type="hidden" name="book_price"  value="{{ $book->price }}">
        <input type="hidden" name="book_type"   value="{{ $book->book_type ?? 'physical' }}">
    </form>

    <script>
        const BOOK = @json($book);

        // ── Buy Now ────────────────────────────────────────────────────
        const btnBuyNow = document.getElementById('btnBuyNow');
        if (btnBuyNow) {
            btnBuyNow.addEventListener('click', () => {
                @auth
                    document.getElementById('buyNowForm').submit();
                @else
                    showNotification('Silakan login terlebih dahulu!', 'error');
                    setTimeout(() => window.location.href = '{{ route("login") }}', 1500);
                @endauth
            });
        }

        // ── Add to Cart ────────────────────────────────────────────────
        const btnAddCart = document.getElementById('btnAddCart');
        if (btnAddCart) {
            btnAddCart.addEventListener('click', () => addToCart());
        }

        async function addToCart() {
            @guest
                showNotification('Silakan login terlebih dahulu!', 'error');
                setTimeout(() => window.location.href = '{{ route("login") }}', 1500);
                return;
            @endguest

            try {
                const response = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id:    String(BOOK.id),
                        book_title: BOOK.title,
                        book_author: BOOK.authors,
                        book_cover: BOOK.cover || '',
                        book_price: Number(BOOK.price),
                        book_type:  BOOK.book_type || 'physical'
                    }),
                    credentials: 'include'
                });

                const text = await response.text();

                if (response.status === 401 || text.includes('login')) {
                    showNotification('Silakan login terlebih dahulu!', 'error');
                    setTimeout(() => window.location.href = '{{ route("login") }}', 1500);
                    return;
                }

                const data = JSON.parse(text);
                if (data.success) {
                    showNotification(`"${BOOK.title}" berhasil ditambahkan ke keranjang!`, 'success');
                    // Update button temporarily
                    btnAddCart.textContent = '✓ Ditambahkan!';
                    setTimeout(() => { btnAddCart.innerHTML = '🛒 Tambah ke Keranjang'; }, 2000);
                } else {
                    showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
                }
            } catch (err) {
                showNotification('Error: ' + err.message, 'error');
            }
        }

        // ── Wishlist ───────────────────────────────────────────────────
        const btnWishlist = document.getElementById('btnWishlist');
        btnWishlist.addEventListener('click', () => toggleWishlist());

        async function toggleWishlist() {
            @guest
                showNotification('Silakan login terlebih dahulu!', 'error');
                setTimeout(() => window.location.href = '{{ route("login") }}', 1500);
                return;
            @endguest

            try {
                const response = await fetch('{{ route("wishlist.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id:    String(BOOK.id),
                        book_title: BOOK.title,
                        book_author: BOOK.authors,
                        book_cover: BOOK.cover || '',
                        book_price: Number(BOOK.price),
                        book_type:  BOOK.book_type || 'physical'
                    }),
                    credentials: 'include'
                });

                const text = await response.text();
                const data = JSON.parse(text);

                if (data.success) {
                    if (data.action === 'added') {
                        btnWishlist.innerHTML = '❤️ Ada di Wishlist';
                        btnWishlist.classList.add('active');
                        showNotification(`"${BOOK.title}" ditambahkan ke wishlist!`, 'success');
                    } else {
                        btnWishlist.innerHTML = '♡ Tambah ke Wishlist';
                        btnWishlist.classList.remove('active');
                        showNotification(`"${BOOK.title}" dihapus dari wishlist!`, 'success');
                    }
                }
            } catch (err) {
                showNotification('Error: ' + err.message, 'error');
            }
        }

        // ── Read More ──────────────────────────────────────────────────
        let descExpanded = false;
        function toggleDesc() {
            const desc = document.getElementById('bookDesc');
            const btn  = document.getElementById('readMoreBtn');
            descExpanded = !descExpanded;
            desc.classList.toggle('collapsed', !descExpanded);
            btn.textContent = descExpanded ? 'Sembunyikan ▲' : 'Baca selengkapnya ▼';
        }

        // ── Notification ───────────────────────────────────────────────
        function showNotification(message, type) {
            const n = document.createElement('div');
            n.style.cssText = `
                position: fixed; top: 100px; right: 20px;
                background: ${type === 'success' ? 'rgba(76,175,80,0.95)' : 'rgba(244,67,54,0.95)'};
                color: white; padding: 15px 25px; border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.3);
                z-index: 10000; font-size: 14px; font-weight: 600;
                animation: slideIn 0.3s ease; max-width: 320px;
            `;
            n.textContent = message;
            document.body.appendChild(n);
            setTimeout(() => {
                n.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => n.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>