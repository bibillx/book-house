<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - BookStore</title>
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

        /* Background */
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

        /* Navigation */
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

        .nav-menu a .icon {
            font-size: 18px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-bar {
            position: relative;
            width: 350px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 40px;
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 25px;
            font-size: 14px;
            background: rgba(26, 20, 16, 0.6);
            transition: all 0.3s;
            color: #f4e4c1;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #d2b48c;
            background: rgba(26, 20, 16, 0.8);
        }

        .search-bar input::placeholder {
            color: #8b7355;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d2b48c;
            font-size: 16px;
        }

        .notification-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 18px;
            color: #d2b48c;
            position: relative;
        }

        .notification-btn:hover {
            background: rgba(210, 180, 140, 0.2);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: #ff4757;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
            font-weight: bold;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.3s;
            background: rgba(210, 180, 140, 0.1);
            border: 2px solid rgba(210, 180, 140, 0.3);
            position: relative;
        }

        .user-profile:hover {
            background: rgba(210, 180, 140, 0.2);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1410;
            font-weight: bold;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #f4e4c1;
        }

        .user-email {
            font-size: 11px;
            color: #d2b48c;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: rgba(42, 35, 28, 0.98);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 12px;
            min-width: 200px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 1001;
        }

        .user-profile:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 12px 20px;
            color: #d2b48c;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            transition: all 0.3s;
            border-bottom: 1px solid rgba(210, 180, 140, 0.1);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: rgba(210, 180, 140, 0.15);
            color: #f4e4c1;
        }

        .dropdown-item .icon {
            font-size: 16px;
        }

        .dropdown-item.logout-btn {
            color: #ff6b6b;
        }

        .dropdown-item.logout-btn:hover {
            background: rgba(255, 107, 107, 0.1);
            color: #ff4757;
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(210, 180, 140, 0.2);
            margin: 5px 0;
        }

        /* Main Content */
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

        /* Hero Section */
        .hero-section {
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.3);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .hero-text {
            flex: 1;
        }

        .hero-subtitle {
            font-size: 13px;
            color: #d2b48c;
            margin-bottom: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 18px;
            line-height: 1.2;
            color: #f4e4c1;
            font-family: 'Georgia', serif;
        }

        .hero-description {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 30px;
            color: #d2b48c;
        }

        .hero-btn {
            padding: 14px 35px;
            background: linear-gradient(135deg, #d2b48c 0%, #c9a872 100%);
            color: #1a1410;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-btn:hover {
            background: linear-gradient(135deg, #f4e4c1 0%, #d2b48c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(210, 180, 140, 0.3);
        }

        .hero-stats {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .stat-item {
            text-align: left;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #c9a872;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #d2b48c;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .book-stack-display {
            display: flex;
            gap: 15px;
            transform: perspective(1000px) rotateY(-15deg);
        }

        .display-book {
            width: 130px;
            height: 190px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            padding: 15px;
            transition: all 0.3s;
        }

        .display-book:hover {
            transform: translateY(-10px) scale(1.05);
        }

        /* Books Section */
        .books-section {
            margin-bottom: 40px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 26px;
            font-weight: 700;
            color: #f4e4c1;
            font-family: 'Georgia', serif;
        }

        .view-all {
            color: #d2b48c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .view-all:hover {
            color: #f4e4c1;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        .book-card {
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(42, 35, 28, 0.9);
            border: 2px solid rgba(210, 180, 140, 0.2);
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .book-card:hover {
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
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            position: relative;
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
        }

        .badge-physical {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
        }

        .badge-digital {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(33, 150, 243, 0.3);
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

        .alert {
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.15);
            color: #4caf50;
            border: 2px solid rgba(76, 175, 80, 0.3);
        }

        .alert-success::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #4caf50;
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            nav {
                padding: 20px 30px;
            }

            .nav-left {
                gap: 30px;
            }

            .nav-menu {
                gap: 20px;
            }

            .search-bar {
                width: 250px;
            }

            .main-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .hero-section {
                flex-direction: column;
                text-align: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .search-bar {
                width: 200px;
            }

            .user-info {
                display: none;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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
                <div class="mini-book color-2"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
            </div>
            <div class="book-row row-2">
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
            </div>
            <div class="book-row row-3">
                <div class="mini-book color-3"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
                <div class="mini-book color-1"></div>
                <div class="mini-book color-2"></div>
                <div class="mini-book color-3"></div>
                <div class="mini-book color-4"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                <span>BookHouse</span>
            </a>
            <div class="nav-menu">
                <a href="{{ url('/dashboard') }}" class="active">
                    <span class="icon">🏠</span>
                    Home
                </a>
                <a href="{{ route('catalog') }}">
                    <span class="icon">📖</span>
                    Catalog
                </a>
                <a href="{{ route('cart') }}">
                    <span class="icon">🛒</span>
                    Cart
                </a>
                <a href="{{ route('wishlist') }}">
                    <span class="icon">❤️</span>
                    Wishlist
                </a>
                <a href="{{ route('checkout.orders') }}">
                    <span>📦</span> Orders
                </a>
            </div>
        </div>
        <div class="nav-right">
            <div class="user-profile">
                <div class="user-avatar">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @endif
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                </div>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <span class="icon">👤</span>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item logout-btn"
                            style="width: 100%; background: none; border: none; cursor: pointer; text-align: left;">
                            <span class="icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-text">
                <div class="hero-subtitle">Welcome Back, {{ Auth::user()->name }}!</div>
                <h1 class="hero-title">Continue Your Shopping Here!</h1>
                <p class="hero-description">
                    Discover new stories, explore different worlds, and expand your knowledge with our vast collection
                    of books.
                </p>
                <button class="hero-btn">Explore Now</button>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['total_purchases'] }}</div>
                        <div class="stat-label">Total Purchases</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['cart_count'] }}</div>
                        <div class="stat-label">In Cart</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['wishlist_count'] }}</div>
                        <div class="stat-label">Wishlist</div>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="book-stack-display">
                    <div class="display-book"
                        style="background: url('https://i.pinimg.com/736x/24/22/89/242289f389f6919cd8a2312f98ab8a62.jpg') center/cover; position: relative;">
                        <div
                            style="position: absolute; bottom: 10px; left: 10px; right: 10px; background: rgba(0,0,0,0.7); padding: 8px; border-radius: 5px; font-size: 11px; text-align: center;">
                            Classic Literature
                        </div>
                    </div>
                    <div class="display-book"
                        style="background: url('https://i.pinimg.com/736x/3b/3f/9f/3b3f9f11d8479368d7e615211972affa.jpg') center/cover; margin-top: 20px; position: relative;">
                        <div
                            style="position: absolute; bottom: 10px; left: 10px; right: 10px; background: rgba(0,0,0,0.7); padding: 8px; border-radius: 5px; font-size: 11px; text-align: center;">
                            Fantasy & Fiction
                        </div>
                    </div>
                    <div class="display-book"
                        style="background: url('https://i.pinimg.com/1200x/a7/42/2e/a7422ec3963e1420cafd012f41d9ef76.jpg') center/cover; margin-top: -10px; position: relative;">
                        <div
                            style="position: absolute; bottom: 10px; left: 10px; right: 10px; background: rgba(0,0,0,0.7); padding: 8px; border-radius: 5px; font-size: 11px; text-align: center;">
                            Mystery & Thriller
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
