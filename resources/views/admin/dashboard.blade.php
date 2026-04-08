<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f4f1eb;
            --card: #ffffff;
            --accent: #2d5016;
            --accent-light: #4a7c2f;
            --text: #1a1a1a;
            --muted: #8a8474;
            --border: #ddd8cc;
            --input-bg: #faf9f6;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            padding: 60px 20px;
        }

        .page-wrapper {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            margin-bottom: 48px;
        }

        .page-header .label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            color: var(--text);
            line-height: 1.1;
        }

        .page-header p {
            margin-top: 10px;
            color: var(--muted);
            font-size: 15px;
            font-weight: 300;
        }

        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card);
            border-radius: 16px;
            padding: 32px 28px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 28px;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            color: var(--text);
            line-height: 1;
        }

        .stat-card.accent {
            background: var(--accent);
        }

        .stat-card.accent .stat-label,
        .stat-card.accent .stat-value {
            color: #fff;
        }

        .stat-card.accent .stat-icon {
            opacity: 0.8;
        }

        /* Divider */
        .section-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        /* Menu grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .menu-card {
            background: var(--card);
            border-radius: 14px;
            padding: 24px 28px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.2s;
            color: var(--text);
        }

        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            background: var(--accent);
            color: #fff;
        }

        .menu-card:hover .menu-desc {
            color: rgba(255, 255, 255, 0.7);
        }

        .menu-icon {
            font-size: 32px;
            flex-shrink: 0;
        }

        .menu-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .menu-title {
            font-weight: 500;
            font-size: 15px;
        }

        .menu-desc {
            font-size: 13px;
            color: var(--muted);
            font-weight: 300;
            transition: color 0.2s;
        }

        .arrow {
            margin-left: auto;
            font-size: 18px;
            opacity: 0.4;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

        <div class="page-wrapper">

        <div class="page-header">
            <div class="label">Admin Panel</div>
            <h1>Dashboard</h1>
            <p>Selamat datang Admin, {{ Auth::user()->name }}! Kelola konten perpustakaan dari sini. <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn" style="color: var(--accent-light); text-decoration: none; font-weight: 500;">Logout</a></p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card accent">
                <div class="stat-icon">📚</div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-value">{{ $totalBooks }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👤</div>
                <div class="stat-label">Total User</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🛒</div>
                <div class="stat-label">Total Order</div>
                <div class="stat-value">{{ $totalOrders }}</div>
            </div>
        </div>

        <!-- Quick menu -->
        <div class="section-label">Menu Cepat</div>
        <div class="menu-grid">
            <a href="{{ route('admin.books.index') }}" class="menu-card">
                <div class="menu-icon">📖</div>
                <div class="menu-info">
                    <span class="menu-title">Kelola Buku</span>
                    <span class="menu-desc">Tambah, edit, dan hapus buku</span>
                </div>
                <span class="arrow">→</span>
            </a>
            <a href="{{ route('admin.books.create') }}" class="menu-card">
                <div class="menu-icon">➕</div>
                <div class="menu-info">
                    <span class="menu-title">Tambah Buku</span>
                    <span class="menu-desc">Upload buku baru ke koleksi</span>
                </div>
                <span class="arrow">→</span>
            </a>
            <a href="{{ route('admin.users') }}" class="menu-card">
                <div class="menu-icon">👥</div>
                <div class="menu-info">
                    <span class="menu-title">Kelola Users</span>
                    <span class="menu-desc">Lihat semua users terdaftar</span>
                </div>
                <span class="arrow">→</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="menu-card">
                <div class="menu-icon">📦</div>
                <div class="menu-info">
                    <span class="menu-title">Kelola Orders</span>
                    <span class="menu-desc">Update status orders & lihat detail</span>
                </div>
                <span class="arrow">→</span>
            </a>
        </div>

    </div>

</body>

</html>
