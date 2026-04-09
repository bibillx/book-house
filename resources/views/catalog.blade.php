<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog - BookStore</title>
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

        .bookshelf-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
        }

        .book-row {
            position: absolute;
            width: 100%;
            display: flex;
            gap: 8px;
            padding: 0 30px;
        }

        .row-1 {
            top: 20%;
        }

        .row-2 {
            top: 50%;
        }

        .row-3 {
            bottom: 15%;
        }

        .mini-book {
            width: 45px;
            height: 140px;
            border-radius: 2px;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .color-1 {
            background: linear-gradient(to right, #8b4513 0%, #a0522d 100%);
        }

        .color-2 {
            background: linear-gradient(to right, #2f4f4f 0%, #3d5f5f 100%);
            height: 120px;
        }

        .color-3 {
            background: linear-gradient(to right, #8b0000 0%, #a52a2a 100%);
            height: 150px;
        }

        .color-4 {
            background: linear-gradient(to right, #1e3a5f 0%, #2e4a6f 100%);
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

        .search-section {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .search-box {
            position: relative;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 100%;
            padding: 16px 50px 16px 50px;
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 15px;
            font-size: 16px;
            background: rgba(26, 20, 16, 0.6);
            color: #f4e4c1;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #d2b48c;
            background: rgba(26, 20, 16, 0.8);
        }

        .search-box input::placeholder {
            color: #8b7355;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #d2b48c;
        }

        .clear-search {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #d2b48c;
            font-size: 20px;
            cursor: pointer;
            display: none;
        }

        .clear-search:hover {
            color: #f4e4c1;
        }

        .book-type-filter {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 2px solid rgba(210, 180, 140, 0.2);
        }

        .type-btn {
            padding: 12px 30px;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 25px;
            color: #d2b48c;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .type-btn:hover,
        .type-btn.active {
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border-color: #d2b48c;
            transform: translateY(-2px);
        }

        .type-btn.physical-btn.active {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
            border-color: #4caf50;
            color: white;
        }

        .type-btn.digital-btn.active {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            border-color: #2196f3;
            color: white;
        }

        .alphabet-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .alphabet-btn {
            width: 45px;
            height: 45px;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 10px;
            color: #d2b48c;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .alphabet-btn:hover,
        .alphabet-btn.active {
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border-color: #d2b48c;
            transform: translateY(-2px);
        }

        .alphabet-btn.all {
            width: auto;
            padding: 0 20px;
        }

        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding: 15px 20px;
            background: rgba(42, 35, 28, 0.6);
            border-radius: 12px;
        }

        .results-count {
            color: #d2b48c;
            font-size: 15px;
        }

        .sort-select {
            padding: 8px 15px;
            background: rgba(26, 20, 16, 0.8);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 8px;
            color: #f4e4c1;
            font-size: 14px;
            cursor: pointer;
        }

        .sort-select:focus {
            outline: none;
            border-color: #d2b48c;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        /* ── Book Card ─────────────────────────────────────────────── */
        .book-card {
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.2);
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            border-color: rgba(210, 180, 140, 0.5);
        }

        .book-card:hover .book-title {
            color: #d2b48c;
        }

        .book-cover {
            width: 100%;
            height: 280px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2a231c;
            position: relative;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .book-card:hover .book-cover img {
            transform: scale(1.05);
        }

        .book-cover img.error {
            object-fit: contain;
            padding: 20px;
        }

        .book-type-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .book-type-badge.physical {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        }

        .book-type-badge.digital {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
        }

        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            border: none;
            color: #ff6b6b;
            z-index: 10;
        }

        .wishlist-btn:hover {
            background: white;
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
            transition: color 0.3s;
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

        .no-results {
            text-align: center;
            padding: 80px 20px;
            color: #d2b48c;
        }

        .no-results-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #f4e4c1;
        }

        .no-results p {
            font-size: 16px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(400px);
                opacity: 0;
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
                font-size: 36px;
            }

            .alphabet-filter {
                gap: 6px;
            }

            .alphabet-btn {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
            }

            .book-type-filter {
                flex-direction: column;
            }

            .type-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Background -->
    <div class="background">
        <div class="bookshelf-bg">
            <div class="book-row row-1">
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-3"></div>
            </div>
            <div class="book-row row-2">
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
            </div>
            <div class="book-row row-3">
                <div class="mini-book color-3"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                <span>BookStore</span>
            </a>
            <div class="nav-menu">
                <a href="{{ url('/dashboard') }}"><span>🏠</span> Home</a>
                <a href="{{ url('catalog') }}" class="active"><span>📖</span> Catalog</a>
                <a href="{{ url('cart') }}"><span>🛒</span> Cart</a>
                <a href="{{ url('wishlist') }}"><span>❤️</span> Wishlist</a>
                <a href="{{ route('checkout.orders') }}">
                    <span>📦</span> Orders
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Novel Catalog</h1>
            <p class="page-subtitle">Explore our complete collection of Fiction & Non-Fiction novels</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" placeholder="Search by book title or author...">
                <button class="clear-search" id="clearSearch">✕</button>
            </div>

            <!-- Book Type Filter -->
            <div class="book-type-filter">
                <button class="type-btn active" data-type="all"><span>📚</span> All Books</button>
                <button class="type-btn physical-btn" data-type="physical"><span>📦</span> Physical Books</button>
                <button class="type-btn digital-btn" data-type="digital"><span>📄</span> Digital (PDF)</button>
            </div>

            <!-- Alphabet Filter -->
            <div class="alphabet-filter">
                <button class="alphabet-btn all active" data-letter="all">All</button>
                @foreach (range('A', 'Z') as $letter)
                    <button class="alphabet-btn" data-letter="{{ $letter }}">{{ $letter }}</button>
                @endforeach
            </div>
        </div>

        <!-- Results Info -->
        <div class="results-info">
            <div class="results-count">
                Showing <strong id="resultCount">0</strong> novels
            </div>
            <select class="sort-select" id="sortSelect">
                <option value="title-asc">Title (A-Z)</option>
                <option value="title-desc">Title (Z-A)</option>
                <option value="price-asc">Price (Low to High)</option>
                <option value="price-desc">Price (High to Low)</option>
            </select>
        </div>

        <!-- Books Grid -->
        <div class="books-grid" id="booksGrid"></div>

        <!-- No Results -->
        <div class="no-results" id="noResults" style="display: none;">
            <div class="no-results-icon">📚</div>
            <h3>No novels found</h3>
            <p>Try adjusting your search or filters</p>
        </div>
    </div>

    <script>
        let allBooks = [];
        let filteredBooks = [];
        let currentLetter = 'all';
        let currentType = 'all';
        let currentSearch = '';

        // ── Render ──────────────────────────────────────────────────────
        function renderBooks() {
            const grid = document.getElementById('booksGrid');
            const noResults = document.getElementById('noResults');

            if (filteredBooks.length === 0) {
                grid.innerHTML = '';
                noResults.style.display = 'block';
                document.getElementById('resultCount').textContent = '0';
                return;
            }

            noResults.style.display = 'none';
            document.getElementById('resultCount').textContent = filteredBooks.length;

            grid.innerHTML = filteredBooks.map(book => `
                <a class="book-card" href="{{ url('book') }}/${book.id}">
                    <div class="book-cover">
                        <div class="book-type-badge ${book.book_type}">
                            ${book.book_type === 'physical' ? '📦 Physical' : '📄 PDF'}
                        </div>
                        <button class="wishlist-btn"
                            onclick='event.preventDefault(); event.stopPropagation(); toggleWishlist(${JSON.stringify(book).replace(/'/g,"&apos;")}, this)'>
                            ♡
                        </button>
                        <img src="${book.cover}"
                             alt="${book.title}"
                             onerror="this.classList.add('error'); this.src='https://via.placeholder.com/300x450/8b7355/f4e4c1?text=No+Cover';">
                    </div>
                    <div class="book-info">
                        <div class="book-title" title="${book.title}">${book.title}</div>
                        <div class="book-author">${book.authors}</div>
                        <div class="book-footer">
                            <div class="book-price">Rp ${book.price.toLocaleString('id-ID')}</div>
                            <button class="add-to-cart-btn"
                                onclick='event.preventDefault(); event.stopPropagation(); addToCart(${JSON.stringify(book).replace(/'/g,"&apos;")})'>
                                <span>🛒</span> Add
                            </button>
                        </div>
                    </div>
                </a>
            `).join('');
        }

        // ── Filters ─────────────────────────────────────────────────────
        function applyFilters() {
            filteredBooks = allBooks.filter(book => {
                const matchesLetter = currentLetter === 'all' ||
                    book.title.charAt(0).toUpperCase() === currentLetter;
                const matchesType = currentType === 'all' || book.book_type === currentType;
                const matchesSearch = currentSearch === '' ||
                    book.title.toLowerCase().includes(currentSearch.toLowerCase()) ||
                    book.authors.toLowerCase().includes(currentSearch.toLowerCase());

                return matchesLetter && matchesType && matchesSearch;
            });

            renderBooks();
        }

        document.querySelectorAll('.type-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentType = btn.dataset.type;
                applyFilters();
            });
        });

        document.querySelectorAll('.alphabet-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.alphabet-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentLetter = btn.dataset.letter;
                applyFilters();
            });
        });

        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');

        searchInput.addEventListener('input', e => {
            currentSearch = e.target.value;
            clearSearch.style.display = currentSearch ? 'block' : 'none';
            applyFilters();
        });

        clearSearch.addEventListener('click', () => {
            searchInput.value = '';
            currentSearch = '';
            clearSearch.style.display = 'none';
            applyFilters();
        });

        document.getElementById('sortSelect').addEventListener('change', e => {
            const sortBy = e.target.value;
            switch (sortBy) {
                case 'title-asc':
                    filteredBooks.sort((a, b) => a.title.localeCompare(b.title));
                    break;
                case 'title-desc':
                    filteredBooks.sort((a, b) => b.title.localeCompare(a.title));
                    break;
                case 'price-asc':
                    filteredBooks.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    filteredBooks.sort((a, b) => b.price - a.price);
                    break;
            }
            renderBooks();
        });

        // ── Add to Cart ─────────────────────────────────────────────────
        async function addToCart(book) {
            try {
                const response = await fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id: String(book.id),
                        book_title: book.title,
                        book_author: book.authors,
                        book_cover: book.cover || '',
                        book_price: Number(book.price),
                        book_type: book.book_type || 'physical'
                    }),
                    credentials: 'include'
                });

                const text = await response.text();

                if (response.status === 401 || text.includes('login') || text.includes('unauthenticated')) {
                    showNotification('Please login first!', 'error');
                    setTimeout(() => window.location.href = '{{ route('login') }}', 1500);
                    return;
                }

                const data = JSON.parse(text);
                if (data.success) {
                    showNotification(`"${book.title}" added to cart!`, 'success');
                } else {
                    showNotification(data.message || 'Failed to add to cart', 'error');
                }
            } catch (err) {
                showNotification('Error: ' + err.message, 'error');
            }
        }

        // ── Toggle Wishlist ─────────────────────────────────────────────
        async function toggleWishlist(book, button) {
            try {
                const response = await fetch('{{ route('wishlist.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id: String(book.id),
                        book_title: book.title,
                        book_author: book.authors,
                        book_cover: book.cover || '',
                        book_price: Number(book.price),
                        book_type: book.book_type || 'physical'
                    }),
                    credentials: 'include'
                });

                const text = await response.text();

                if (response.status === 401 || text.includes('login')) {
                    showNotification('Please login first!', 'error');
                    setTimeout(() => window.location.href = '{{ route('login') }}', 1500);
                    return;
                }

                const data = JSON.parse(text);
                if (data.success) {
                    if (data.action === 'added') {
                        button.innerHTML = '❤️';
                        button.style.color = '#ff4757';
                        showNotification(`"${book.title}" added to wishlist!`, 'success');
                    } else {
                        button.innerHTML = '♡';
                        button.style.color = '#ff6b6b';
                        showNotification(`"${book.title}" removed from wishlist!`, 'success');
                    }
                } else {
                    showNotification(data.message || 'Failed to update wishlist', 'error');
                }
            } catch (err) {
                showNotification('Error: ' + err.message, 'error');
            }
        }

        // ── Notification ────────────────────────────────────────────────
        function showNotification(message, type) {
            const n = document.createElement('div');
            n.style.cssText = `
                position: fixed; top: 100px; right: 20px;
                background: ${type === 'success' ? 'rgba(76,175,80,0.95)' : 'rgba(244,67,54,0.95)'};
                color: white; padding: 15px 25px; border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.3);
                z-index: 10000; font-size: 14px; font-weight: 600;
                animation: slideIn 0.3s ease;
            `;
            n.textContent = message;
            document.body.appendChild(n);
            setTimeout(() => {
                n.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => n.remove(), 300);
            }, 3000);
        }

        // ── Fetch books ─────────────────────────────────────────────────
        async function fetchBooks() {
            try {
                const response = await fetch('{{ route('api.books.index') }}');
                const result = await response.json();

                if (result.success) {
                    allBooks = result.data.map(book => ({
                        ...book,
                        cover: book.cover || null
                    }));
                    applyFilters();
                }
            } catch (err) {
                console.error('Error fetching books:', err);
            }
        }

        fetchBooks();
    </script>
</body>

</html>
