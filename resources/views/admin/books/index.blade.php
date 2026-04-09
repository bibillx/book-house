<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
            --danger: #c0392b;
            --danger-light: #e74c3c;
            --warning: #e67e22;
            --info: #2980b9;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            padding: 60px 20px;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            margin-bottom: 40px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
        }

        .page-header-left .breadcrumb {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .page-header-left .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .page-header-left .breadcrumb a:hover {
            text-decoration: underline;
        }

        .page-header-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: var(--text);
            line-height: 1.1;
        }

        .page-header-left p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 15px;
            font-weight: 300;
        }

        .btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(45, 80, 22, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: var(--muted);
            border: 1.5px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
            color: var(--text);
        }

        /* Success alert */
        .alert-success {
            background: #edf7ed;
            border: 1.5px solid #a8d5a2;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 24px;
            font-size: 14px;
            color: #2d5016;
        }

        /* Card */
        .card {
            background: var(--card);
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            border-bottom: 2px solid var(--border);
        }

        th {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 16px 20px;
            text-align: left;
            background: #faf9f6;
        }

        th.center,
        td.center {
            text-align: center;
        }

        td {
            padding: 16px 20px;
            font-size: 14px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #faf9f6;
        }

        /* Cover image */
        .book-cover {
            width: 48px;
            height: 64px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            display: block;
        }

        .cover-placeholder {
            width: 48px;
            height: 64px;
            border-radius: 6px;
            background: var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--muted);
        }

        /* Book info */
        .book-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .book-title {
            font-weight: 500;
            color: var(--text);
        }

        .book-author {
            font-size: 12px;
            color: var(--muted);
        }

        /* Badge */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .badge-physical {
            background: #e8f0e0;
            color: var(--accent);
        }

        .badge-digital {
            background: #e0eaf8;
            color: var(--info);
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-edit {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            padding: 7px 14px;
            background: #fff7ec;
            color: var(--warning);
            border: 1.5px solid #f5d5a8;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: #fdebd0;
        }

        .btn-delete {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            padding: 7px 14px;
            background: #fdf0ef;
            color: var(--danger);
            border: 1.5px solid #e8b4b0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #fbe0de;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
        }

        /* Empty state */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 15px;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <div class="page-header">
            <div class="page-header-left">
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">← Dashboard</a>
                </div>
                <h1>Kelola Buku</h1>
                <p>Manajemen koleksi buku perpustakaan.</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
        </div>

        @if (session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th class="center">Cover</th>
                        <th>Judul</th>
                        <th>Harga</th>
                        <th class="center">Stok</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td class="center">
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}"
                                        class="book-cover">
                                @else
                                    <div class="cover-placeholder">📖</div>
                                @endif
                            </td>

                            <td>
                                <div class="book-info">
                                    <span class="book-title">{{ $book->title }}</span>
                                    <span class="book-author">{{ $book->author }}</span>
                                    <span>
                                        @if ($book->book_type === 'physical')
                                            <span class="badge badge-physical">Buku Fisik</span>
                                        @elseif ($book->type === 'physical')
                                            <span class="badge badge-physical">Buku Fisik</span>
                                        @else
                                            <span class="badge badge-digital">E-Book</span>
                                        @endif
                                    </span>
                                </div>
                            </td>

                            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>

                            <td class="center">
                                <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="stock-form">
                                        <input type="number" name="stock" value="{{ $book->stock }}" min="0"
                                            class="stock-input">
                                        <button type="submit" class="btn-update">Simpan</button>
                                    </div>
                                </form>
                            </td>

                            <td class="center">
                                <div class="actions">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin hapus buku ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">📚</div>
                                    <p>Belum ada buku. <a href="{{ route('admin.books.create') }}"
                                            style="color: var(--accent);">Tambah buku pertama</a>.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($books->hasPages())
                <div class="pagination-wrapper">
                    {{ $books->links() }}
                </div>
            @endif
        </div>

    </div>

</body>

</html>
