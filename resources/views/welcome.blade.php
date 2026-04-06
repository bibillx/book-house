<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHouse</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            overflow-x: hidden;
            background: #1a1410;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 25px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(210, 180, 140, 0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d2b48c;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .logo-icon {
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            color: #d2b48c;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s;
            font-weight: 500;
            font-family: 'Segoe UI', sans-serif;
        }

        .nav-links a:hover {
            color: #f4e4c1;
        }

        .nav-links .signup-btn {
            padding: 10px 28px;
            border: 2px solid #d2b48c;
            border-radius: 25px;
            background: transparent;
        }

        .nav-links .signup-btn:hover {
            background: #d2b48c;
            color: #1a1410;
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #2d1810 0%, #1a1410 50%, #0f0a08 100%);
        }

        /* Bookshelf Background */
        .bookshelf-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.4;
        }

        .bookshelf {
            position: absolute;
            width: 100%;
            height: 200px;
            display: flex;
            gap: 5px;
            padding: 0 20px;
        }

        .shelf-1 { top: 15%; }
        .shelf-2 { top: 40%; }
        .shelf-3 { top: 65%; }

        .book {
            width: 60px;
            height: 180px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.3s;
        }

        .book:hover {
            transform: translateY(-10px);
        }

        .book-spine {
            width: 100%;
            height: 100%;
            border-radius: 3px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.3);
            position: relative;
        }

        .book-1 { background: linear-gradient(to right, #8b4513 0%, #a0522d 100%); }
        .book-2 { background: linear-gradient(to right, #2f4f4f 0%, #3d5f5f 100%); height: 160px; }
        .book-3 { background: linear-gradient(to right, #8b0000 0%, #a52a2a 100%); height: 190px; }
        .book-4 { background: linear-gradient(to right, #1e3a5f 0%, #2e4a6f 100%); height: 170px; }
        .book-5 { background: linear-gradient(to right, #4b0082 0%, #5b1092 100%); height: 165px; }
        .book-6 { background: linear-gradient(to right, #654321 0%, #755331 100%); }
        .book-7 { background: linear-gradient(to right, #2f4f2f 0%, #3f5f3f 100%); height: 175px; }
        .book-8 { background: linear-gradient(to right, #8b6914 0%, #9b7924 100%); height: 155px; }

        .shelf-board {
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 15px;
            background: linear-gradient(to bottom, #3d2817 0%, #2d1810 100%);
            border-radius: 2px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        /* Floating Books Animation */
        .floating-books {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-book {
            position: absolute;
            width: 40px;
            height: 55px;
            background: linear-gradient(135deg, #8b4513 0%, #a0522d 100%);
            border-radius: 2px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: float-book 20s linear infinite;
            opacity: 0.3;
        }

        .floating-book::after {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 1px;
        }

        .floating-book-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-book-2 {
            top: 60%;
            right: 15%;
            animation-delay: 5s;
            background: linear-gradient(135deg, #1e3a5f 0%, #2e4a6f 100%);
        }

        .floating-book-3 {
            top: 40%;
            left: 80%;
            animation-delay: 10s;
            background: linear-gradient(135deg, #8b0000 0%, #a52a2a 100%);
        }

        @keyframes float-book {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Sparkles/Pages Effect */
        .pages-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .page {
            position: absolute;
            width: 3px;
            height: 15px;
            background: rgba(210, 180, 140, 0.6);
            animation: fall 15s linear infinite;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Content */
        .hero-content {
            position: relative;
            z-index: 100;
            max-width: 700px;
            padding: 100px 80px;
            color: #f4e4c1;
        }

        .hero-content .subtitle {
            font-size: 16px;
            color: #d2b48c;
            margin-bottom: 15px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero-content h1 {
            font-size: 68px;
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.2;
            color: #f4e4c1;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 40px;
            color: #d2b48c;
            font-family: 'Segoe UI', sans-serif;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            font-family: 'Segoe UI', sans-serif;
        }

        .btn-primary {
            background: #d2b48c;
            color: #1a1410;
        }

        .btn-primary:hover {
            background: #f4e4c1;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(210, 180, 140, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #d2b48c;
            border: 2px solid #d2b48c;
        }

        .btn-secondary:hover {
            background: rgba(210, 180, 140, 0.1);
            transform: translateY(-3px);
        }

        /* Book Stack Decoration */
        .book-stack {
            position: absolute;
            right: 8%;
            bottom: 10%;
            z-index: 50;
        }

        .stacked-book {
            width: 180px;
            height: 35px;
            margin-bottom: 3px;
            border-radius: 3px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }

        .stacked-book::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 10px;
            right: 10px;
            height: 2px;
            background: rgba(255,255,255,0.1);
        }

        .stacked-1 {
            background: linear-gradient(to right, #8b4513 0%, #a0522d 100%);
            transform: rotate(-2deg);
        }

        .stacked-2 {
            background: linear-gradient(to right, #1e3a5f 0%, #2e4a6f 100%);
            transform: rotate(1deg);
        }

        .stacked-3 {
            background: linear-gradient(to right, #8b0000 0%, #a52a2a 100%);
            transform: rotate(-1deg);
        }

        .stacked-4 {
            background: linear-gradient(to right, #2f4f2f 0%, #3f5f3f 100%);
            transform: rotate(2deg);
        }

        @media (max-width: 768px) {
            nav {
                padding: 20px 30px;
            }

            .nav-links {
                gap: 20px;
            }

            .hero-content {
                padding: 100px 30px;
            }

            .hero-content h1 {
                font-size: 42px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .book-stack {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
    <div class="logo">
        <span class="logo-icon">📚</span>
        <span>BookHouse</span>
    </div>
    <div class="nav-links">
        @auth
            <a href="/">Home</a>
            <a href="#catalog">Catalog</a>
            <a href="#bestsellers">Bestsellers</a>
            <a href="#about">About</a>
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #d2b48c; cursor: pointer; font-size: 15px; font-family: 'Segoe UI', sans-serif;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="signup-btn">Sign up</a>
        @endauth
    </div>
</nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>

        <!-- Bookshelf Background -->
        <div class="bookshelf-container">
            <div class="bookshelf shelf-1">
                <div class="book"><div class="book-spine book-1"></div></div>
                <div class="book"><div class="book-spine book-2"></div></div>
                <div class="book"><div class="book-spine book-3"></div></div>
                <div class="book"><div class="book-spine book-4"></div></div>
                <div class="book"><div class="book-spine book-5"></div></div>
                <div class="book"><div class="book-spine book-6"></div></div>
                <div class="book"><div class="book-spine book-7"></div></div>
                <div class="book"><div class="book-spine book-8"></div></div>
                <div class="book"><div class="book-spine book-1"></div></div>
                <div class="book"><div class="book-spine book-3"></div></div>
                <div class="shelf-board"></div>
            </div>

            <div class="bookshelf shelf-2">
                <div class="book"><div class="book-spine book-4"></div></div>
                <div class="book"><div class="book-spine book-6"></div></div>
                <div class="book"><div class="book-spine book-2"></div></div>
                <div class="book"><div class="book-spine book-8"></div></div>
                <div class="book"><div class="book-spine book-1"></div></div>
                <div class="book"><div class="book-spine book-5"></div></div>
                <div class="book"><div class="book-spine book-7"></div></div>
                <div class="book"><div class="book-spine book-3"></div></div>
                <div class="book"><div class="book-spine book-4"></div></div>
                <div class="book"><div class="book-spine book-2"></div></div>
                <div class="shelf-board"></div>
            </div>

            <div class="bookshelf shelf-3">
                <div class="book"><div class="book-spine book-7"></div></div>
                <div class="book"><div class="book-spine book-3"></div></div>
                <div class="book"><div class="book-spine book-5"></div></div>
                <div class="book"><div class="book-spine book-1"></div></div>
                <div class="book"><div class="book-spine book-8"></div></div>
                <div class="book"><div class="book-spine book-4"></div></div>
                <div class="book"><div class="book-spine book-6"></div></div>
                <div class="book"><div class="book-spine book-2"></div></div>
                <div class="book"><div class="book-spine book-5"></div></div>
                <div class="book"><div class="book-spine book-7"></div></div>
                <div class="shelf-board"></div>
            </div>
        </div>

        <!-- Floating Books -->
        <div class="floating-books">
            <div class="floating-book floating-book-1"></div>
            <div class="floating-book floating-book-2"></div>
            <div class="floating-book floating-book-3"></div>
        </div>

        <!-- Pages Effect -->
        <div class="pages-effect">
            <div class="page" style="left: 10%; animation-delay: 0s;"></div>
            <div class="page" style="left: 20%; animation-delay: 2s;"></div>
            <div class="page" style="left: 30%; animation-delay: 4s;"></div>
            <div class="page" style="left: 40%; animation-delay: 1s;"></div>
            <div class="page" style="left: 50%; animation-delay: 3s;"></div>
            <div class="page" style="left: 60%; animation-delay: 5s;"></div>
            <div class="page" style="left: 70%; animation-delay: 2.5s;"></div>
            <div class="page" style="left: 80%; animation-delay: 4.5s;"></div>
            <div class="page" style="left: 90%; animation-delay: 1.5s;"></div>
        </div>

        <!-- Book Stack Decoration -->
        <div class="book-stack">
            <div class="stacked-book stacked-1"></div>
            <div class="stacked-book stacked-2"></div>
            <div class="stacked-book stacked-3"></div>
            <div class="stacked-book stacked-4"></div>
        </div>

        <!-- Content -->
        <div class="hero-content">
            <div class="subtitle">Where Imagination Becomes Reality</div>
            <h1>Where Your Next Story Begins</h1>
            <p>Explore thousands of books across every genre. From timeless classics to contemporary bestsellers, find stories that inspire, educate, and entertain.</p>
            <div class="cta-buttons">
                <a href="#catalog" class="btn btn-primary">Search Book</a>
                <a href="#about" class="btn btn-secondary">Buy Now</a>
            </div>
        </div>
    </section>
</body>
</html>